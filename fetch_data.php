<?php

    include '../login/log_connection.php';

    $sql = "select * from users";
    $result = mysqli_query($conn,$sql);
    $arr = array();
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $arr[] = $row;
        }
    }else{

    }

    echo json_encode($arr);
?>