<?php
	function makeTransparent($image) {
		imagesavealpha($image, true);
		imagefill($image, 0, 0, imagecolorallocatealpha($image, 0, 0, 0, 127));
	}
	// Set the header for the correct content type
	header("Content-type: image/png");
	// Get the source images
	$biome = "biome_default";
	$basepath = "asset/" . $biome . "/" .  "ground/";
	$width = 1170; $height = 350;
	
	
	$target 	= imagecreatetruecolor($width, $height);
	makeTransparent($target);
	$layerSky 	= imagecreatetruecolor($width, $height);
	makeTransparent($layerSky);
	$layerFar 	= imagecreatetruecolor($width, $height);
	makeTransparent($layerFar);
	$layerNear 	= imagecreatetruecolor($width, $height);
	makeTransparent($layerNear);
	//imageAlphaBlending($target, true);
	//imageSaveAlpha($target, true);
	
	$sky_path = $basepath . "sky_bluesky_01.png"; 
	$gnl_path = $basepath . "gnl_grass_01.png"; 
	$gnr_path = $basepath . "gnr_grass_01.png"; 
	$gnc_path = $basepath . "gnc_grass_01.png"; 
	$gfl_path = $basepath . "gfl_grass_01.png"; 
	$gfr_path = $basepath . "gfr_grass_01.png"; 
	$gfc_path = $basepath . "gfc_grass_01.png"; 
	
	// read and convert the images
	$sky = imagecreatefrompng($sky_path);
	$gnl = imagecreatefrompng($gnl_path);
	$gnr = imagecreatefrompng($gnr_path);
	$gnc = imagecreatefrompng($gnc_path);
	
	$gfl = imagecreatefrompng($gfl_path);
	$gfr = imagecreatefrompng($gfr_path);
	$gfc = imagecreatefrompng($gfc_path);
	
	// Layer "sky"
	list($srcWidth, $srcHeight) = getimagesize($sky_path);
	imagecopy($layerSky, $sky, 0, 0, 0, 0, $srcWidth, $srcHeight);
	
	// Layer "far"
	list($srcWidth, $srcHeight) = getimagesize($gfc_path);
	imagecopy($layerFar, $gfc, 302, 112, 0, 0, $srcWidth, $srcHeight);
	
	list($srcWidth, $srcHeight) = getimagesize($gfl_path);
	imagecopy($layerFar, $gfl, 0, 112, 0, 0, $srcWidth, $srcHeight);
		
	list($srcWidth, $srcHeight) = getimagesize($gfr_path);
	imagecopy($layerFar, $gfr, 732, 112, 0, 0, $srcWidth, $srcHeight);
	
	// Layer "neaer"
	list($srcWidth, $srcHeight) = getimagesize($gnc_path);
	imagecopy($layerNear, $gnc, 98, 201, 0, 0, $srcWidth, $srcHeight);
	
	list($srcWidth, $srcHeight) = getimagesize($gnl_path);
	imagecopy($layerNear, $gnl, 0, 201, 0, 0, $srcWidth, $srcHeight);
		
	list($srcWidth, $srcHeight) = getimagesize($gnr_path);
	imagecopy($layerNear, $gnr, 846, 201, 0, 0, $srcWidth, $srcHeight);
	

	//Combine all the layers
	imagecopy($target, $layerSky, 0,0,0,0, $width, $height);
	imagecopy($target, $layerFar, 0,0,0,0, $width, $height);
	imagecopy($target, $layerNear, 0,0,0,0, $width, $height);
	
	imagepng($target);
	
?>
