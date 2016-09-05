<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'jokedb');

class DB_con
{
 function __construct()
 {
  $conn = mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die('localhost connection problem'.mysql_error());
  mysql_select_db(DB_NAME, $conn);
 }
 
 public function insert($nama,$jurusan)
 {
  $res = mysql_query("INSERT mahasiswa(nama,jurusan) VALUES('$nama','$jurusan')");
  return $res;
 }
 
 public function select()
 {
  $res=mysql_query("SELECT * FROM users");
  return $res;
 }
}
?>