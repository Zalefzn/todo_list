<?php
    $db = new Mysqli;

    $db->connect('localhost', 'root', '', 'crrud');

    if($db){
        // echo "Success";
    } else {
        if(!$db){
            // echo "Failed";
        }
    }
?>