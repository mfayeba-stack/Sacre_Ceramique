/* Éditeur visuel — chargé uniquement dans l'aperçu du Studio (?sc_edit=1, session admin). */
(function () {
  'use strict';
  var SC = window.SC;
  if (!SC || window.parent === window) return;
  var ov = SC.ov;
  ['texts', 'images', 'hidden', 'order'].forEach(function (k) {
    if (!ov[k] || Array.isArray(ov[k])) ov[k] = {};
  });
  var baseline = JSON.stringify(ov);
  var mode = 'text';
  var selected = null;

  function post(msg) {
    msg.sc = 1;
    window.parent.postMessage(msg, location.origin);
  }
  function isDirty() { return JSON.stringify(ov) !== baseline; }
  function notify() { post({ type: 'dirty', dirty: isDirty() }); }

  function $all(sel) { return Array.prototype.slice.call(document.querySelectorAll(sel)); }

  function getText(el) {
    return el.innerText.replace(/ /g, ' ').replace(/\n{2,}/g, '\n').replace(/^\n+|\n+$/g, '');
  }

  // ───────── modes ─────────
  function setMode(m) {
    mode = m;
    clearSel();
    $all('[data-sc-e],[data-sc-t]').forEach(function (el) {
      if (m === 'text') {
        el.classList.add('sc-ed');
        el.setAttribute('contenteditable', 'plaintext-only');
        if (el.contentEditable !== 'plaintext-only') el.setAttribute('contenteditable', 'true');
      } else {
        el.classList.remove('sc-ed');
        el.removeAttribute('contenteditable');
      }
    });
    $all('[data-sc-img],[data-sc-bg]').forEach(function (el) {
      el.classList.toggle('sc-img', m === 'text');
    });
  }

  // ───────── texte ─────────
  document.addEventListener('input', function (e) {
    var el = e.target.closest && e.target.closest('[data-sc-e],[data-sc-t]');
    if (!el) return;
    var id = el.getAttribute('data-sc-e') || el.getAttribute('data-sc-t');
    ov.texts[id] = { h: el.getAttribute('data-sc-h'), v: getText(el) };
    notify();
  });

  // ───────── images ─────────
  function imageUnder(x, y) {
    var list = document.elementsFromPoint(x, y);
    for (var i = 0; i < list.length; i++) {
      if (list[i].hasAttribute('data-sc-img') || list[i].hasAttribute('data-sc-bg')) return list[i];
    }
    return null;
  }
  function setImage(id, path) {
    var el = document.querySelector('[data-sc="' + id + '"]');
    if (!el) return;
    if (el.hasAttribute('data-sc-img')) {
      el.setAttribute('src', path);
      el.removeAttribute('srcset');
      ov.images[id] = { h: el.getAttribute('data-sc-img'), v: path };
    } else if (el.hasAttribute('data-sc-bg')) {
      el.style.backgroundImage = "url('" + path + "')";
      ov.images[id] = { h: el.getAttribute('data-sc-bg'), v: path };
    }
    notify();
  }

  // ───────── blocs ─────────
  function parentSc(el) {
    var p = el.parentElement;
    while (p && !p.hasAttribute('data-sc')) p = p.parentElement;
    return p;
  }
  function sibs(el) {
    var pid = el.getAttribute('data-sc-pid');
    return Array.prototype.filter.call(el.parentNode.children, function (c) {
      return c.hasAttribute('data-sc') && c.getAttribute('data-sc-pid') === pid;
    });
  }
  function label(el) {
    var clone = el.cloneNode(true);
    Array.prototype.forEach.call(clone.querySelectorAll('.material-symbols-outlined,script,style'), function (n) { n.remove(); });
    var t = (clone.textContent || '').replace(/\s+/g, ' ').trim().slice(0, 45);
    return '<' + el.tagName.toLowerCase() + '>' + (t ? ' « ' + t + ' »' : '');
  }
  function info(el) {
    var s = sibs(el), i = s.indexOf(el);
    return {
      id: el.getAttribute('data-sc'), label: label(el), hidden: el.hasAttribute('data-sc-hid'),
      canUp: i > 0, canDown: i < s.length - 1, hasParent: !!parentSc(el)
    };
  }
  function clearSel() {
    if (selected) selected.classList.remove('sc-sel');
    $all('.sc-hover').forEach(function (n) { n.classList.remove('sc-hover'); });
    selected = null;
    post({ type: 'select', sel: null });
  }
  function select(el) {
    if (selected) selected.classList.remove('sc-sel');
    selected = el;
    el.classList.add('sc-sel');
    post({ type: 'select', sel: info(el) });
  }
  function recordOrder(el) {
    var pid = el.getAttribute('data-sc-pid');
    ov.order[pid] = sibs(el).map(function (c) { return c.getAttribute('data-sc') + ':' + c.getAttribute('data-sc-sig'); });
  }
  function command(op) {
    if (!selected) return;
    var el = selected, s = sibs(el), i = s.indexOf(el);
    if (op === 'up' && i > 0) {
      el.parentNode.insertBefore(el, s[i - 1]);
      recordOrder(el);
    } else if (op === 'down' && i < s.length - 1) {
      el.parentNode.insertBefore(s[i + 1], el);
      recordOrder(el);
    } else if (op === 'hide') {
      var id = el.getAttribute('data-sc');
      if (el.hasAttribute('data-sc-hid')) {
        el.removeAttribute('data-sc-hid');
        delete ov.hidden[id];
      } else {
        el.setAttribute('data-sc-hid', '1');
        ov.hidden[id] = el.getAttribute('data-sc-sig');
      }
    } else if (op === 'parent') {
      var p = parentSc(el);
      if (p) { select(p); p.scrollIntoView({ block: 'nearest' }); }
      return;
    }
    el.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
    post({ type: 'select', sel: info(el) });
    notify();
  }

  document.addEventListener('mouseover', function (e) {
    if (mode !== 'blocks') return;
    $all('.sc-hover').forEach(function (n) { n.classList.remove('sc-hover'); });
    var el = e.target.closest && e.target.closest('[data-sc]');
    if (el && el !== selected) el.classList.add('sc-hover');
  });

  // ───────── clics ─────────
  document.addEventListener('click', function (e) {
    var link = e.target.closest && e.target.closest('a[href]');
    if (mode === 'nav') {
      if (!link) return;
      var u;
      try { u = new URL(link.href, location.href); } catch (err) { return; }
      e.preventDefault();
      var name = u.pathname.split('/').pop();
      if (u.origin === location.origin && /\.php$/.test(name) && name.indexOf('admin') === -1) {
        if (isDirty() && !window.confirm('Abandonner les modifications non publiées de cette page ?')) return;
        window.location.href = name + '?sc_edit=1' + u.hash;
      }
      return;
    }
    // modes texte et blocs : on neutralise liens, boutons et scripts de la page
    var editable = e.target.closest && e.target.closest('[data-sc-e],[data-sc-t]');
    if (!(mode === 'text' && editable)) {
      e.preventDefault();
      e.stopImmediatePropagation();
    } else {
      e.preventDefault();
    }
    if (mode === 'text') {
      if (editable) return;
      var img = imageUnder(e.clientX, e.clientY);
      if (img) {
        var cur = img.getAttribute('src') || img.style.backgroundImage;
        post({ type: 'pickImage', id: img.getAttribute('data-sc'), current: cur });
      }
    } else if (mode === 'blocks') {
      var el = e.target.closest && e.target.closest('[data-sc]');
      if (el) select(el);
    }
  }, true);

  ['submit', 'dblclick'].forEach(function (t) {
    document.addEventListener(t, function (e) {
      if (mode !== 'nav') { e.preventDefault(); e.stopImmediatePropagation(); }
    }, true);
  });
  document.addEventListener('keydown', function (e) {
    // Espace/Entrée dans un bouton éditable ne doit pas déclencher son action
    if (mode === 'text' && e.target.closest && e.target.closest('button,a') && (e.key === ' ' || e.key === 'Enter')) {
      e.stopPropagation();
    }
  }, true);

  // ───────── messages du Studio ─────────
  window.addEventListener('message', function (e) {
    if (e.origin !== location.origin || !e.data || e.data.sc !== 1) return;
    var m = e.data;
    if (m.type === 'mode') setMode(m.mode);
    else if (m.type === 'cmd') command(m.op);
    else if (m.type === 'setImage') setImage(m.id, m.path);
    else if (m.type === 'getState') post({ type: 'state', ov: ov });
    else if (m.type === 'saved') { baseline = JSON.stringify(ov); notify(); }
  });

  setMode('text');
  post({ type: 'ready', page: SC.page, dirty: false });
})();
