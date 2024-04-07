<?php

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
    $name=time().str_replace(' ','',$file_name);
    move_uploaded_file($file_tmp, "../images/uploads/" . $name);
    $data['name']=$file_name;
    $data['size']=$file_size;
    $data['secure_url']=$name;

    echo json_encode($data);
}else{
    //echo "File Not Set";
    print_r($_POST);
}

?>