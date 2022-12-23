<?php

    include '../login/log_connection.php';

    $mydata = file_get_contents("php://input");
    $data = json_decode($mydata,true);

    $sql = "delete from users where user_id = {$data['id']}";
    $result = mysqli_query($conn,$sql);

    if($result){
        echo "Delete Success";
    }else{
        echo "Delete Failed";
    }

?>