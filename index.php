<?php

define('APP_LIB_ROOT', dirname(__FILE__) . '/lib/');

require_once 'framework/common.inc.php';
require_once WACT_ROOT . 'controller/pathinfo.inc.php';

$Front = new PathInfoDispatchController();
$Front->addChild('index',   new Handle(APP_LIB_ROOT . 'projects/index.page.php|IndexPage'));
$Front->addChild('details', new Handle(APP_LIB_ROOT . 'projects/details.page.php|DetailsPage'));
$Front->addChild('delete',  new Handle(APP_LIB_ROOT . 'projects/delete.page.php|DeletePage'));
$Front->addChild('edit',    new Handle(APP_LIB_ROOT . 'projects/edit.page.php|EditPage'));
$Front->addChild('add',     new Handle(APP_LIB_ROOT . 'projects/add.page.php|AddPage'));
$Front->addChild('login',   new Handle(APP_LIB_ROOT . 'users/login.page.php|LoginPage'));
$Front->addChild('logout',  new Handle(APP_LIB_ROOT . 'users/logout.page.php|LogoutPage'));
$Front->setDefaultChild('index');

$Front->start();

?>