<?php
require_once('koneksi.php');

if($_SERVER['REQUEST_METHOD']=='GET') {

    $sql = "SELECT * FROM maha_tbl ORDER BY nama ASC";
    $res = mysqli_query($conn,$sql);
    $result = array();

    while($row = mysqli_fetch_array($res))
    {
        array_push($result, array('nama'=>$row[1], 'alamat'=>$row[2], 'foto'=>$row[3]));
    }

    echo json_encode(array("value"=>1,"result"=>$result));
    mysqli_close($conn);

}