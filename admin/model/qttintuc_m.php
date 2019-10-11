<?php
include "../../model/database.php";

/**
 * 
 */
class qttintuc_m extends database
{

	function get_ID_Table($table){
		$sql = "SELECT ID From $table";
		$this->setQuery($sql);
		return $this->loadAllRows(array($table));
	}

// qt tin bai
	// thêm
	function set_tinbai($TieuDe, $TieuDeKhongDau, $TomTat, $NoiDung, $Hinh, $user_create, $ID_LoaiTin)
	{
		$sql = "INSERT INTO `tintuc` (`TieuDe`, `TieuDeKhongDau`, `TomTat`, `NoiDung`, `Hinh`, `user_create`, `ID_LoaiTin`) VALUES ('$TieuDe', '$TieuDeKhongDau', '$TomTat', '$NoiDung', '$Hinh', '$user_create', '$ID_LoaiTin')";
		$this->setQuery($sql);

		return $this->loadAllRows();
	}
// lấy
	function get_tinbai($id_user , $role){
		if($role < 2){
			$sql = "SELECT  tt.ID as ID, lt.Ten, tt.TieuDe as tieude, tt.TomTat as tomtat, tt.NoiDung as noidung, tt.Create_at as time_cus FROM tintuc tt INNER JOIN loaitin lt ON tt.ID_LoaiTin = lt.ID Where tt.user_create = $id_user GROUP BY tt.ID";
		}else if($role == 2){
			$sql = "SELECT  tt.ID as ID, lt.Ten, tt.TieuDe as tieude, tt.TomTat as tomtat, tt.NoiDung as noidung, tt.Create_at as time_cus FROM tintuc tt INNER JOIN loaitin lt ON tt.ID_LoaiTin = lt.ID GROUP BY tt.ID";
		}else return false;

		$this->setQuery($sql);

		return $this->loadAllRows();
	}

	function get_tinbai_byID($id){
		$sql = "SELECT loaitin.Ten, loaitin.ID as LoaiTin_ID ,tintuc.* FROM tintuc INNER JOIN loaitin ON tintuc.ID_LoaiTin = loaitin.ID WHERE tintuc.ID = $id";
		$this->setQuery($sql);
		return $this->loadRow();
	}
// xoa
	function delete_tinbai($id_tin){
		$sql = "DELETE FROM `tintuc` WHERE `tintuc`.`ID` = $id_tin";
		$this->setQuery($sql);
		return $this->loadRow();
	}
// sua
	function update_tinbai($id, $ID_LoaiTin, $TieuDe, $khongdau, $tomtat, $noidung){
		$sql = "UPDATE `tintuc` SET `TieuDe` = '$TieuDe', `TieuDeKhongDau` = '$khongdau', `TomTat` = '$tomtat', `NoiDung` = '$noidung', `ID_LoaiTin` = '$ID_LoaiTin', `Update_at` = CURRENT_TIMESTAMP WHERE `tintuc`.`ID` = $id";
		$this->setQuery($sql);
		return $this->loadRow();
	}

	function get_menu($level){
		$sql = "SELECT * FROM $level";
		$this->setQuery($sql);

		return $this->loadAllRows();
	}
// qt menu
	function set_menu($ID, $ID_TheLoai, $Ten, $TenKhongDau, $number){
		if($number == 1){
			$sql = "INSERT INTO `theloai` (`ID`, `Ten`, `TenKhongDau`) VALUES ('$ID', '$Ten', '$TenKhongDau')";
		}
		if($number == 2){
			$sql = "INSERT INTO `loaitin` (`ID`, `ID_TheLoai`, `Ten`, `TenKhongDau`) VALUES ('$ID', '$ID_TheLoai', '$Ten', '$TenKhongDau')";
		}
		$this->setQuery($sql);
		return $this->loadRow();
	}

	function get_menu_byID($id , $table_menu){
		$sql = "SELECT * FROM `$table_menu` WHERE ID = '$id'";
		$this->setQuery($sql);
		return $this->loadRow();
	}

	function update_menu($ID, $Ten, $TenKhongDau, $number){
		if($number == 1){
			$sql = "UPDATE `theloai` SET `Ten` = '$Ten', `TenKhongDau` = '$TenKhongDau', `Update_at` = CURRENT_TIMESTAMP WHERE `theloai`.`ID` = '$ID'";
		}
		if($number == 2){
			$sql = "UPDATE `loaitin` SET `Ten` = '$Ten', `TenKhongDau` = '$TenKhongDau', `Update_at` = CURRENT_TIMESTAMP WHERE `loaitin`.`ID` = '$ID'";
		}
		$this->setQuery($sql);
		return $this->loadRow();
	}

	function delete_menu($id , $table_menu){
		$sql = "DELETE FROM `$table_menu` WHERE `$table_menu`.`ID` = '$id'";
		$this->setQuery($sql);
		return $this->loadRow();
	}
}