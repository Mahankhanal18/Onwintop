<?php    
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    include "init.php";
    if(isset($_POST['method'])){
        if($_POST['method']=='NEW'){
            $data=R::dispense("challengecategories");
            $data->name=$_POST['name'];
            $data->community_id=$_POST['community_id'];
            if(R::store($data)){
                echo "Challenge type saved";
            }else{
                echo "Error Occured";
            }
        }
        if($_POST['method']=='LOAD'){
            $data=R::findAll("challengecategories","community_id=?",[$_POST['community_id']]);
            $res=array();
            foreach($data as $d){
                $temp=array(
                    "id"=>$d['id'],
                    "name"=>$d['name']    
                );
                array_push($res,$temp);
            }
            echo json_encode($res);
        }
        if($_POST['method']=='REMOVE'){
            $data=R::dispense("challengecategories","id=?",[$_POST['id']]);
            if(R::trash($data)){
                echo "Challenge type removed";
            }else{
                echo "Error Occured";
            }
        }
    }
?>