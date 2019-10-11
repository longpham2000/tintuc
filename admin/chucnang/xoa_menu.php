<?php
if(session_id() === "") session_start();

include '../controller/qttintuc_c.php';
$qttintuc_c = new qttintuc_c;
if (isset($_GET['theloai'])) {
	$qttintuc_c->delete_menu_c($_GET['theloai'] , 'theloai');
	$_SESSION['thongbao1'] = "xóa thành công thể loại";
	header("location:menu_qt.php");

}else if(isset($_GET['loaitin'])){
	$qttintuc_c->delete_menu_c($_GET['loaitin'] , 'loaitin');
	$_SESSION['thongbao2'] = "xóa thành công loai tin";
	header("location:menu_qt.php");
}
?>