
<?php
if($_FILES['yes']['name']){
  echo $_FILES['yes']['tmp_name'];
    move_uploaded_file($_FILES['file']['tmp_name'],$_FILES['file']['name']);
}
?>

 <?php
// Baca lokasi file sementar dan nama file dari form (fupload)
$lokasi_file = $_FILES['fupload']['tmp_name'];
$nama_file   = $_FILES['fupload']['name'];
$kategori =$_POST['jurusan'];

if ($kategori == "ipa"){
	echo "ipa non";
}
else{
	echo "la keruan";
}
// Tentukan folder untuk menyimpan file
$folder = "file/$nama_file";
// tanggal sekarang
//$tgl_upload = date("Ymd");
// Apabila file berhasil di upload
if (move_uploaded_file($lokasi_file,"$folder")){
  echo "Nama File : <b>$nama_file</b> sukses di upload";
  
  // Masukkan informasi file ke database
  $konek = mysqli_connect('localhost','root','','jokedb');

  $query = "INSERT INTO buku2 (id,nama,deskripsi) VALUES  (null,'$nama_file','$_POST[deskripsi]')";
          
  mysqli_query($konek, $query);
}

else{
  echo "File gagal di upload";
}
?>