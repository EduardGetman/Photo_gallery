<?php
require_once "includes/db.php";
require_once "includes/image_processing.php";

$statement = getProfileInfo($_GET['id']);
$result = $statement->fetch();
 ?>

<div class="profile content_cb">
    <img src="<?php echo replaceNullAvatar($result["avatar"])?>" alt="Фото профиля" width="250">
    <div class="information">
        <div class="panel">
            <div class="name_block">
                <h1><?php echo $result['name']?></h1>
            </div>
            <div class="change">
                <a class="button button_cl" href="changed_profile.php">Изменить профиль</a>
                <a class="button button_cl" href="create_post.php">Загрузить фото</a>
            </div>
        </div>
        <div class="yourself content_cl">
            <h2>О себе:</h2>
            <p><?php echo $result['info']?></p>
        </div>
    </div>
</div>