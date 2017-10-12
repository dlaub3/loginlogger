<?php
require_once('initialize.php');
require_once('ClassBootstrap.php');

$bootstrap = new Bootstrap;
$tables = $bootstrap->bootstrap_tables();
echo $tables;
