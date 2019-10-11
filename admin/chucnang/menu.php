<?php
include '../controller/qttintuc_c.php';

$qttintuc = new qttintuc_c;
$error =0;
if(isset($_POST['submit'])){
	$lt = $_POST['lt'] != ""  ? $_POST['lt'] :0;
	$lt_khong_dau = $_POST['lt_khong_dau'] != ""  ? $_POST['lt_khong_dau'] :0;
 	$lt_ghi_tat = $_POST['lt_ghi_tat'] != "" ? $_POST['lt_ghi_tat'] :0;
	$tl = $_POST['tl'] != "" ? $_POST['tl'] :0;
	$tl_khong_dau = $_POST['tl_khong_dau'] != "" ? $_POST['tl_khong_dau'] :0;
	$tl_ghi_tat = $_POST['tl_ghi_tat'] != "" ? $_POST['tl_ghi_tat'] :0;

	if ($tl && $tl_khong_dau && $tl_ghi_tat && $lt && $lt_khong_dau && $lt_ghi_tat) {
		$error =2;
		$qttintuc->set_menu_c($tl, $tl_khong_dau, $tl_ghi_tat, $lt, $lt_khong_dau, $lt_ghi_tat);
	}else if($tl && $tl_khong_dau && $tl_ghi_tat){
		$error =2;
		$qttintuc->set_menu_c($tl, $tl_khong_dau, $tl_ghi_tat, "", "", "");
	}else $error =1;
    
}


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../../public/css/admin.css">
	<link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.min.css">
</head>
<body><div class="space20"></div>
	<div class="container">
		
		<div class="row carousel-holder">
				<div class="panel-body">
					<?php
						if($error == 1){
							?>
							<div class="alert alert-danger"><strong>không thành công</strong></div>
							<?php
						}else if($error == 2){?>
						<div class="alert alert-success"><strong>thành công</strong></div>
						<?php
					}
					?>
					
					
				<form action="menu.php" method="POST">
					<div class="form-group">
			<!-- thể loại -->
						<label for="tl">thể loại</label>
						<textarea class="form-control" rows="1" name="tl"></textarea>
					</div>
			<!-- không dấu -->
					<div class="form-group">
						<label for="tl_khong_dau">thể loại ghi liền không dấu</label>
						<textarea class="form-control" rows="1" name="tl_khong_dau"></textarea>
					</div>
			<!-- ghi tắt -->
					<div class="form-group">
						<label for="tl_ghi_tat">thể loại ghi tắt</label>
						<textarea class="form-control" rows="1" name="tl_ghi_tat"></textarea>
					</div>
					<div class="container">
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
					</div>
			<!-- nút -->
					<input class="btn btn-danger" type="submit" name="submit" value="lưu menu đa cấp">
				</form>
				</div>
			</div>
		</div>
	</div>
	<script src="../../public/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/my.js"></script>
</body>
</html>