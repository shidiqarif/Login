<?php
  session_start();
  if(!isset($_SESSION["user"])) header("Location: index.php");
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Home</title>
  <link rel="stylesheet" href="css/bootstrap.css" media="screen">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    .align-middle{
      vertical-align: middle !important;
    }
  </style>
  </head>
  <body>
    <div style="padding: 0 15px;">
      <h2>Data User | NIP : <?php echo  $_SESSION["user"]["nip"]?> | Nama : <?php echo $_SESSION["user"]["nama"] ?></h2><hr>
      <div class="row">
        <div class="col-xs-12 col-sm-6">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Pencarian..." id="keyword">
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button" id="btn-search">SEARCH</button>
              <a href="" class="btn btn-warning">RESET</a>
            </span>
          </div>
        </div>
              <a href="logout.php" class="btn btn-danger">LOGOUT</a>
      </div>
      <br>
      <div id="data"><?php include "data.php"; ?></div>
    </div>    
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ajax.js"></script>
  </body>
</html>

<script>
   $(document).ready(function(){
      $(document).on('click', '.column_sort', function(){
         var nama_kolom = $(this).attr("id");
         var order = $(this).data("order");
         var arrow = '';
         if(order == 'desc'){
              arrow = '&nbsp;<span class="fa fa-arrow-down"></span>';
         } else {
              arrow = '&nbsp;<span class="fa fa-arrow-up"></span>';
         }
         $.ajax({
            url:"sort.php",
            method:"POST",
            data:{
              nama_kolom: nama_kolom, 
              order: order,
              page: $('#page').val(),
            },
            success:function(data)
            {
                 $('#data').html(data);
                 $('#'+nama_kolom+'').append(arrow);
            }
         })
      });
   });
</script>