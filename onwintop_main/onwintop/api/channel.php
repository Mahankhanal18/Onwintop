<?php
    include "init.php";
    if($_POST['method']=='DELETE'){
        $data=R::findOne("channels","WHERE id=?",[$_POST['id']]);
        if(R::trash($data)){
            echo "200";
        }else{
            echo "Error";
        }
    }
    if($_POST['method']=='FEATURED'){
        $data=R::findOne("channels","WHERE id=?",[$_POST['id']]);
        if($data['featured']!='featured'){
            //add featured
            $channels=R::findAll("channels","WHERE community_link=? AND featured=?",[$_POST['community_id'],'featured']);
            if(count($channels)>=3){
                echo "You can make upto 3 channels featured";
            }else{
                $data->featured='featured';
                if(R::store($data)){
                    echo "200";
                }
            }
        }else{
            //remove featured
            $data->featured='';
            if(R::store($data)){
                echo "200";
            }
        }
        

    }
