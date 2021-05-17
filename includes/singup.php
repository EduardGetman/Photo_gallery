<?php
    session_start();
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    if ($_POST['password'] != $_POST['repetPassword']) {
        $_SESSION['message'] = 'Пароли не совпадают!';
        header('Location: ../registration.php');
    }
    if (!$_POST['сonsent']){
        $_SESSION['message'] = 'Вы не согласились на обработку персональных данных!';
        header('Location: ../registration.php');
    }
    require_once '../includes/db.php';
    if($name or $mail or $password){
        $_SESSION['message'] = 'Заполните все поля!';
        header('Location: ../registration.php');
    }
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['message'] = 'Введите почту!';
        header('Location: ../registration.php');
    }
    $mailStatment = getAllMail();
    foreach($mailStatment as $result)
    {
        if ($result['mail'] == $mail) {
            $_SESSION['message'] = 'На данную почту уже зарегистрирован другой пользователь!';
            header('Location: ../registration.php');
        } 
    }
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    insertNewUser($name, $mail, $password);
    $_SESSION['message'] = 'Вы успешно зарегистрировались! <br> Теперь вы можете авторизоваться';
    header('Location: ../authorization.php');
?>