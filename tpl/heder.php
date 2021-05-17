<?php require_once "includes/image_processing.php"; ?>
<nav class="heder heder_c">
    <div class="navigation ">
        <a href="index.php" class="logo">
            <img class="logo_image" src="/Images/logo.png" alt="аватар пользователя">
        </a>
        <a href="index.php" class="link">Главная страница</a>
    </div>
    <?php if ($_SESSION['user']) { ?>
        <div class="entrance">

            <div class="user">
                <span class="name_block">
                    <a href="profile.php?id=<?php echo $_SESSION['user']["id"] ?>"><?php echo $_SESSION['user']['name'] ?></a>
                </span>
                <img class="avatar" src="<?php echo replaceNullAvatar($_SESSION['user']["avatar"]) ?>" alt="аватар пользователя" width="60">
            </div>
            <div class="button button_cl">
                <a href="includes/logout.php">Выйти</a>
            </div>
        </div>
    <?php } else { ?>
        <div class="entrance">
            <div class="button button_cl">
                <a href="registration.php">Зарегистрироваться</a>
            </div>
            <div class="button button_cl">
                <a href="authorization.php">Авторизоваться</a>
            </div>
        </div>
    <?php } ?>
</nav>