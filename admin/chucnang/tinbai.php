<?php
if(session_id() ==="")
session_start();

include "../controller/upfile.php";
include '../controller/qttintuc_c.php';
$qttintuc_c = new qttintuc_c;
$upfile = new upfile();
$qttintuc_c->set_ID_number('loaitin');
$menu = $qttintuc_c->get_menu_c();
//print_r($menu);die;
//print_r($test->set_ID_number('loaitin')[4]->ID);
// if(isset($_FILES['hinh'])){
// 	print_r($_FILES['hinh']);
// 	$upfile->tach('hinh');
// 	$upfile->ktduoi();
// 	// if($_FILES['hinh']['size']>= 1*1024*1024){
// 	// 	echo 'file quá lớn'. 1*1024*1024;
// 	// }
// 	// else
// 	// move_uploaded_file($_FILES['hinh']['tmp_name'], "../../upload/lonp.png");
// }
$alert = [
	'trangthai' => 0,
	'menu' => 'thiếu thể loại hoặc loại tin',
	'tieude' => 'thiếu tiêu đề',
	'td_khongdau' => 'thiếu tiêu đề không dấu',
	'tomtat' => 'thiếu tóm tắt tin',
	'noidung' => 'thiếu nội dung',
	'hinh' => 'thiếu hình'
];

if (isset($_POST['submit'])) {
	$alert['trangthai'] = 1;
	$hinh = $_FILES['hinh']['name'] != '' ? 1 : 0 ;
	$loaitin = $_POST['loaitin'] != 2 ? $_POST['loaitin'] : 0 ;
	$tieude = $_POST['tieude'] != '' ? $_POST['tieude'] : 0 ;
	$td_khongdau = $_POST['td_khongdau'] != '' ? $_POST['td_khongdau'] : 0 ;
	$tomtat = $_POST['tomtat'] != '' ? $_POST['tomtat'] : 0 ;
	$noidung = $_POST['noidung'] != '' ? $_POST['noidung'] : 0 ;
	
	if ($loaitin && $tieude && $td_khongdau && $tomtat && $noidung && $hinh) {
		$alert['trangthai'] = 0;
		if(isset($_SESSION['id_user'])){
			$user_create = $_SESSION['id_user'];
			$upfile->tach('hinh');
			$hinh = $upfile->ktduoi($td_khongdau);
			$qttintuc_c->set_tintuc_c($tieude, $td_khongdau, $tomtat, $noidung, $hinh, $user_create, $loaitin);
		}
		
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="../../public/css/bootstrap.min.css" rel="stylesheet">
	<script src="../../public/ckeditor/ckeditor.js"></script>
</head>
<body>
	<div class="container">
		<form action="tinbai.php" method="POST" enctype="multipart/form-data">
<!-- menu star-->
		
	<!-- menu c1-->
			<label for="sel2">chọn loại tin</label>
			<select class="form-control" id="sel2" name="loaitin">
				<option value="2">chọn loại tin</option>
				<?php
				//print_r($menu['loaitin']); die;
					foreach ($menu['loaitin'] as $key) {
						?>
						<option value="<?=$key->ID?>"><?=$key->Ten?></option>
						<?php
					}
				?>
				
			</select>
			
				<?php
					if($alert['trangthai'])
						if( $loaitin){}else{
					?>
					<div class="alert alert-danger"><strong><?=$alert['menu']?></strong></div>
					<?php }
				?>
<!-- menu end-->

<!-- tiêu đề -->
			<div class="form-group">
				<label for="comment">Tiêu đề</label>
				<textarea class="form-control" rows="5" name="tieude" id="tieude"></textarea>
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
				<textarea class="form-control" rows="5" name="td_khongdau"></textarea>
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
				<textarea class="form-control" rows="5" name="tomtat" id="tomtat"></textarea>
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
				<textarea class="form-control" rows="5" name="noidung" id="noidung"></textarea>
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
			<div class="form-group">
				<label for="comment">Hình</label>
				<?php
					if(!$upfile->ktduoi()){
				?><label for="comment">chỉ đuôi 'png' 'jpg'</label><?php
					}
				?>
			<input type="file" name="hinh">
				<?php
					if($alert['trangthai'])
						if($hinh == 0){
					?>
					<div class="alert alert-danger"><strong><?=$alert['hinh']?></strong></div>
					<?php }
				?>
			</div>
			<input class="btn btn-primary" type="submit" name="submit" value="gửi">
		</form>
	
	</div>
	
	<script src="../../public/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/my.js"></script>
</body>
</html>