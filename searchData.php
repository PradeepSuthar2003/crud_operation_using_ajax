<?php

    include '../connection.php';

    $search = $_GET['search'];

    $sql = "select * from student join studentclass on student.sclass = studentclass.cid where sname like '{$search}%'";
    $result = mysqli_query($conn,$sql);
    $array = array();
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $array[] = $row;
        }
    }else{
        echo '0';
    }

    echo json_encode($array);
?>