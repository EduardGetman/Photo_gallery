<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="CSS/reset.css" />
    <link rel="stylesheet" type="text/css" href="CSS/feed.css" />
    <link rel="stylesheet" type="text/css" href="CSS/fonts.css" />
    <link rel="stylesheet" type="text/css" href="CSS/heder.css" />
    <link rel="stylesheet" type="text/css" href="CSS/footer.css" />
    <link rel="stylesheet" type="text/css" href="CSS/allBacground.css" />
    <title> Фотогалерея </title>
</head>

<body class="background_c">
    <?php require_once "tpl\\heder.php"; ?>
    <main class="feed">
        <?php require "tpl\\post.php" ?>
    </main>
    <div class="switch">
        <?php $offset = $_GET['offset'] ? $_GET['offset'] : 0; ?>
        <a class="button button_cb" href="index.php?offset=<?= $offset >= 20 ? $offset - 20 : 0; ?>">Предыдущая страница</a>
        <a class="button button_cb" href="index.php">К новому</a>
        <a class="button button_cb" href="index.php?offset=<?= $offset + 20; ?>">Следующая страница</a>
    </div>
    <?php require_once "tpl\\footer.php"; ?>
</body>

</html>