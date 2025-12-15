<?php
include  "../koneksi/koneksi.php";
$id = $_POST['id'];

	$name=$_FILES['file_video']['name'];
    $type=$_FILES['file_video']['type'];
    $size=$_FILES['file_video']['size'];
    $nama_file=str_replace(" ","_",$name);
    $tmp_name=$_FILES['file_video']['tmp_name'];
    $nama_folder="../img/";
    $file_baru=$nama_folder.basename($nama_file);
	if ((($type == "video/mp4") || ($type == "video/3gpp")) && ($size < 102428800 )){
	move_uploaded_file($tmp_name,$file_baru);
	   $sql = "UPDATE aplikasi SET video='$nama_file'  WHERE id = '$id'";
	   $proses = mysqli_query($koneksi,$sql);
		if ($proses) {
			header('location:../video?sukses='.base64_encode("Terimakasih Video anda telah diupdate.").'');
		} else { echo "Data belum dapat di simpan!!"; 
		}
    } else {
        	move_uploaded_file($tmp_name,$file_baru);
	   $sql = "UPDATE aplikasi SET video='$nama_file'  WHERE id = '$id'";
	   $proses = mysqli_query($koneksi,$sql);
		if ($proses) {
			header('location:../video?sukses='.base64_encode("Terimakasih Video anda telah diupdate.").'');
		} else { echo "Data belum dapat di simpan!!"; 
		}
    }



  
?>