<?php
require_once "includes/db.php";
require_once "includes/image_processing.php";
$offset = $_GET['offset'] ? $_GET['offset'] : 0;
$statement = getFeed($offset,20, (int) $_GET['id']);
if ($_SESSION['user']) {

    $ratingStatement = getRatingByUserId($_SESSION['user']['id']);
    $UserRatings = array();
    foreach ($ratingStatement as $var) {
        $UserRatings[] = $var;
    }
}
foreach ($statement as $result) {
?>
    <article class="post content_cl" name="<?= "post_" . $result['post_id'] ?>">
        <div class="head">
            <img class="avatar" src="<?php echo replaceNullAvatar($result["avatar"]) ?>" alt="аватар пользователя" width="60">
            <span class="name_block">
                <a href="profile.php?id=<?php echo $result["user_id"] ?>"><?php echo $result["name"] ?></a>
            </span>
        </div>
        <img class="image" src="<?php echo $result["photo"]; ?>" alt="аватар пользователя" height="600">
        <div class="rating">
            <?php
            if ($_SESSION['user']) {
                if ($_SESSION['user']['id'] != $result['user_id']) { ?>
                    <form method="POST" action="/includes/set_rating.php">
                        <select size="1" name="rating">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option selected="" disabled="">
                                <?php
                                $output = 'Выберете оценку';
                                foreach ($UserRatings as $rating) {
                                    if ($result['post_id'] == $rating['post_id']) {
                                        $output = $rating['score'];
                                        break;
                                    }
                                }
                                echo $output;
                                ?>
                            </option>
                        </select>
                        <input type="submit" value="отправить">
                        <input type="hidden" name="post_id" value="<?= $result['post_id'] ?>">
                        <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id'] ?>">
                        <?php
                        if ($_GET['id']) {
                        ?>
                            <input type="hidden" name="profile_id" value="<?= $_GET['id'] ?>">
                        <?php
                        }
                        ?>
                         <?php
                        if ($_GET['offset']) {
                        ?>
                            <input type="hidden" name="offset" value="<?= $_GET['offset'] ?>">
                        <?php
                        }
                        ?>
                    </form>
            <?php }
            } ?>
            <div class="total_rating">
                <span class="total_rating_key"> Всего оценок </span>
                <span class="total_rating_value"> <?php echo $result["count_score"]; ?></span>
            </div>
            <div class="average_rating">
                <span class="average_rating_key"> Средняя оценока</span>
                <span class="average_rating_value"> <?php echo number_format((float) $result["average_rating"], 1, '.', '');; ?></span>
            </div>
        </div>
        <div class="description">
            <p><?php echo $result["info"]; ?></p>
        </div>
    </article>
<?php } ?>