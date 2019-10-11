<?php
if(session_id() === "") session_start();

include "../controller/qttintuc_c.php";
$qttintuc = new qttintuc_c;
//$_SESSION['id_user']
$tin = $qttintuc->get_tintuc_c($_SESSION['id_user'] , $_SESSION['role']);


?>
<!DOCTYPE html>
<html>
<head>
	<title>nhóm 9</title>
  <link href="../../public/css/bootstrap.min.css" rel="stylesheet">
  <script src="../../public/ckeditor/ckeditor.js"></script>
</head>
<body>
	<div class="container">
  <h2>Danh sách tin </h2>
  <?php
    if(isset($_SESSION['thongbao'])){
      ?>
        <div class="alert alert-success"><?=$_SESSION['thongbao']?></div>
      <?php
      unset($_SESSION['thongbao']);
    }
  ?>          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th style="text-align: center;">Mã Tin</th>
        <th style="text-align: center;">Tên Loại Tin</th>
        <th style="text-align: center;">Tiêu Đề Tin</th>
        <th style="text-align: center;">Tóm Tắt Tin</th>
        <th style="text-align: center;">Nội Dung Tin (đã thu gọn)</th>
        <th style="text-align: center;">Ngày Tạo</th>
        <th style="text-align: center;">Chức Năng</th>
        
      </tr>
    </thead>
    <tbody>
      <?php
      if(isset($tin['tinbai']))
      foreach ($tin['tinbai'] as $key ) {

        ?>
      <tr>
        <td><?=$key->ID?></td>
        <th><?=$key->Ten?></th>
        <td><?=$key->tieude?></td>
        <td><?=$key->tomtat?></td>
        <td><?=substr($key->noidung, 0, 200 )?></td>
        <td><?=$key->time_cus?></td>
        <td>
          <a href="../controller/suatinbai.php?idtin=<?=$key->ID?>" class="btn btn-warning" style="margin-bottom: 5px">sửa</a>
          <a href="../controller/xoatinbai.php?idtin=<?=$key->ID?>" class="btn btn-danger">xóa</a>
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