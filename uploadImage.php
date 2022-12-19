<?php
$data = array('status' => false);

$target = $_POST['target'];

if(isset($_POST['submit'])) {
  $target_file = basename($_FILES['file']['name']);
  $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
  $is_image = getimagesize($_FILES['file']['tmp_name']);
  if ($is_image !== false) {
    $data['image'] = $target.'/'.time().'.'.$file_type;
    if (move_uploaded_file($_FILES['file']['tmp_name'], "../img/".$data['image'])) {
      $data['status'] = true;
    } else {
      $data['message'] = "Error on uploading image";
    }
  } else {
    $data['message'] = 'File is not an image';
  }
}

header('Access-Control-Allow-Origin: *');
header('Content-type:application/json');

echo json_encode($data);

?>
