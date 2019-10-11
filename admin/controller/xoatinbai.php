<?php
if(session_id() === '') session_start();

if(isset($_SESSION['id_user'])){
	if(isset($_GET['idtin'])){
		include '../model/qttintuc_m.php';
		$delete_tin = new qttintuc_m();
		$delete_tin->delete_tinbai($_GET['idtin']);
		$_SESSION['thongbao'] = 'xóa thành công';
		header('location:'.$_SERVER['HTTP_REFERER']);
	}
}

?>