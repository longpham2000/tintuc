<?php
include '../controller/qttintuc_c.php';
if(session_id() === "") session_start();
$qttintuc_c = new qttintuc_c;

if(isset($_GET['theloai'])){
	$id = $_GET['theloai'];
	$ten = 'theloai';
	$number_control =1;
	$theloai = $qttintuc_c->get_menu_byID_c($id , 'theloai');

	$tl = isset($_POST['tl']) ? $_POST['tl'] : 0;
	$tl_khong_dau = isset($_POST['tl_khong_dau']) ? $_POST['tl_khong_dau'] : 0;
	
	if($tl && $tl_khong_dau){
		$qttintuc_c->update_menu_c($id , $tl, $tl_khong_dau, 1);
		$_SESSION['thongbao1'] = "sửa thể loại thành công";
		header("location: menu_qt.php");

	}

}elseif (isset($_GET['loaitin'])) {
	$id = $_GET['loaitin'];
	$ten = 'loaitin';
	$number_control =0;
	$loaitin = $qttintuc_c->get_menu_byID_c($id , 'loaitin');

	$lt = isset($_POST['lt']) ? $_POST['lt'] : 0;
	$lt_khong_dau = isset($_POST['lt_khong_dau']) ? $_POST['lt_khong_dau'] : 0;
	if($lt && $lt_khong_dau){
		$qttintuc_c->update_menu_c($id , $lt, $lt_khong_dau, 2);
		$_SESSION['thongbao2'] = "sửa loại tin thành công";
		header("location: menu_qt.php");
	}

}



//print_r($theloai);die;

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.min.css">
</head>
<body>

	<?php
		if($number_control){
			?>
			<div class="container" style="margin-top: 50px">
				<form action="sua_menu.php?<?=$ten?>=<?=$id?>" method="POST">
							<div class="form-group">
					<!-- loại tin -->
								<label for="lt">thể loại</label>
								<textarea class="form-control" rows="1" name="tl"><?=$theloai->Ten?></textarea>
							</div>
					<!-- không dấu -->
							<div class="form-group">
								<label for="lt_khong_dau">loại tin ghi liền không dấu</label>
								<textarea class="form-control" rows="1" name="tl_khong_dau"><?=$theloai->TenKhongDau?></textarea>
							</div>
		
					<!-- nút -->
							<input class="btn btn-danger" type="submit" name="submit" value="sửa thể loại">
						</form>

			</div>
			<?php
		}else {
			?>
				<div class="container" style="margin-top: 50px">
					<form action="sua_menu.php?<?=$ten?>=<?=$id?>" method="POST">
								<div class="form-group">
						<!-- loại tin -->
									<label for="lt">loại tin</label>
									<textarea class="form-control" rows="1" name="lt"><?=$loaitin->Ten?></textarea>
								</div>
						<!-- không dấu -->
								<div class="form-group">
									<label for="lt_khong_dau">loại tin ghi liền không dấu</label>
									<textarea class="form-control" rows="1" name="lt_khong_dau"><?=$loaitin->TenKhongDau?></textarea>
								</div>
						
						<!-- nút -->
								<input class="btn btn-danger" type="submit" name="submit" value="Sửa loại tin">
							</form>

				</div>

			<?php
		}

	?>

	<script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
     <!-- Bootstrap Core JavaScript -->
    <script src="../../public/js/my.js"></script>
</body>
</html>