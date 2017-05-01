<?php
    $key=$_GET['key'];
    $array = array();
    $con=mysqli_connect("localhost","root","");
    $db=mysqli_select_db("demos",$con);
    $query=mysqli_query($link,"select * from cfg_demos where title LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['title'];
    }
    echo json_encode($array);
?>
