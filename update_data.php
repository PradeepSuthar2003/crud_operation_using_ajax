<?php

    include '../login/log_connection.php';

    $mydata = file_get_contents("php://input");
    $data = json_decode($mydata,true);
    $arr = array();
    $sql = "select * from users where user_id = {$data['id']}";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $arr[] = $row;
        }
    }else{
        echo "No Record Found";
    }

    echo json_encode($arr);
?>