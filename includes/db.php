<?php
require_once "config.php";
try {
    $connection = new PDO(
        $config['db']['dsn'],
        $config['db']['username'],
        $config['db']['password']
    );
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
    exit();
}
function getFeed(int $Offset ,int $CountPosts, int $userId = 0)
{
    if ($userId == 0) {
        $countAllposts = getCountAllPost();
        $Offset = $countAllposts  > $Offset+$CountPosts ? $Offset : $countAllposts - $CountPosts;
        $Offset = $Offset < 0 ? 0 : $Offset;
        $statement = getAllFeed($Offset, $CountPosts);
    } else {
        $statement = getUserFeed($Offset, $CountPosts, $userId);
    }
    if (!($statement->execute())) {
        createError($statement->errorInfo());
    }
    return  $statement;
}

function getAllFeed(int $Offset ,int $CountPosts)
{
    global $connection;
    $statement = $connection->prepare('SELECT 	user.id 	    as \'user_id\', ' .
        'user.avatar    as \'avatar\', ' .
        'user.name      as \'name\', ' .        
        'post.id 	    as \'post_id\', ' .
        'post.date 	    as \'date\', ' .
        'post.photo     as \'photo\', ' .
        'post.info 	    as \'info\', ' .
        'COUNT(rating.id) as \'count_score\', ' .
        'SUM(rating.score)/COUNT(rating.id) as \'average_rating\' ' .
        'FROM `post` INNER JOIN `user` ' .
        'ON user.id = post.user_id ' .
        'LEFT JOIN `rating` ' .
        'ON post.id = rating.post_id ' .
        'GROUP BY user.id, user.avatar,user.name,post.id, post.date,post.photo,post.info ' .
        'ORDER BY date DESC LIMIT :offset ,:countposts');
    $statement->bindParam(':countposts', $CountPosts, PDO::PARAM_INT);
    $statement->bindParam(':offset', $Offset, PDO::PARAM_INT);
    return $statement;
}
function getUserFeed(int $Offset ,int $CountPosts, int $userId)
{
    global $connection;
    $statement = $connection->prepare('SELECT 	user.id as \'user_id\', ' .
        'user.avatar    as \'avatar\', ' .
        'user.name      as \'name\', ' .
        'post.id 	    as \'post_id\', ' .
        'post.date 	    as \'date\', ' .
        'post.photo     as \'photo\', ' .
        'post.info 	    as \'info\', ' .
        'COUNT(rating.id) as \'count_score\', ' .
        'SUM(rating.score)/COUNT(rating.id) as \'average_rating\' ' .
        'FROM `post` INNER JOIN `user` ' .
        'ON user.id = post.user_id ' .
        'LEFT JOIN `rating` ' .
        'ON post.id = rating.post_id ' .
        'WHERE user.id = ? ' .
        'GROUP BY user.id, user.avatar,user.name,post.id, post.date,post.photo,post.info ' .
        'ORDER BY date DESC LIMIT ?, ?');
    $statement->bindValue(1, $userId, PDO::PARAM_INT);
    $statement->bindValue(2, $Offset, PDO::PARAM_INT);
    $statement->bindValue(3, $CountPosts, PDO::PARAM_INT);
    return $statement;
}
function getCountAllPost(){
    global $connection;
    $statement = $connection->prepare('SELECT COUNT(id) AS \'Count\' FROM `post`');
    if (!($statement->execute())) {
        createError($statement->errorInfo());
    }
    return  $statement->fetch()['Count'];
}
function getCountUserPost($userId){
    global $connection;
    $statement = $connection->prepare('SELECT COUNT(id) AS \'Count\' FROM `post` WHERE user_id = :userId');
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    if (!($statement->execute())) {
        createError($statement->errorInfo());
    }
    return  $statement->fetch()['Count'];
}
function getFeed2(int $CountPosts, int $userId = 0)
{
    if ($userId == 0) {
        $statement = getAllFeed2($CountPosts);
    } else {
        $statement = getUserFeed2($CountPosts, $userId);
    }
    if (!($statement->execute())) {
        createError($statement->errorInfo());
    }
    return  $statement;
}
function getAllFeed2(int $CountPosts)
{
    global $connection;
    $statement = $connection->prepare('SELECT 	user.id 	    as \'user_id\', ' .
        'user.avatar    as \'avatar\', ' .
        'user.name      as \'name\', ' .        
        'post.id 	    as \'post_id\', ' .
        'post.date 	    as \'date\', ' .
        'post.photo     as \'photo\', ' .
        'post.info 	    as \'info\', ' .
        'COUNT(rating.id) as \'count_score\', ' .
        'SUM(rating.score)/COUNT(rating.id) as \'average_rating\' ' .
        'FROM `post` INNER JOIN `user` ' .
        'ON user.id = post.user_id ' .
        'LEFT JOIN `rating` ' .
        'ON post.id = rating.post_id ' .
        'GROUP BY user.id, user.avatar,user.name,post.id, post.date,post.photo,post.info ' .
        'ORDER BY date DESC LIMIT :countposts');
    $statement->bindParam(':countposts', $CountPosts, PDO::PARAM_INT);
    return $statement;
}

function getUserFeed2(int $CountPosts, int $userId)
{
    global $connection;
    $statement = $connection->prepare('SELECT 	user.id as \'user_id\', ' .
        'user.avatar    as \'avatar\', ' .
        'user.name      as \'name\', ' .
        'post.id 	    as \'post_id\', ' .
        'post.date 	    as \'date\', ' .
        'post.photo     as \'photo\', ' .
        'post.info 	    as \'info\', ' .
        'COUNT(rating.id) as \'count_score\', ' .
        'SUM(rating.score)/COUNT(rating.id) as \'average_rating\' ' .
        'FROM `post` INNER JOIN `user` ' .
        'ON user.id = post.user_id ' .
        'LEFT JOIN `rating` ' .
        'ON post.id = rating.post_id ' .
        'WHERE user.id = ? ' .
        'GROUP BY user.id, user.avatar,user.name,post.id, post.date,post.photo,post.info ' .
        'ORDER BY date DESC LIMIT ?');
    $statement->bindValue(1, $userId, PDO::PARAM_INT);
    $statement->bindValue(2, $CountPosts, PDO::PARAM_INT);
    return $statement;
}

function getProfileInfo(int $userId)
{
    global $connection;
    $statement = $connection->prepare('SELECT user.name as \'name\', ' .
        'user.avatar as \'avatar\',' .
        'user.info as \'info\'' .
        'FROM user WHERE user.id = :userId');
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    if (!($statement->execute())) {
        createError($statement->errorInfo());
    }
    return  $statement;
}
function getAllMail()
{
    global $connection;
    $statement = $connection->prepare('SELECT user.mail as \'mail\' FROM user');
    if (!($statement->execute())) {
        createError($statement->errorInfo());
    }
    return  $statement;
}

function getUserByEmail(string $mail)
{
    global $connection;
    $statement = $connection->prepare('SELECT user.id as \'id\' , user.password as \'password\' , ' .
        'user.name as \'name\', user.avatar as \'avatar\' FROM user WHERE user.mail = :mail');
    $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
    if (!($statement->execute())) {
        createError($statement->errorInfo());
    }
    return  $statement;
}
function getRatingByUserId(int $userId)
{
    global $connection;
    $statement = $connection->prepare('SELECT rating.post_id as \'post_id\', rating.score  as \'score\' ' .
        'FROM rating WHERE rating.user_id = :userId');
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    if (!($statement->execute())) {
        createError($statement->errorInfo());
    }
    return  $statement;
}

function insertNewUser(string $name, string $mail, string $password)
{
    global $connection;
    $statement = $connection->prepare('INSERT INTO user (`name`,`mail`,`password`)' .
        'VALUES(:name, :mail, :password)');
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    if (!($statement->execute())) {
        createError($statement->errorInfo());
    }
    return  $statement;
}

function insertRating(int $score, int $postId, int $userId){
    global $connection;
    $statement = $connection->prepare('INSERT INTO rating (`score`,`post_id`,`user_id`) ' .
        'VALUES (:score,:postId,:userId)');
    $statement->bindParam(':score', $score, PDO::PARAM_INT);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':userId',  $userId, PDO::PARAM_INT);
    if (!($statement->execute())) {
        createError($statement->errorInfo());
    }
    return  $statement;
}

function insertPost(string $photo,string $info, int $userId){
    global $connection;
    $statement = $connection->prepare('INSERT INTO post (`photo`,`info`,`user_id`) VALUES (:photo,:info,:user_id)');
    $statement->bindParam(':photo', $photo, PDO::PARAM_STR);
    $statement->bindParam(':info', $info, PDO::PARAM_STR);
    $statement->bindParam(':user_id',  $userId, PDO::PARAM_INT);
    if (!($statement->execute())) {
        createError($statement->errorInfo());
    }
    return  $statement;
}

function uploadProfile(string $info, string $avatar, int $userId){
    global $connection;
    $statement = $connection->prepare('UPDATE user SET `avatar` = :avatar, `info` = :info  WHERE `id` = :userId');
    $statement->bindParam(':avatar', $avatar, PDO::PARAM_STR);
    $statement->bindParam(':info', $info, PDO::PARAM_STR);
    $statement->bindParam(':userId',  $userId, PDO::PARAM_INT);
    if (!($statement->execute())) {
        createError($statement->errorInfo());
    }
    return  $statement;
}

function updateRating(int $score, int $postId, int $userId){
    global $connection;
    $statement = $connection->prepare('UPDATE rating SET score = :score ' .
        'WHERE user_id = :userId AND post_id = :postId');
    $statement->bindParam(':score', $score, PDO::PARAM_INT);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':userId',  $userId, PDO::PARAM_INT);
    if (!($statement->execute())) {
        createError($statement->errorInfo());
    }
    return  $statement;
}

function chekRating(int $postId, int $userId){
    global $connection;
    $statement = $connection->prepare('SELECT id FROM rating ' .
        'WHERE rating.user_id = :userId AND rating.post_id = :postId');
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
    $statement->bindParam(':userId',  $userId, PDO::PARAM_INT);
    if (!($statement->execute())) {
        createError($statement->errorInfo());
    }
    return  $statement->rowCount() > 0;
}
function createError(array $errorInfo)
{
    echo 'Неудалось выполнить запрос: ';
    $arr = $errorInfo;
    print_r($arr);
    exit;
}
