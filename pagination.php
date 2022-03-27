<?php if($sql->rowCount() > 0){?>
    <ul class="pagination">
      <?php if($page == 1){ ?>
        <li class="disabled"><a href="#">First</a></li>
        <li class="disabled"><a href="#">&laquo;</a></li>
      <?php } else { 
        $link_prev = ($page > 1)? $page - 1 : 1;
      ?>
        <li><a href="javascript:void(0);" onclick="searchWithPagination(1, false)">First</a></li>
        <li><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $link_prev; ?>, false)">&laquo;</a></li>
      <?php } ?>

      <?php
      $jumlah_page = ceil($get_jumlah['jumlah'] / $limit); 
      $jumlah_number = 4; 
      $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; 
      $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; 
      for($i = $start_number; $i <= $end_number; $i++){
        $link_active = ($page == $i)? ' class="active"' : '';
      ?>
        <li<?php echo $link_active; ?>><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $i; ?>, false)"><?php echo $i; ?></a></li>
      <?php } ?>

      <?php if($page == $jumlah_page) { ?>
        <li class="disabled"><a href="#">&raquo;</a></li>
        <li class="disabled"><a href="#">Last</a></li>
      <?php }else { 
        $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
      ?>
        <li><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $link_next; ?>, false)">&raquo;</a></li>
        <li><a href="javascript:void(0);" onclick="searchWithPagination(<?php echo $jumlah_page; ?>, false)">Last</a></li>
      <?php } ?>
    </ul>
<?php } ?>
