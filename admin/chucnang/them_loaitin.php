<?php
if(session_id() === "") session_start();

include '../controller/qttintuc_c.php';

$qttintuc_c = new qttintuc_c;
if(isset($_GET['theloai']) && isset($_GET['ten'])){
	$id = $_GET['theloai'];
	$ten = $_GET['ten'];
	if(isset($_POST['submit'])){
		$ten_loaitin = isset($_POST['lt']) ? $_POST['lt'] : 0 ;
		$lt_khong_dau = isset($_POST['lt_khong_dau']) ? $_POST['lt_khong_dau'] : 0 ;
		$lt_ghi_tat = isset($_POST['lt_ghi_tat']) ? $_POST['lt_ghi_tat'] : 0 ;

		if($ten_loaitin && $lt_khong_dau && $lt_ghi_tat){
			$qttintuc_c->set_menu2_c($id, $ten_loaitin, $lt_khong_dau, $lt_ghi_tat);
		}
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="../../public/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container" style="margin-top: 50px">
		<h2>Thể Loại <strong><?=$ten?></strong> </h2>
		<form action="them_loaitin.php?theloai=<?=$id?>&ten=<?=$ten?>" method="POST">
					<div class="form-group">
			<!-- loại tin -->
						<label for="lt">loại tin</label>
						<textarea class="form-control" rows="1" name="lt"></textarea>
					</div>
			<!-- không dấu -->
					<div class="form-group">
						<label for="lt_khong_dau">loại tin ghi liền không dấu</label>
						<textarea class="form-control" rows="1" name="lt_khong_dau"></textarea>
					</div>
			<!-- loại tin ghi tắt -->
					<div class="form-group">
						<label for="lt_ghi_tat">loại tin ghi tắt</label>
						<textarea class="form-control" rows="1" name="lt_ghi_tat"></textarea>
					</div>
					
			<!-- nút -->
					<input class="btn btn-danger" type="submit" name="submit" value="lưu menu đa cấp">
				</form>

	</div>

<script src="../../public/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/my.js"></script>
</body>
</html>