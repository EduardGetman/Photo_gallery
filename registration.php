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
    <link rel="stylesheet" type="text/css" href="CSS/allBacground.css"/>
    <title> Авторизация </title>
</head>
<body class="background_c">
<?php require_once "tpl\\heder.php";?>
    <main class="form_entrance content_cl">
        <h1 class="name_form">Регистрация</h1>
        <form action="includes/singup.php" method="POST">
            <span class="arg_name">Имя:</span>
            <input class="field" type="text" name="name">
            <span class="arg_name">Почта:</span>
            <input class="field" type="text" name="mail">
            <span class="arg_name">Пароль:</span>
            <input class="field" type="password" name="password">            
            <span class="arg_name">Повторите пароль:</span>
            <input class="field" type="password" name="repetPassword">
            <span class="arg_name">
                <input type="checkbox" name="сonsent">
                Я согласен на обработку первональных данных
             </span>
            <samp class="button_block"> <input type="submit" value="отправить"></samp>
        </form>
        <?php require_once 'tpl/messege_enterence.php';?>
    </main>    
    <?php require_once "tpl\\footer.php";?>
</body>