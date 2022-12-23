<?php

    include '../login/log_connection.php';

    $mydata = file_get_contents("php://input");
    $data = json_decode($mydata,true);

    $id = $data['user_id'];

    $sql = "insert into users (user_id,username,user_password) values('{$id}','{$data['username']}','{$data['password']}')
    ON DUPLICATE KEY UPDATE username = '{$data['username']}',user_password='{$data['password']}'";
    $result = mysqli_query($conn,$sql);

    if($result){
        echo "Insert Succesfully";
    }else{
        echo "Issue !";
    }
?>