<?php
    include "init.php";
    if(isset($_POST['method'])){
        if($_POST['method']=='DELETE_CONTENT'){
            $content=R::findOne("contents","WHERE id=?",[$_POST['data_id']]);
            $data=array();
            
            //Delete file
            if($content['type']=='File'){
                $data=R::findOne("files",$content['data_id']);
                if(R::trash($content) && R::trash($data)){
                    echo "200";
                }
            }
            
            //Delete video
            if($content['type']=='Video'){
                $data=R::findOne("videos",$content['data_id']);
                if(R::trash($content) && R::trash($data)){
                    echo "200";
                }
            }

            //Delete Solution
            if($content['type']=='Solution'){
                $data=R::findOne("solutions",$content['data_id']);
                if(R::trash($content) && R::trash($data)){
                    echo "200";
                }
            }
            
        }
    }
?>