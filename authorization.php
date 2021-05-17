<?php session_start();?>
<!DOCTYPE html>
<html>

<head>
    <meta content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="CSS/reset.css" />
    <link rel="stylesheet" type="text/css" href="CSS/entrance.css" />
    <link rel="stylesheet" type="text/css" href="CSS/fonts.css" />
    <link rel="stylesheet" type="text/css" href="CSS/heder.css" />
    <link rel="stylesheet" type="text/css" href="CSS/footer.css" />
    <link rel="stylesheet" type="text/css" href="CSS/allBacground.css" />
    <title> Авторизация </title>
</head>

<body class="background_c">
    <?php require_once "tpl\\heder.php"; ?>
    <main class="form_entrance content_cl">
        <h1 class="name_form">Авторизация</h1>
        <form action="includes/signin.php" method="POST">
            <span class="arg_name">Почта:</span>
            <input class="field" type="text" name="mail" id="0">
            <span class="arg_name">Пароль:</span>
            <input class="field" type="password" name="password" id="1">
            <samp class="button_block"> <input class=" button_cl" type="submit" value="отправить"></samp>
        </form>
        <?php require_once 'tpl/messege_enterence.php'; ?>
    </main>
    <?php require_once "tpl\\footer.php"; ?>
</body>