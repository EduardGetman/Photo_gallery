<?php
require_once '../includes/db.php';
require_once '../includes/image_processing.php';
$uploadDir = '../Images/';
$uploadPath = $uploadDir . $_POST['user_id'] . time() . $_FILES['photo']['name'];
if (!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath)) {
    header('Location: ../changed_profile.php');
}
if (!cropAvatar($uploadPath)) {
    header('Location: ../changed_profile.php');
}
uploadProfile($_POST['yourself'], $uploadPath, $_POST['user_id']);
header('Location: ../profile.php?id=' . $_POST['user_id']);
?>
