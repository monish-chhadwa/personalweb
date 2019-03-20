<?php
/**
 * Created by PhpStorm.
 * User: monish.c
 * Date: 7/31/2015
 * Time: 1:49 PM
 */
//Start the session so we can store what the security code actually is
session_start();

//Let's generate a totally random string using md5
$md5_hash = md5(rand(0,999));
//We don't need a 32 character long string so we trim it down to 5
$security_code = substr($md5_hash, 15, 5);

//Set the session to store the security code
$_SESSION["security_code"] = $security_code;

//Set the image width and height
$width = 75;
$height = 30;

//Create the image resource
$image = ImageCreate($width, $height);

//We are making three colors, white, black and gray
$random=rand(0,255);
$white = ImageColorAllocate($image, $random, 255, ($random+500)%255);
$black = ImageColorAllocate($image, ($random+998)%255, 0, $random);
$grey = ImageColorAllocate($image, 204, $random, 204);

//Make the background black
ImageFill($image, 0, 0, $black);

//Add randomly generated string in white to the image
$font = imageloadfont('font1.gdf');
ImageString($image, $font, 5, 5, $security_code, $white);

//Throw in some lines to make it a little bit harder for any bots to break
ImageRectangle($image,0,0,$width-1,$height-1,$grey);
imageline($image, 0, $height/2, $width, $height/2, $grey);
imageline($image, $width/2, 0, $width/2, $height, $grey);

//Tell the browser what kind of file is come in
header("Content-Type: image/jpeg");

//Output the newly created image in jpeg format
ImageJpeg($image);

//Free up resources
ImageDestroy($image);
