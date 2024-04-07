<?php
include "init.php";
if ($_POST['method'] == 'STATUS') {
    $data = R::findOne("communities", "WHERE link=?", [$_POST['id']]);
    $data->landing_page=$_POST['status'];
    if(R::store($data)){
        echo "200";
    }
}
