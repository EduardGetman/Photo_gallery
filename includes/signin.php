<?php
    session_start();    
    require_once '../includes/db.php';
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $statment = getUserByEmail($mail);
    if($statment->rowCount() == 0)
    {
        $_SESSION['message'] = 'Неверно введен пароль или логин!';
        header('Location: ../authorization.php');
    }
    $user = $statment->fetch();
    if (password_verify($password,$user['password'])) 
    {
        $_SESSION['user']  = [
            'id' => $user['id'],
            'avatar' => $user['avatar'],
            'name' => $user['name']
        ];
        header('Location: ../profile.php?id='.$user['id']);
    }
    else{
        $_SESSION['message'] = 'Неверно введен пароль или логин!';
        header('Location: ../authorization.php');
    }
    
