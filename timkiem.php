<?php
include('controller/c_tintuc.php');

$c_tintuc = new C_tintuc();
if(isset($_POST['tukhoa'])){
	$key = $_POST['tukhoa'];
	$tintuc = $c_tintuc->timkiem($key);

	
		?>
			<div class="panel panel-default">
            <div class="alert alert-success">Tìm Thấy <strong><?=count($tintuc)?></strong> bài viết với từ khóa: <strong><?=$key?></strong></div>
                    <?php

                        foreach ($tintuc as $tin) {
                            ?>
                                <div class="row-item row">
                                    <div class="col-md-3">

                                        <a href="chitiet.php?id_tin=<?=$tin->ID?>&loai_tin=<?=$tin->ten_khong_dau?>">
                                            <br>
                                            <img width="200px" height="200px" class="img-responsive" src="public/upfile/<?=$tin->Hinh?>" alt="">
                                        </a>
                                    </div>

                                    <div class="col-md-9" >
                                        <h3><?=$tin->TieuDe?></h3>
                                        <p><?=$tin->TomTat?></p>
                                        <a class="btn btn-primary" href="chitiet.php?id_tin=<?=$tin->ID?>&loai_tin=<?=$tin->ten_khong_dau?>">Xem </a>
                                    </div>
                                    <div class="break"></div>
                                </div>

                            <?php
                        }
                    ?>
                    

                   
                    <!-- /.row -->

                </div>
		<?php
	}


?>