<?php
include '../model/qttintuc_m.php';

/**
 * 
 */
class qttintuc_c extends qttintuc_m
{
// lấy id chưa có trong csdl
	function set_ID_number ($name_table){
		$name_ID = $this->get_ID_Table($name_table);
		$var_temporary = null;
		$var_remember = 0;
		for ($i=0; $i < count($name_ID); $i++) { 
			
			for ($u=0; $u < count($name_ID); $u++) { 
				$var_temporary=substr( strstr( $name_ID[$u]->ID, '_' ),  1 );
				if($i == $var_temporary){
					$var_remember = 1;
				}
			}
			if (!$var_remember) {
				return $i;
				break;
			}
			$j = $i;
			
		}
		if($j+1 == count($name_ID))return $j+1;
		return 0;
		
	}
// tạo menu
	function set_menu_c($the_loai, $tl_khong_dau, $tl_ghi_tat, $loai_tin, $lt_khong_dau, $lt_ghi_tat)
	{
		if($loai_tin == ''){
			$ID_tl = $tl_ghi_tat.'_';
			$ID_tl .= $this->set_ID_number('theloai');
			$this->set_menu($ID_tl, "", $the_loai, $tl_khong_dau, 1);
		}else {
			$ID_tl = $tl_ghi_tat.'_';
			$ID_lt = $lt_ghi_tat.'_';
			$ID_tl .= $this->set_ID_number('theloai');
			$ID_lt .= $this->set_ID_number('loaitin');

			$this->set_menu($ID_tl, "", $the_loai, $tl_khong_dau, 1);
			$this->set_menu($ID_lt, $ID_tl, $loai_tin, $lt_khong_dau, 2);
		}	
		return true;
	}

	function set_menu2_c($theloai, $loaitin, $lt_khong_dau, $lt_ghi_tat){
		$ID_lt = $lt_ghi_tat.'_';
		$ID_lt .= $this->set_ID_number('loaitin');
		$this->set_menu($ID_lt, $theloai, $loaitin, $lt_khong_dau, 2);
		$_SESSION['thongbao1'] = 'thêm loại tin thành công';
		return header("location:../chucnang/menu_qt.php");
	}

	function get_menu_c($menu2 = "loaitin"){
		$loaitin = $this->get_menu($menu2);
		return array("$menu2"=>$loaitin);
	}

	function get_menu_byID_c($id , $table_menu){
		return $this->get_menu_byID($id , $table_menu);

	}

	function update_menu_c($ID, $Ten, $TenKhongDau, $number){
		return $this->update_menu($ID, $Ten, $TenKhongDau, $number);
	}

	function delete_menu_c($id , $table_menu){
		return $this->delete_menu($id , $table_menu);
	}

	function set_tintuc_c($TieuDe, $TieuDeKhongDau, $TomTat, $NoiDung, $Hinh, $user_create, $ID_LoaiTin){
		$this->set_tinbai($TieuDe, $TieuDeKhongDau, $TomTat, $NoiDung, $Hinh, $user_create, $ID_LoaiTin);
		return true;
	}

	function get_tintuc_c($id_user , $role){
		$tin = $this->get_tinbai($id_user , $role);
		if($tin){
			return array('tinbai' => $tin);
		}else return false; 
		
	}

	function get_tintuc_byID_c($id){
		$tintuc_byID = $this->get_tinbai_byID($id);
		return array('tin' => $tintuc_byID);
	}

	function update_tin($id, $ID_LoaiTin, $TieuDe, $khongdau, $tomtat, $noidung){
		$this->update_tinbai($id, $ID_LoaiTin, $TieuDe, $khongdau, $tomtat, $noidung);
		$_SESSION['thongbao'] = 'update thành công';
		return header("location:../chucnang/tinbai_qt.php");
	}
}