<?php

    include '../connection.php';

    $mydata = file_get_contents("php://input");
    $data = json_decode($mydata,true);
    if(isset($data['page'])){
        $dt = $data['page'];
    }else{
        $dt = 1;
    }
    
    $limit = 3;
    $offset = ($dt - 1) * $limit;
    
    
    $sql = "select * from student join studentclass where student.sclass = studentclass.cid LIMIT {$offset} , {$limit}";
    $result = mysqli_query($conn,$sql);
    $array = array();

    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            $array[] = $row;
        }
    }else{
        echo "<tr>No Record Found</tr>";
    }

    echo json_encode($array);
?>
