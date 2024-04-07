<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Tag\VideoTag;
use Cloudinary;

Configuration::instance([
    'cloud' => [
        'cloud_name' => 'tellselling',
        'api_key' => '165973283857982',
        'api_secret' => '5WR5zH2znRl5xDTEN8_tOcMA3O8'
    ],
    'url' => [
        'secure' => false
    ]
]);

(new VideoTag('dog.mp4'))
	->overlay(Overlay::source(
	Source::fetch("https://res.cloudinary.com/demo/image/upload/logos/cloudinary_full_logo_white_small.png")));

?>
