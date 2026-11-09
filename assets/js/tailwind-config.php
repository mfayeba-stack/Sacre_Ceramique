<?php
declare(strict_types=1);
require __DIR__ . '/../../inc/bootstrap.php';
require __DIR__ . '/../../inc/cms.php';
header('Content-Type: application/javascript; charset=utf-8');
header('Cache-Control: no-cache');
echo cms_tailwind_config_js();
