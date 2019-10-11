<?php
$link_in = 'admin/';
$link_out = "";


include_once ('controller/c_users.php');
include_once 'admin/model/role.php';
$c_user = new c_users();
if(isset($_POST['dangnhap'])){
    $taikhoan = $_POST['taikhoan'];
    $password = $_POST['password'];
    $user = $c_user->dangnhap($taikhoan, md5($password));

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> nhóm 9</title>

    <!-- Bootstrap Core CSS -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="public/css/shop-homepage.css" rel="stylesheet">
    <link href="public/css/my.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.public/js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <?php include 'piece_index/head.php'; ?>

    <!-- Page Content -->
    <div class="container" style="height: 600px;">

    	<!-- slider -->
    	<div class="row carousel-holder">
    		<div class="col-md-4"></div>
            <div class="col-md-4">
                <?php
                        if(isset($_SESSION['user_error'])){
                        echo "<div class='alert alert-danger'>".($_SESSION['user_error'])."</div>";
                        }

                        ?>
                <div class="panel panel-default">

				  	<div class="panel-heading">Đăng nhập</div>
				  	<div class="panel-body">
				    	<form method="POST" action="#">
							<div>
				    			<label>tài khoản</label>
							  	<input type="text" class="form-control" placeholder="tài khoản" name="taikhoan" 
							  	>
							</div>
							<br>	
							<div>
				    			<label>Mật khẩu</label>
							  	<input type="password" class="form-control" name="password">
							</div>
							<br>
							<button type="submit" name="dangnhap" class="btn btn-success">Đăng nhập
							</button>
				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- end slide -->
    </div>
    </div>
    <div style="background: #545251;">
        <hr>
        <div class="space20"></div>
        <div class="container" style="background: #e6f0f7;">
            <?php include 'piece_index/footer.php' ?>
        </div>
        <div class="space20"></div>
        
        

    </div>
    <!-- end Page Content -->

 
    <!-- end Footer -->
    <!-- jQuery -->
    <script src="public/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/my.js"></script>

</body>

</html>
