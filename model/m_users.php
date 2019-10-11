<?php

include_once ('database.php');

/**
 * 
 */
class M_users extends database
{
	
	function dangky($name, $taikhoan, $matkhau)
	{
		$sql = "INSERT INTO user(Ten,TaiKhoan,MatKhau) VALUES(?,?,?)";
		$this->setQuery($sql);
		$result = $this->execute(array($name, $taikhoan,md5($matkhau)));
		if($result){
			return $this->getLastId();
		}else{
			return false;
		}
	}
	function dangnhap($taikhoan, $md5_matkhau){
		$sql = "SELECT * FROM user WHERE TaiKhoan = '$taikhoan' AND MatKhau = '$md5_matkhau'";
		$this->setQuery($sql);
		return $this->loadRow(array($taikhoan, $md5_matkhau));
	}
	
}
?>