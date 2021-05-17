<?php
function replaceNullAvatar($path)
{
    if (is_null($path))
        return "../Images/empty_avatar.jpg";
    else
        return $path;
}

function cropAvatar($imagePath)
{
    $im = imagecreatefromjpeg($imagePath);
    $size = min(imagesx($im), imagesy($im));
    $im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]);
    if ($im2 !== FALSE) {
        imagepng($im2, $imagePath);
        imagedestroy($im2);
        imagedestroy($im);
        return true;
    }
    imagedestroy($im);
    return false;
}
