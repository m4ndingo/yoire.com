<?php
class Canvas{
	function defaultMethod(){
		return Template::load(__CLASS__,"default.php");
	}
	function title(){return "Canvas";}
	function save(){
		$data=Common::getPost("data");
		
		//file_put_contents("img/canvas.new.txt",$data);
		file_put_contents("img/canvas.sent.png", base64_decode(substr($data, strpos($data, ",")+1)));

		if(!file_exists("img/canvas.jpg")) 	self::png2jpg("img/canvas.sent.png","img/canvas.jpg",70);
		if(!file_exists("img/canvas.old.png")) 	copy("img/canvas.sent.png","img/canvas.old.png");

		copy("img/canvas.new.png","img/canvas.old.png");
		self::merge("img/canvas.old.png","img/canvas.sent.png","img/canvas.new.png");
		self::png2jpg("img/canvas.new.png","img/canvas.jpg",70);
	}

	function png2jpg($originalFile, $outputFile, $quality) {
		$image = imagecreatefrompng($originalFile);
		imagejpeg($image, $outputFile, $quality);
		imagedestroy($image);
	}

	function merge($filename_x, $filename_y, $filename_result) {

	 // Get dimensions for specified images

	 list($width_x, $height_x) = getimagesize($filename_x);
	 list($width_y, $height_y) = getimagesize($filename_y);

	 // Create new image with desired dimensions

	 $image = imagecreatetruecolor($width_y, $height_y);

	 // Load images and then copy to destination image

	 $image_x = imagecreatefrompng($filename_x);
	 $image_y = imagecreatefrompng($filename_y);

	 imagecopy($image, $image_x, 0, 0, 0, 0, $width_x, $height_x);
	 imagecopy($image, $image_y, 0, 0, 0, 0, $width_y, $height_y);

	 // Save the resulting image to disk (as JPEG)

	 imagepng($image, $filename_result);

	 // Clean up

	 imagedestroy($image);
	 imagedestroy($image_x);
	 imagedestroy($image_y);

	}
}
?>