<?php
    include "init.php";
    //print_r($_POST);
    if($_POST['method']=='DELETE'){
        $data=R::findOne("blogs","WHERE id=?",[$_POST['id']]);
        if(R::trash($data)){
            echo "Blog Successfully Removed";
        }else{
            echo "Error";
        }
    }
    if($_POST['method']=='LOAD'){
        $page=$_POST['page'];
        $community_id=$_POST['community_id'];
        $limit=10;
        $all=R::findAll('blogs','ORDER BY id LIMIT '.(($page-1)*$limit).', '.$limit);
        echo json_encode($all);
    }

