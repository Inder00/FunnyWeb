<?php
require_once '../application/core.php';
require_once '../application/admin.php';
$admin->logout();
ob_start();
header("Location: ".$core->webUrl."admin");
ob_end_flush();
?>
