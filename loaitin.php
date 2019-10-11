<?php
session_start();
include('controller/c_tintuc.php');
date_default_timezone_set("Asia/Ho_Chi_Minh");

$c_tintuc = new C_tintuc;
$tintucO = $c_tintuc->loaiTin();
$tintuc = $tintucO['danhMucTin'];
$menu = $tintucO['menu'];
$title = $tintucO['title'];
$thanh_phantrang = $tintucO['thanh_phantrang'];
//print_r($tintucO);die;





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
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>nhóm 9</title>

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
             <?php include 'piece_index/menu.php' ?>
            <div class="col-md-9 " >
                <div class="panel panel-default" id="datasearch">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b><?=$title->Ten?></b></h4>
                    </div>
                    <?php

                        foreach ($tintuc as $tin) {
                            ?>
                                <div class="row-item row">
                                    <div class="col-md-3">

                                        <a href="chitiet.php?id_tin=<?=$tin->id?>&loai_tin=<?=$title->TenKhongDau?>">
                                            <br>
                                            <img  style="width:200px; height:200px" class="img-responsive" src="public/upfile/<?=$tin->Hinh?>" alt="">
                                        </a>
                                    </div>

                                    <div class="col-md-9" >
                                        <h3><?=$tin->TieuDe?></h3>
                                        <p><?=$tin->TomTat?></p>
         <!-- time start -->
                                            <p><?=timeon($tin->Create_at)?> trước</p>
        <!-- time end -->
                                        <a class="btn btn-primary" href="chitiet.php?id_tin=<?=$tin->ID?>&loai_tin=<?=$title->TenKhongDau?>">Xem </a>
                                    </div>
                                    <div class="break"></div>
                                </div>

                            <?php
                        }
                    ?>
                    

                   
                    <!-- /.row -->

                </div>
                <div style="text-align: center;"><?=$thanh_phantrang?></div>
            </div> 

        </div>

    </div>
    <!-- end Page Content -->

    <!-- Footer -->
         </div>
    <div style="background: #545251;">
        <hr>
        <div class="space20"></div>
        <div class="container" style="background: #e6f0f7;">
            <?php include 'piece_index/footer.php' ?>
        </div>
        <div class="space20"></div>
        
        

   
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
