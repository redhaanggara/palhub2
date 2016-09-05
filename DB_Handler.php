<?php


class DB_Handler{
	private $db = null;
	public function __Construct (){
		$this->db = new DB_Connection();
	}


	public function save ($name){
		$conn = $this->db->connect();
		$query = "INSERT INTO buku3(id,nama) VALUES (null,'".$name."')";
		$resut = $conn->query($query) or die ($conn->error.__LINE__);
		$conn->close();
		retrun $resut;
	}

}

?>