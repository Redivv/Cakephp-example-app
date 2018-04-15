<style media="screen">
  input{
    display: block;
    margin-top: 5px;
  }
  textarea{
    margin-top: 5px;
  }
  .folder_thumbnail{
    display: block;
    width: 300px;
    height: 150px;
  }
</style>
<br>
<section class="Photos">
  <?php for ($i=0; $i<$element['count']; $i++) {  ?>
    <div class="" style="width:25%; float:left; border:1px solid #f00;">
      <?php
          echo '<img src="'.$element['src'][$i].'" width=100% >';
      ?>
    </div><?php } ?>
    <div class="clearfix"><br>
</section>
