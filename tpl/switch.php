<div class="switch">
        <?php $offset = $_GET['offset'] ? $_GET['offset'] : 0;?>
        <a class="button button_cb" href="index.php?offset=<?=$offset = $offset >= 20 ? $offset-20 : 0 ;?>">Предыдущая страница</a>
        <a class="button button_cb" href="index.php">К новому</a>
        <a class="button button_cb" href="index.php?offset=<?=$offset = $offset + 20;?>">Следующая страница</a>
</div>