<?php session_start();?>
<!DOCTYPE html>
<html>

<head>
    <meta content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="CSS/reset.css" />
    <link rel="stylesheet" type="text/css" href="CSS/creating_profile.css" />
    <link rel="stylesheet" type="text/css" href="CSS/fonts.css" />
    <link rel="stylesheet" type="text/css" href="CSS/heder.css" />
    <link rel="stylesheet" type="text/css" href="CSS/footer.css" />
    <link rel="stylesheet" type="text/css" href="CSS/heder.css" />
    <link rel="stylesheet" type="text/css" href="CSS/allBacground.css"/>
    <title> Изменение профиля </title>
</head>

<body class="background_c">
<?php require_once "tpl\\heder.php";?>
    <main>
        <form class="creating_profile_form content_cl" action="includes/upload_profile.php" method="POST" enctype="multipart/form-data" >
            <h2 class="field_name">Загрузите аватар</h2>
            <div class="top_button">
                <input type="file" name="photo" accept="image/jpg">
                <input class ="button_cl"type="submit" value="Отправить">
            </div>
            <h2 class="field_name">Расскажите о себе</h2>
            <textarea name="yourself" rows="30" placeholder="Расскажите о себе..."></textarea>
            <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']?>">
        </form>
    </main>
    <?php require_once "tpl\\footer.php";?>
</body>