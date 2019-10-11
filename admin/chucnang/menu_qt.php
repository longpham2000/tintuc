<?php
if(session_id() === "") session_start();

include '../controller/qttintuc_c.php';
$qttintuc_c = new qttintuc_c;
if($_SESSION['role'] != 2)header("location: ../../index.php");
$loaitin = $qttintuc_c->get_menu_c('loaitin');
$theloai = $qttintuc_c->get_menu_c('theloai');
//print_r($theloai);die;


?>
<!DOCTYPE html>
<html>
<head>
	<title>nhóm 9</title>
	<link rel="stylesheet" type="text/css" href="../../public/css/admin.css">
	<link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.min.css">
</head>
<body>

<div class="container">
	<h2>Danh sách <strong>Thể Loại</strong> </h2>
	  <?php
	    if(isset($_SESSION['thongbao1'])){
	      ?>
	        <div class="alert alert-success"><?=$_SESSION['thongbao1']?></div>
	      <?php
	      unset($_SESSION['thongbao1']);
	    }
	  ?>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th style="text-align: center;">Mã Thể Loại</th>
				<th style="text-align: center;">Tên Thể Loại</th>
				<th style="text-align: center;">Thời Gian Tạo</th>
				<th style="text-align: center;">Thời Gian Update</th>
				<th style="text-align: center;">Chức Năng</th>
			</tr>
			
		</thead>
		<tbody>
			<?php
				foreach ($theloai['theloai'] as $key ) {
					
			?>
			<tr>
				<td style="text-align: center;"><?=$key->ID?></td>
				<td style="text-align: center;"><?=$key->Ten?></td>
				<td style="text-align: center;"><?=$key->Create_at?></td>
				<td style="text-align: center;"><?=$key->Update_at?></td>

				<td style="text-align: center;">
					<a class="btn btn-primary" href="them_loaitin.php?theloai=<?=$key->ID?>&ten=<?=$key->Ten?>">Thêm Loại Tin</a>
					<a class="btn btn-warning" href="sua_menu.php?theloai=<?=$key->ID?>">Sửa</a>
					<a class="btn btn-danger" href="xoa_menu.php?theloai=<?=$key->ID?>">Xóa</a>
				</td>

			</tr>
			<?php
				}
			?>
			
		</tbody>
	</table>

</div>

<div class="container">
	<h2>Danh sách <strong>Loại Tin</strong> </h2>
	  <?php
	    if(isset($_SESSION['thongbao2'])){
	      ?>
	        <div class="alert alert-success"><?=$_SESSION['thongbao2']?></div>
	      <?php
	      unset($_SESSION['thongbao2']);
	    }
	  ?>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th style="text-align: center;">Mã Loại Tin</th>
				<th style="text-align: center;">Thuộc Thể Loại</th>
				<th style="text-align: center;">Tên Loại Tin</th>
				<th style="text-align: center;">Thời Gian Tạo</th>
				<th style="text-align: center;">Thời Gian Update</th>
				<th style="text-align: center;">Chức Năng</th>
			</tr>
		</thead>

		<tbody>
			<?php
				foreach ($loaitin['loaitin'] as $key) {
				
			?>
			<tr>
				<td style="text-align: center;"><?=$key->ID?></td>
				<td style="text-align: center;">
					<?php
						foreach ($theloai['theloai'] as $key1 ) {
							if ($key->ID_TheLoai == $key1->ID) {
								echo $key1->Ten;
							}
						}
					?>

				</td>
				<td style="text-align: center;"><?=$key->Ten?></td>
				<td style="text-align: center;"><?=$key->Create_at?></td>
				<td style="text-align: center;"><?=$key->Update_at?></td>
				<td style="text-align: center;">
					<a class="btn btn-warning" href="sua_menu.php?loaitin=<?=$key->ID?>">Sửa</a>
					<a class="btn btn-danger" href="xoa_menu.php?loaitin=<?=$key->ID?>">Xóa</a>
				</td>
			</tr>
			<?php
				}
			?>
		</tbody>
	</table>

</div>


<script src="../../public/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../../public/js/bootstrap.min.js"></script>
    <script src="../../public/js/my.js"></script>
</body>
</html>