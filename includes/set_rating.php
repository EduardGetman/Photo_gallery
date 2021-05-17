<?php
require_once '../includes/db.php';
if ($_POST['rating']) {
    if (chekRating($_POST['post_id'], $_POST['user_id'])) {
        updateRating($_POST['rating'], $_POST['post_id'], $_POST['user_id']);
    } else {
        insertRating($_POST['rating'], $_POST['post_id'], $_POST['user_id']);
    }
}
if ($_POST['profile_id']) {
    header('Location: ../profile.php?id=' . $_POST['profile_id'] . '&offset=' . $_POST['offset']);
} else {
    header('Location: ../index.php?offset=' . $_POST['offset']);
}
