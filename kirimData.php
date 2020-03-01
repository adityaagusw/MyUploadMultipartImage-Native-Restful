<?php

if($_SERVER['REQUEST_METHOD']=='POST') {

    $response = array();
   //mendapatkan data

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $picture = $_FILES['foto']['name'];

    $target = "uploads/".basename($picture); 
    
    require_once('koneksi.php');
    //Cek nim sudah terdaftar apa belum
    $sql = "SELECT * FROM maha_tbl WHERE nama ='$nama'";

    $check = mysqli_fetch_array(mysqli_query($conn,$sql));

    if(isset($check)){
        $response["value"] = false;
        $response["message"] = "oops! Nama sudah terdaftar!";
        echo json_encode($response);

    }else{

        $sql = "INSERT INTO maha_tbl (nama,alamat,foto) VALUES('$nama','$alamat','$picture')";

        if(mysqli_query($conn,$sql)){

            if(move_uploaded_file($_FILES['foto']['tmp_name'], $target))
            {
                $result["value"] = true;
                $result["message"] = "Success mendaftar!";
                echo json_encode($result);
            }

        }else{
            $result["value"] = false;
            $result["message"] = "Gagal mendaftar!";
            echo json_encode($result);
        }

        mysqli_close($conn);
        
    }
    
}else{
    $response["value"] = false;
    $response["message"] = "oops! Coba lagi!";
    echo json_encode($response);
}

?>