<?php
if ($_SESSION['message']) {
?>
    <div class="message_block button_cl">
        <span><?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?></span>
    </div>
<?php
}
?>