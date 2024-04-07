<?php

require '../vendor/autoload.php';

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

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

if (isset($_POST['name']) && isset($_POST['code'])) {
    $data = $_POST['code'];
    $data=(new UploadApi())->upload($data);
    echo $data['secure_url'];
    
}
?>