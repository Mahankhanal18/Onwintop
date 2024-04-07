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

if (isset($_FILES['file'])) {
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    //converting to kb
    $file_size=(double)$file_size/1024;
    //converting to mb
    $file_size=(double)$file_size/1024;
    $file_size=round($file_size,2);

    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $data = (new UploadApi())->upload($file_tmp,["resource_type" => "auto"]);
    
    $data['name']=$file_name;
    $data['size']=$file_size;

    echo json_encode($data);
}else{
    //echo "File Not Set";
    print_r($_POST);
}

?>
