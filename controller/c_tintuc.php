<?php

include('model/m_tintuc.php');
include('model/pager.php');

class C_tintuc{
	
	public function index(){
		$m_tintuc = new M_tintuc();
		$menu = $m_tintuc->getMenu();
		return array('menu'=>$menu);
	}
	public function loaitin(){
		$id_loai = $_GET['id_loai'];
		$m_tintuc = new M_tintuc;
		$danhMucTin = $m_tintuc->getTinTucByIdLoai($id_loai);
		$trang_hientai = (isset($_GET['page']))?$_GET['page']:1;


		$pagination = new pagination(count($danhMucTin), $trang_hientai, 4, 4);
		$paginationHTML = $pagination->showPagination();
		$limit = $pagination->_nItemOnPage;
		$vitri = ($trang_hientai-1)*$limit;
		$danhMucTin = $m_tintuc->getTinTucByIdLoai($id_loai, $vitri, $limit);
		print_r($limit);
		$menu = $m_tintuc->getMenu();
		$title = $m_tintuc->getTitleById($id_loai);
		return array('danhMucTin'=>$danhMucTin, 'menu'=>$menu, 'title'=>$title, 'thanh_phantrang'=>$paginationHTML);
	}

	public function chitiettin(){
		$id_tin=$_GET['id_tin'];
		$alias = $_GET['loai_tin'];
		$m_tintuc = new M_tintuc;
		$chitiettin = $m_tintuc->getChiTietTin($id_tin);
		$comment = $m_tintuc->getComment($id_tin);
		$relatednews = $m_tintuc->getRelatedNew($alias);
		return array('chitiettin'=>$chitiettin, 'comment'=>$comment, 'relatednews'=>$relatednews, );
	}

	public function thembinhluan($id_user, $id_tin, $noidung){
		$m_tintuc = new M_tintuc();
		$binhluan = $m_tintuc->addcomment($id_user, $id_tin, $noidung);
		header('location:'.$_SERVER['HTTP_REFERER']);
	}
	public function timkiem($key){
		$m_tintuc = new M_tintuc();
		$tin = $m_tintuc->search($key);
		return $tin;
	}

	function set_views_c($view){
		$id_tin=$_GET['id_tin'];
		$m_tintuc = new M_tintuc();
		return $m_tintuc->set_views($id_tin , $view);
	}

	function get_views_c(){
		$id_tin=$_GET['id_tin'];
		$m_tintuc = new M_tintuc();
		return $m_tintuc->get_views($id_tin);
	}


}
?>