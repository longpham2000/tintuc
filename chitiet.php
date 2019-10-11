<?php
session_start();
include('controller/c_tintuc.php');
date_default_timezone_set("Asia/Ho_Chi_Minh");

setcookie('view' , 1 , time()+1);


$C_tintuc = new C_tintuc();
$chitiettin = $C_tintuc->chitiettin();
$chitiet = $chitiettin['chitiettin'];
$comment = $chitiettin['comment'];
$relatednews = $chitiettin['relatednews'];

if (!isset($_COOKIE['view'])) {
   
   $view_prosent = $C_tintuc->get_views_c();
    $view_new = $view_prosent->Luotxem + 1;
    $C_tintuc->set_views_c($view_new);
   
   
}

if(isset($_POST['binhluan'])){
    if(isset($_SESSION['id_user'])){
        $id_user = $_SESSION['id_user'];
        $id_tin = $_POST['id_tin'];
        $noidung = $_POST['noidung'];
        $comment1 = $C_tintuc->thembinhluan($id_user, $id_tin, $noidung);
    }else{
        $_SESSION['chua_dang_nhap'] = "vui lòng đăng nhập để bình luận";
    }
    
}

function timeon($timein){
    $time = time() - strtotime($timein);
    if($time > 60){
        $time = $time / 60;
        if($time >60){
            $time = $time / 60;
            if($time > 24){
                $time = $time / 24;
                if($time > 30){

                    return $time2 = $time." Tháng";
                }
                else return $time2 = FLOOR($time)." Ngày";
            }else return $time2 = FLOOR($time)." Giờ";
        }else return $time2 = FLOOR($time)." Phút";
    }else return $time2 = FLOOR($time)." Giây";
}
//print_r($chitiettin);

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>nhom 9</title>

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
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9" id="datasearch">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?=$chitiet->TieuDe?></h1>

                <!-- Author -->
                <p class="lead">
                    by: <strong><?=$chitiet->user?></strong>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="public/upfile/<?=$chitiet->Hinh?>" alt="" width="900px" height=30%>

                <!-- Date/Time -->
        <!-- time start -->
                                           
                                            
        <!-- time end -->
                <p><span class="glyphicon glyphicon-time"></span> <?=timeon($chitiet->Create_at)?> trước</p>
                <hr>

                <!-- Post Content -->
                <p class="lead"><?=$chitiet->TomTat?></p>
                <p><?=$chitiet->NoiDung?></p>

                <hr>

                <!-- Blog Comments -->
                <?php
                if(isset($_SESSION['chua_dang_nhap'])){
                    echo "<div class='alert alert-danger'>".($_SESSION['chua_dang_nhap'])."</div>";
                }
                ?>
                
                <!-- Comments Form -->
                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form" method="Post" action="#">
                        <input type="hidden" name="id_tin" value="<?=$chitiet->ID?>">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="noidung"></textarea>
                        </div>
                        <button type="submit" name="binhluan" class="btn btn-primary">Gửi</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php

                    foreach ($comment as $cmt) {
                        # code...
                    
                ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?=$cmt->Ten?>
                            <small><?=timeon($cmt->Create_at)?> trước</small>
                        </h4>
                       <?=$cmt->NoiDung?>
                    </div>
                </div>
                <?php
                    }

                ?>
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default" >
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">

                        <?php

                        foreach ($relatednews as $related) {
                            # code...
                        
                        ?>
                                <!-- item -->
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-13">
                                        <a href="chitiet.php?id_tin=<?=$related->ID?>&loai_tin=<?=$related->TenKhongDau?>">
                                            <img class="img-rounded"  width="150px" height="100px" src="public/upfile/<?=$related->Hinh?>" >
                                        </a>
                                    </div>

                                    <div class="col-md-13" style="margin-top: 5px;">
                                        <a href="chitiet.php?id_tin=<?=$related->ID?>&loai_tin=<?=$related->TenKhongDau?>"><b><?=$related->TieuDe?></b></a>
                                    </div>
                                    <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                                    <div class="break"></div>
                                </div>
                                <!-- end item -->
                        <?php

                        }
                    ?>
                       
                    </div>
                </div>

                
                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->

    <!-- Footer -->
    <div style="background: #545251;">
        <hr>
        <div class="space20"></div>
        <div class="container" style="background: #e6f0f7;">
            <?php include 'piece_index/footer.php' ?>
        </div>
        <div class="space20"></div>
        

    </div>
    <!-- end Footer -->
    <!-- jQuery -->
    <script src="public/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/my.js"></script>
    <script >
        $(document).ready(function(){
            $("#id_button").click(function(){
                var key = $('#id_search').val();
                $.post("timkiem.php",{tukhoa:key},function(data){
                    $('#datasearch').html(data);
                })
            })
        })
    </script>

</body>

</html>
