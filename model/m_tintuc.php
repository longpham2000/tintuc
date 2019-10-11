<?php 
include('database.php');

class M_tintuc extends database{


	function getMenu(){

		$sql = "SELECT tl.*,GROUP_CONCAT(Distinct lt.ID,':', lt.Ten,':', lt.TenKhongDau) AS loaitin, tt.ID as idTin, tt.TieuDe as TieuDeTin, tt.TieuDeKhongDau as TieuKhongDauTin, tt.TomTat as TomTatTin, tt.Hinh as HinhTin, tt.Create_at as tintime FROM theloai tl INNER JOIN loaitin lt ON lt.ID_TheLoai = tl.ID INNER JOIN tintuc tt ON tt.ID_LoaiTin = lt.ID GROUP BY tl.ID";
		$this->setQuery($sql);
		return $this->loadAllRows();
	}

	function getTinTucByIdLoai($ID_loaitin, $vitri=-1, $limit=-1){
		$sql = "SELECT * from tintuc WHERE ID_LoaiTin = '$ID_loaitin' ";
		if($vitri>-1 && $limit>1){
			$sql .= "limit $vitri,$limit";
		}
		$this->setQuery($sql);
		return $this->loadAllRows(array($ID_loaitin));
	}
	function getTitleById($ID_loaitin){
		$sql = "SELECT Ten,TenKhongDau FROM loaitin WHERE ID = '$ID_loaitin'";

		$this->setQuery($sql);
		return $this->loadRow(array($ID_loaitin));
	}

	function getChiTietTin($ID){
		$sql = "SELECT u.Ten as user, tt.* FROM tintuc tt INNER JOIN user u ON tt.user_create = u.ID WHERE tt.ID = $ID";
		$this->setQuery($sql);
		return $this->loadRow();
	}
	function getComment($ID_m){
		$sql = "SELECT binhluan.*,user.Ten FROM binhluan INNER JOIN user ON binhluan.ID_User = user.ID WHERE binhluan.ID_Tin = $ID_m";
		$this->setQuery($sql);
		return $this->loadAllRows(array($ID_m));
	}
	function getRelatedNew($alias){
		$sql = "SELECT tt.*,lt.TenKhongDau as TenKhongDau, lt.ID as IDloaitin FROM tintuc tt INNER JOIN loaitin lt ON tt.ID_LoaiTin = lt.ID WHERE lt.TenKhongDau = '$alias' limit 0,5";
		$this->setQuery($sql);
		return $this->loadAllRows(array($alias));
	}
	
	function addcomment($ID_user, $ID_tin, $noIDung){
		$sql = "INSERT INTO binhluan(ID_User,ID_Tin,NoIDung) VALUES (?,?,?)";
		$this->setQuery($sql);
		return $this->execute(array($ID_user,$ID_tin,$noIDung));
	}
	function search($key){
		$sql = "SELECT tt.*, lt.TenKhongDau as ten_khong_dau FROM tintuc tt INNER JOIN loaitin lt ON tt.ID_LoaiTin = lt.ID WHERE tt.TieuDe like '%$key%' or tt.TomTat like '%$key%'";
		$this->setQuery($sql);
		return $this->loadAllRows(array($key));
	}

	function set_views($id_tin , $view){
		$sql = "UPDATE tintuc SET Luotxem = $view WHERE ID = $id_tin";
		$this->setQuery($sql);
		return $this->loadRow();
	}

	function get_views($id_tin){
		$sql = "SELECT Luotxem FROM tintuc WHERE ID = $id_tin";
		$this->setQuery($sql);
		return $this->loadRow();
	}
}
?>