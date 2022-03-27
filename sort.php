<?php
  require_once("koneksi.php");

  $output = '';
  $order = $_POST["order"];
  if ($order == 'desc') {
      $order = 'asc';
  } else {
    $order = 'desc';
  }

  $page = (isset($_POST['page']))? $_POST['page'] : 1;
  $limit = 10; 
  $no = (($page - 1) * $limit) + 1; 
  $limit_start = ($page - 1) * $limit;
  $nama_kolom = $_POST["nama_kolom"];
  $orderby = $_POST["order"];

  if($nama_kolom!=''){
    $query = "SELECT u.* FROM (SELECT * FROM user LIMIT ".$limit_start.",".$limit.") u ORDER BY u.". $nama_kolom ." ".$orderby;
  }else{
    $query = "SELECT * FROM user LIMIT ".$limit_start.",".$limit; 
  }
  $sql = $db->prepare($query); 
  $sql->execute();
  $sql2 = $db->prepare("SELECT COUNT(*) AS jumlah FROM user");
  $sql2->execute();
  $get_jumlah = $sql2->fetch();
  $output.='<input type="hidden" id="page" name="page" value="'.$page.'">';
  $output .= '
  <table class="table table-bordered">
      <tr>
           <th>No</th>
           <th><a class="column_sort" id="nip" data-order="'.$order.'" href="#">NIP</a></th>
           <th><a class="column_sort" id="nama" data-order="'.$order.'" href="#">NAMA</a></th>
      </tr>
  ';
  $no=1;
  while($data = $sql->fetch()){
      $output .= '
      <tr>
           <td>' . $no++ . '</td>
           <td>' . $data["nip"] . '</td>
           <td>' . $data["nama"] . '</td>
      </tr>
      ';  
  }
  $output .= '</table>';
  echo $output;
  require_once("pagination.php");
?>
