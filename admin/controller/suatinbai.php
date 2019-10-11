<?php
if(session_id() ==="")
session_start();

include "upfile.php";
include 'qttintuc_c.php';
$qttintuc_c = new qttintuc_c;
$upfile = new upfile();
$qttintuc_c->set_ID_number('loaitin');
$menu = $qttintuc_c->get_menu_c();


$tin_byID = $qttintuc_c->get_tintuc_byID_c($_GET['idtin']);


//print_r($tin_byID);die;

$alert = [
	'trangthai' => 0,
	'menu' => 'thiếu thể loại hoặc loại tin',
	'tieude' => 'thiếu tiêu đề',
	'td_khongdau' => 'thiếu tiêu đề không dấu',
	'tomtat' => 'thiếu tóm tắt tin',
	'noidung' => 'thiếu nội dung',
	
];

if (isset($_POST['submit'])) {
	$alert['trangthai'] = 1;
	$id_loaitin = $_POST['id_loaitin'] != '' ? $_POST['id_loaitin'] : 0 ;
	$tieude = $_POST['tieude'] != '' ? $_POST['tieude'] : 0 ;
	$td_khongdau = $_POST['td_khongdau'] != '' ? $_POST['td_khongdau'] : 0 ;
	$tomtat = $_POST['tomtat'] != '' ? $_POST['tomtat'] : 0 ;
	$noidung = $_POST['noidung'] != '' ? $_POST['noidung'] : 0 ;
	
	if ($id_loaitin && $tieude && $td_khongdau && $tomtat && $noidung ) {
		$alert['trangthai'] = 0;
		if(isset($_SESSION['id_user'])){
			
			$user_create = $_SESSION['id_user'];
			$qttintuc_c->update_tin($_GET['idtin'], $id_loaitin, $tieude, $td_khongdau, $tomtat, $noidung);
		}
		
	}else {
			$_SESSION['thongbao'] = "update không thành công ";
			header("location: ../chucnang/tinbai_qt.php");
		}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="../../public/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../public/css/bootstrap.min.css">
	<script src="../../public/ckeditor/ckeditor.js"></script>
</head>
<body>
	<div class="container">
		<form action="suatinbai.php?idtin=<?=$_GET['idtin']?>" method="POST" enctype="multipart/form-data">
<!-- menu star-->
		
	<!-- menu c1-->
			
			<label for="sel2">chọn loại tin</label>
			<p>loai tin hiện tại: <strong></strong></p>
			<select class="form-control" id="sel2" name="id_loaitin">
				<option value="<?=$tin_byID['tin']->LoaiTin_ID?>"><?=$tin_byID['tin']->Ten?></option>
				<?php
				//print_r($menu['id_loaitin']); die;
					foreach ($menu['id_loaitin'] as $key) {
						?>
						<option value="<?=$key->ID?>"><?=$key->Ten?></option>
						<?php
					}
				?>
				
			</select>
			
				<?php
					if($alert['trangthai'])
						if( $id_loaitin){}else{
					?>
					<div class="alert alert-danger"><strong><?=$alert['menu']?></strong></div>
					<?php }
				?>
<!-- menu end-->

<!-- tiêu đề -->
			<div class="form-group">
				<label for="comment">Tiêu đề</label>
				<textarea class="form-control" rows="5" name="tieude" placeholder='' id="tieude"><?=$tin_byID['tin']->TieuDe?></textarea>
				<script>CKEDITOR.replace('tieude');</script>
				<?php
					if($alert['trangthai'])
						if(!$tieude){
					?>
					<div class="alert alert-danger"><strong><?=$alert['tieude']?></strong></div>
					<?php }
				?>
			</div>
<!-- tiêu đề không dấu -->
			<div class="form-group">
				<label for="comment">Tiêu Đề Không Dấu</label>
				<textarea class="form-control" rows="5" name="td_khongdau" placeholder=''><?=$tin_byID['tin']->TieuDeKhongDau?></textarea>
				<?php
					if($alert['trangthai'])
						if(!$td_khongdau){
					?>
					<div class="alert alert-danger"><strong><?=$alert['td_khongdau']?></strong></div>
					<?php }
				?>
			</div>
<!-- tom tat -->
			<div class="form-group">
				<label for="comment">Tóm Tắt Tin</label>
				<textarea class="form-control" rows="5" name="tomtat" placeholder='' id="tomtat"><?=$tin_byID['tin']->TomTat?></textarea>
				<script>CKEDITOR.replace('tomtat');</script>
				<?php
					if($alert['trangthai'])
						if(!$tomtat){
					?>
					<div class="alert alert-danger"><strong><?=$alert['tomtat']?></strong></div>
					<?php }
				?>
			</div>
<!-- noi dung -->
			<div class="form-group">
				<label for="comment">Nội Dung</label>
				<textarea class="form-control" rows="15" name="noidung" id="noidung"><?=substr($tin_byID['tin']->NoiDung, 0)?> </textarea>
				<script>CKEDITOR.replace('noidung');</script>
				<?php
					if($alert['trangthai'])
						if(!$noidung){
					?>
					<div class="alert alert-danger"><strong><?=$alert['noidung']?></strong></div>
					<?php }
				?>
			</div>
<!-- hình -->
			
			<input class="btn btn-primary" type="submit" name="submit" value="gửi">
		</form>
	
	</div>
	
	<script src="../../public/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/my.js"></script>
</body>
</html>