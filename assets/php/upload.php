<?php
if (!isset($_POST['questionId'])) echo json_encode(array('success' => 0, 'data' => 'Id not provided'));

$data = '';
$target_dir = "../images/";


$prefix = null;
if (isset($_POST['tmp'])) $prefix = $_POST['tmp'] . '_tmp_';
else if (isset($_POST['id'])) $prefix = $_POST['id'] . '_';

$fileName = $prefix . basename($_FILES["fileToUpload"]["name"]);

$target_file = $target_dir . $fileName;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($check !== false) {
  //echo "File is an image - " . $check["mime"] . ". ";
  $uploadOk = 1;
} else {
  $data = "File is not an image. ";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  $data .= "Sorry, your file is too large. ";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $data .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
  $uploadOk = 0;
}

/*
if (!strpos($id, 'tmp')) {
  $oldImage = glob($target_dir.$id.'*')[0];
  if ($oldImage) {
    unlink($target_dir . $oldImage);
  }
}*/

// delete old ones
$oldImage = glob($target_dir.$prefix.'*');
foreach ($oldImage as $img) {
  unlink($target_dir . $img);
}





// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $data .= "Your file was not uploaded. ";
  echo json_encode(array('success' => 0, 'data' => $data, 'target' => $target_file));
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $data = "The file ". htmlspecialchars(basename( $_FILES["fileToUpload"]["name"])). " has been uploaded. ";
    echo json_encode(
      array(
        'success' => 1,
        'data' => $data,
        'name' => basename($fileName),
      ));
  } else {
    $data = "Sorry, there was an error uploading your file.";
    echo json_encode(array('success' => 0, 'data' => $data, 'target' => $target_file));
  }
}
?>