<?php
ini_set('display_errors', 1);
error_reporting(0xffffffff);
if(count($_FILES)){
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = @explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& ($_FILES["file"]["size"] < 2000000)
	&& in_array($extension, $allowedExts))
	  {
	  if ($_FILES["file"]["error"] > 0)
		{
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
		}
	  else
		{
		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		echo "Type: " . $_FILES["file"]["type"] . "<br>";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		//echo "Stored in: " . $_FILES["file"]["tmp_name"];
		move_uploaded_file($_FILES["file"]["tmp_name"],"img/v/".$_FILES["file"]["name"]);
		}
	  }
	else
	  {
	  echo "Invalid file";
	  }
}
?>
<html>
<body style="background:url('<?=Config::$base?>img/v/<?=urlencode($vars["img"])?>') no-repeat #000; background-size: 100%">
<div style="position:absolute; bottom:15px;right:0;margin-right:5px;">
<form method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><input type="submit" name="submit" value="Upload"> (max. 2MB)
</form>
</div>
<font size=1px>
<?php
if($d=opendir("img/v/")){
	while($f=readdir($d)){
		if(preg_match("/^\./",$f)) continue;
		print "<a href='?mo=Hacker!&img=".urlencode($f)."'>".htmlentities($f)."</a> ";
	}
}
?>

