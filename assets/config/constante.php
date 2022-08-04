<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$dirProjeto = $_SERVER['DOCUMENT_ROOT'];
$url = $protocol.$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
?>