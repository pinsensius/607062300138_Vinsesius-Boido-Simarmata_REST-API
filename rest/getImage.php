<?php
	//Parameter check
	if (!isset($_GET['name']) || !isset($_GET['size'])) {
		echo 'Error: Name and size required.';
		exit();
	}
	
	//Construct the image path and file name based on parameters
	$filename = './images-' . $_GET['size'] . '/' . $_GET['name'] . '.png';

	if (file_exists($filename)) {
		//If the file exist, just return the file with appropriate header
		header("Content-Type: image/png");
		readfile($filename);
		
	} else {
		//If it doesn't exist, read our base image first
		$source = './images-xxxhdpi/' . $_GET['name'] . '.png';
		$image = imagecreatefrompng($source);
		
		//Then find target image size
		$pixels = array(88, 132, 176, 264, 352);
		$sizes = array('mdpi', 'hdpi', 'xhdpi', 'xxhdpi', 'xxxhdpi');
		$i = array_search($_GET['size'], $sizes);
		
		//Here we resize the image
		$result = imagecreatetruecolor($pixels[$i], $pixels[$i]);
		imagealphablending($result, false);
		imagesavealpha($result, true);
		$transparent = imagecolorallocatealpha($result, 255, 255, 255, 127);
		imagefilledrectangle($result, 0, 0,  $pixels[$i], $pixels[$i], $transparent);
		imagecopyresampled($result, $image, 0, 0, 0, 0, $pixels[$i], $pixels[$i], $pixels[4], $pixels[4]);
		
		//Save it as cache
		imagepng($result, $filename);
		
		//Output it
		header("Content-Type: image/png");
		imagepng($result);
		
		//Finally, free images from memory
		imagedestroy($image);
		imagedestroy($result);
	}
?>