<?php

include  "../koneksi/koneksi.php";

$id = $_POST['id'];
$id_user = $_POST['id_user'];
$nama_aplikasi = $_POST['nama_aplikasi'];
$alamat = $_POST['alamat'];
$nama_perusahaan = $_POST['nama_perusahaan'];
$header = $_POST['header'];
$footer = $_POST['footer'];
$text_header = $_POST['text_header'];
$text_isi = $_POST['text_isi'];
$text_footer = $_POST['text_footer'];
$jam = $_POST['jam'];
$logo =  "file_".date("YmdHis").".". basename( $_FILES['logo']['name']); //ubah nama file
$background =  "file_".date("YmdHis").".". basename( $_FILES['background']['name']); //ubah nama file

$cek = mysqli_num_rows(mysqli_query($koneksi,"SELECT * from aplikasi where id='$id' AND id_user ='$id_user'"));

if ($cek==0){

if(!empty($_FILES['logo']['name']) || !empty($_FILES['background']['name'])){
 
$target1 = "../img/$logo"; //Tempat file

//This code writes the photo to the server//
//--------------------------------Photo 1----------------------------
 move_uploaded_file($_FILES['logo']['tmp_name'], $target1);

$target2 = "../img/$background"; //Tempat file

//This code writes the photo to the server//
//--------------------------------Photo 1----------------------------
 move_uploaded_file($_FILES['background']['tmp_name'], $target2);

$sql = "INSERT INTO aplikasi (id_user,nama_aplikasi,logo,background,nama_perusahaan,header,footer,jam, text_header, text_isi, text_footer) VALUES ('$id_user','$nama_aplikasi','$logo', '$background', '$nama_perusahaan', '$header', '$footer', '$jam','$text_header','$text_isi','$text_footer')";
} else {
$sql = "INSERT INTO aplikasi (id_user,nama_aplikasi,nama_perusahaan,header.footer,jam, text_header, text_isi, text_footer) VALUES ('$id_user','$nama_aplikasi','$nama_perusahaan', '$header', '$footer', '$jam','$text_header','$text_isi','$text_footer')";
} 
	
}else{
if(!empty($_FILES['logo']['name']) || !empty($_FILES['background']['name'])){
 
$target1 = "../img/$logo"; //Tempat file

//This code writes the photo to the server//
//--------------------------------Photo 1----------------------------
 move_uploaded_file($_FILES['logo']['tmp_name'], $target1);

$target2 = "../img/$background"; //Tempat file

//This code writes the photo to the server//
//--------------------------------Photo 1----------------------------
 move_uploaded_file($_FILES['background']['tmp_name'], $target2);

$sql = "UPDATE aplikasi set nama_aplikasi='$nama_aplikasi',alamat='$alamat', logo='$logo', background='$background', nama_perusahaan='$nama_perusahaan', header='$header', footer='$footer', jam='$jam' , text_header='$text_header', text_isi='$text_isi', text_footer='$text_footer' WHERE id='$id'";
} else {
$sql = "UPDATE aplikasi set nama_aplikasi='$nama_aplikasi',alamat='$alamat', nama_perusahaan='$nama_perusahaan', header='$header', footer='$footer', jam='$jam', text_header='$text_header', text_isi='$text_isi', text_footer='$text_footer' WHERE id='$id'";
} 

}
$proses = mysqli_query($koneksi,$sql);
	if ($proses) {
		header('location:../setting?sukses='.base64_encode("Halaman Front End telah berhasil diupdate").'');
	} else { echo "Data belum dapat di simpan!!"; 
	}
?>

