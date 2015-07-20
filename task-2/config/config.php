<?php
/**
 * @package AIS Converce
 * @sunpackege Image Gallery
 * @since 1.0.0
 */


require_once( 'inc/libs/smarty/Smarty.class.php' );
require_once( 'inc/utils.php' );

// Init Smarty template engine
$smarty = new Smarty();

// Init Smarty template dir
$smarty->template_dir = 'templates/templates/';
$smarty->compile_dir = 'templates/templates_c/';
$smarty->config_dir = 'templates/configs/';
$smarty->cache_dir = 'templates/cache/';

$smarty->assign('sitename', 'Image Upload by Ivan Nozhka');
$smarty->assign('date_y', date('Y'));

// Image settings
$upload_dir      = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/uploads/';
$upload_dir_tmp  = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/uploads/tmp/';
$image_width     = '800';
$quality         = 90;
