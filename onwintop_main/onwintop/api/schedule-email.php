<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    include "init.php";
    if($_POST['method']=='NEW'){
        if(isset($_POST['audience'])){
            $email=R::dispense("mails");
            $email->audience=$_POST['audience'];
            $email->event_id=$_POST['event_id'];
            $email->subject=$_POST['subject'];
            $email->message=$_POST['message'];
            $email->time=date('h:ia');
            $email->date=date('Y-m-d');
            $email->status='Successful';
            if(R::store($email)){
                echo "200";
            }else{
                echo "Error";
            }
        }   
    }if($_POST['method']=='GET'){
        echo "
        <table class='table'>
        <thead>
            <th>#</th>
            <th>Audience</th>
            <th>Subject</th>
            <th>Date</th>
            <th>Status</th>
        </thead>
        <tbody>
        ";
        $ss=R::findAll("mails","WHERE event_id=?",[$_POST['event_id']]);
        $i=1;
        foreach($ss as $s){
            echo "
            <tr>
                <td>".$i."</td>
                <td>".$s['audience']."</td>
                <td>".$s['subject']."</td>
                <td>".$s['date']."</td>
                <td>".$s['status']."</td>
            </tr>
            ";
            $i++;
        }
        if(count($ss)==0){
            echo "
            <tr>
                <td colspan='5'>No Guests Found</td>
            </tr>
            ";
        }
        echo "</tbody></table>";
    }
?>