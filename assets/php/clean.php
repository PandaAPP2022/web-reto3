<?php
$target_dir = "../images/";

$prefix = $_POST['id'] . '_tmp_';

$oldImage = glob($target_dir.$prefix.'*');
foreach ($oldImage as $img) {
  unlink($target_dir . $img);
}
?>