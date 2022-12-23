<?php

    include '../connection.php';

    $sql = "select * from student";

    $result = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($result);

    echo json_encode($count);
?>