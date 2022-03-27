<div class="table-responsive" id="data">
  <input type="hidden" id="page" name="page" value="<?=(isset($_POST['page']))? $_POST['page'] : 1?>">
  <table class="table table-bordered">
    <tr>
      <th>NO</th>
      <th><a class="column_sort" id="nip" data-order="desc" href="#">NIP</a></th>
      <th><a class="column_sort" id="nama" data-order="desc" href="#">NAMA</a></th>
    </tr>

    <?php
    require_once("koneksi.php");
    $page = (isset($_POST['page']))? $_POST['page'] : 1;
    $limit = 10; 
    $no = (($page - 1) * $limit) + 1; 
    $limit_start = ($page - 1) * $limit;

    if(isset($_POST['search']) && $_POST['search'] == true){ 
      $param = '%'.$keyword.'%';
      $sql = $db->prepare("SELECT * FROM user WHERE nip LIKE :ni OR nama LIKE :na LIMIT ".$limit_start.",".$limit);
      $sql->bindParam(':ni', $param);
      $sql->bindParam(':na', $param);
      $sql->execute(); 
      $sql2 = $db->prepare("SELECT COUNT(*) AS jumlah FROM user WHERE nip LIKE :ni OR nama LIKE :na");
      $sql2->bindParam(':ni', $param);
      $sql2->bindParam(':na', $param);
      $sql2->execute(); 
      $get_jumlah = $sql2->fetch();
    }else{ 
      $sql = $db->prepare("SELECT * FROM user LIMIT ".$limit_start.",".$limit);
      $sql->execute(); 
      $sql2 = $db->prepare("SELECT COUNT(*) AS jumlah FROM user");
      $sql2->execute();
      $get_jumlah = $sql2->fetch();
    }

    while($data = $sql->fetch()){
      ?>
      <tr>
        <td class="align-middle"><?php echo $no; ?></td>
        <td class="align-middle"><?php echo $data['nip']; ?></td>
        <td class="align-middle"><?php echo $data['nama']; ?></td>
      </tr>
      <?php
      $no++;
    }
    ?>
  </table>
</div>
<?php require_once("pagination.php"); ?>
