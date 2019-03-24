<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['image'])) {
  list($w, $h) = getimagesize($_FILES['image']['tmp_name']);
  $new_width = $_POST['new_width'];
  $path = $_POST['newfilename'];
  $quality = $_POST['quality'];

  
  $imgString = file_get_contents($_FILES['image']['tmp_name']);
  $old_image = imagecreatefromstring($imgString);
  $new_image = imagecreatetruecolor($new_width, $new_height);
  imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $new_width, $new_height, $w, $h);

  imageinterlace($new_image, true);
  imagejpeg($new_image, $path, $quality);

  imagedestroy($old_image);
  imagedestroy($new_image);

  die("File $new_image written.");
}

?>

