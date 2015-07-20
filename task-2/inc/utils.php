<?php
/**
 * @package AIS Converce
 * @sunpackege Image Gallery
 * @since 1.0.0
 */


/**
 * @param $dst_file
 * @param $src_file
 * @param $width
 * @param $quality
 * @param $ext
 * @param $watermark
 */
function create_gallery_image( $dst_file, $src_file, $width, $quality, $ext, $watermark = null ) {

	$in_img = imagecreatefromjpeg( $src_file );

	if ( imagesx( $in_img ) >= imagesy( $in_img ) ) {

		if ( imagesx( $in_img ) <= $width ) {
			$w = imagesx( $in_img );
			$h = imagesy( $in_img );
		} else {
			$w = $width;
			$h = ( imagesy( $in_img ) * $width ) / imagesx( $in_img );
		}

	} else {

		if ( imagesy( $in_img ) <= $width ) {
			$w = imagesx( $in_img );
			$h = imagesy( $in_img );
		} else {
			$h = $width;
			$w = ( imagesx( $in_img ) * $width ) / imagesy( $in_img );
		}
	}

	$r_img = imagecreatetruecolor( $w, $h );

	// Resize image
	imagecopyresampled( $r_img, $in_img, 0,0,0,0, $w, $h, imagesx( $in_img ), imagesy( $in_img ) );

	imagejpeg( $r_img, $dst_file, $quality );

	imagedestroy( $r_img );
	imagedestroy( $in_img );

	if ( $watermark ) {
		create_watermark_from_string( $dst_file, $watermark, null, $h );
	}
}


/**
 * @param $source
 * @param $string
 * @param $width
 * @param $height
 */
function create_watermark_from_string( $source, $string, $width = 10, $height ) {

	// Get source file
	$handle = imagecreatefromjpeg( $source );

	// Get source font
	$font = $_SERVER['DOCUMENT_ROOT'] . "/assets/fonts/HelveticaNeueBoldItalic.ttf";

	// Create watermark image
	$wm_image = imagecolorallocate( $handle, 255, 255, 255 );

	// Watermark text
	imagettftext( $handle, 30, 0, 10, $height - 30, $wm_image, $font, $string );

	// Save watermarked image
	imagepng( $handle, $source );

	// Destroy source
	imagedestroy( $handle );
}


/**
 * @param     $source
 * @param int $limit
 */
function gallery_images( $source, $limit = 20 ) {

	@$handle = opendir( $source );

	$images = array();

	if ( !$handle ) {
		return $images;
	}

	while ( false !== ( $image = readdir( $handle ) ) ) {
		if ( $image == '.' && $image == '..' ) {
			continue;
		}

		if ( is_dir( $source . $image ) ) {
			continue;
		}

		$images[] = $image;
	}

	return $images;

}