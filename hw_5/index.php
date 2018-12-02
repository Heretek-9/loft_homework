<?php

require 'vendor/autoload.php';
use Intervention\Image\ImageManagerStatic as IImage;

$from = 'img.jpg';
$to = 'wm_img.jpg';

$image = IImage::make($from);
$image->resize(200, null, function ($image) {
    $image->aspectRatio();
})
->rotate(45)
->text(
'watermark',
$image->width() / 2,
$image->height() / 2,
function ($font) {
    $font->color('#00f');
    $font->align('center');
    $font->valign('center');
});
$image->save($to, 85);
echo 'Изображение '.$from.' пересохранено в '.$to;
