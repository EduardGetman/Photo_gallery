<?php
require_once '../includes/db.php';
$uploadDir = '../Images/';
$uploadPath = $uploadDir . $_POST['user_id'] . time() . $_FILES['photo']['name'];
if (!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath)) {
    header('Location: ../create_post.php');
}
insertPost( $uploadPath,$_POST['yourself'], $_POST['user_id']);
header('Location: ../profile.php?id=' . $_POST['user_id']);
?>
