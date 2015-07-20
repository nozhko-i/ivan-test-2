<?php
/**
 * @package AIS Converce
 * @sunpackege Image Gallery
 * @since 1.0.0
 */

require_once ( 'config/config.php' );


// Init default smarty variables
$smarty->assign('wm', '');
$smarty->assign('im', '');

$images = gallery_images( $upload_dir );
$smarty->assign('images', $images);

if ( ! $_POST ) {
	$smarty->display('index.tpl');
	exit;
}

if ( !isset( $_POST['wm'] ) or !strlen( trim( $_POST['wm'] ) ) ) {
	$smarty->assign('error', 'true');
	$smarty->assign('error_msg', 'Enter a watermark text');
	$smarty->assign('wm', @$_POST['wm']);
	$smarty->display('index.tpl');
	exit;
}

if ( !isset( $_FILES['im']['name'] ) or empty( $_FILES['im']['name'] ) ) {
	$smarty->assign('error', 'true');
	$smarty->assign('error_msg', 'Choice file');
	$smarty->assign('wm', @$_POST['wm']);
	$smarty->display('index.tpl');
	exit;
}

if ( $_POST ) {

	$available_files = array(
		'.jpg',
		'.jpeg',
	);

	$extension = '.' . pathinfo( $_FILES['im']['name'], PATHINFO_EXTENSION );

	if ( ! in_array( $extension, $available_files ) ) {
		$smarty->assign('error', 'true');
		$smarty->assign('error_msg', 'Not supported file extension "' . $extension . '"');
		$smarty->assign('wm', @$_POST['wm']);
		$smarty->display('index.tpl');
		exit;
	}

	$watermark = trim( $_POST['wm'] );

	// Change filename to md5 hash based
	$_FILES['im']['name'] = md5( date( 'Y-m-d h:i:s' ) ) . $extension;

	// Upload image file
	$upload_file = $upload_dir . basename( $_FILES['im']['name'] );

	// Upload tmp image file
	$upload_file_tmp = $upload_dir_tmp . basename( $_FILES['im']['name'] );

	// Create uploads dit if not exists
	if (! is_dir($upload_dir)) mkdir($upload_dir, 755, true);
	if (! is_dir($upload_dir_tmp)) mkdir($upload_dir_tmp, 755, true);

	// Mode uploaded file
	if ( move_uploaded_file( $_FILES['im']['tmp_name'], $upload_file_tmp ) ) {

		create_gallery_image($upload_file, $upload_file_tmp, $image_width, $quality, $extension, $watermark);

		// Change file mode
		chmod( $upload_file, 0644 );

		// Delete temp file
		if ( file_exists( $upload_file_tmp ) ) {
			unlink( $upload_file_tmp );
		}

		header('location:' . '/');
		exit;

	} else {
		$smarty->assign('error', 'true');
		$smarty->assign('error_msg', 'Maybe hacker attack');
	}

	$smarty->display('index.tpl');
}



$smarty->display('index.tpl');

