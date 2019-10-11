<?php
if(session_id() === "")
session_start();

$link_in = "";
$link_out = '../';

include_once "controller/role.php";

if(session_id() === "")
session_start();

$number_role = 0;

if(isset($_SESSION['role'])){
	$number_role = $_SESSION['role'];
	
}else if($number_role == 0) header('location: ../dangnhap.php');

if(isset($_POST['submit'])){
	include_once '../controller/c_users.php';
	$c_user = new c_users;
	$c_user->dangxuat($link_out);
	
}


?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../public/css/admin.css">
	<link rel="stylesheet" type="text/css" href="../public/css/bootstrap.min.css">
</head>
<body>
	<div class="top2">
		<img src="../public/image/backgoungadmin.jpg" width="100%" height="150px">
	</div>
	<div class="body">
		<div class="menu">
			<ul>
<!-- menu -->
			<?php
				if($number_role == 1 || $number_role ==2){
				?>
				<li><a href="chucnang/tinbai_qt.php" target="link">Quản Trị Tin Bài</a></li>
				<li><a href="chucnang/tinbai.php" target="link">Tạo Tin Bài</a></li>
				<?php
				}
			?>
			<?php
				if($number_role == 2){
				?>
				<li><a href="chucnang/menu_qt.php" target="link">Quản Trị Menu</a></li>
				<li><a href="chucnang/menu.php" target="link">tạo Menu</a></li>
				<?php
				}
			?>
				
			</ul>
<!-- nút -->
			<form action="" method="POST">
				<input id="button" class="btn btn-primary" type="submit" name="submit" value="Đăng Xuất">
				<a id="button" href="../index.php" class="btn btn-primary" >trang chủ</a>
			</form>

					</div>
		<iframe src="" name="link"></iframe>
	</div>
	

	<div class="footer" >
        <hr>
        <div class="container" style="background: #e6f0f7;">
            <?php include '../piece_index/footer.php' ?>
        </div>
        
        

    </div>



	<script src="../public/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../public/js/bootstrap.min.js"></script>
    <script src="../public/js/my.js"></script>
</body>
</html>