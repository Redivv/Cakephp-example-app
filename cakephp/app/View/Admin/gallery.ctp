<?php for ($i=0; $i<$element['count']; $i++) {  ?>
  <div class="" style="width:25%; float:left; border:1px solid #f00;">
    <?php
        echo '<img src="'.$element['src'][$i].'" width=100% >';
    ?>
    <form class="" action="" method="post" enctype="multipart/form-data" name="">
      <input type="file" name="Photo[]"/>
      <input type="hidden" name="data[id]" value="<?php echo $element['id'][$i]; ?>"/>
      <input type="hidden" name="data[Folder_photos.id]" value="<?php echo $element['Folder_photos.id'][$i]; ?>"/>
      <input type="hidden" name="data[Folder_id]" value="<?php echo $_GET['id']; ?>">
      <input type="submit" name="photo">
      <input type="submit" name="delete" value="X-del" style="float:right;">
      <BR/>
    </form>

  </div><?php } ?>
  <div class="clearfix"><br>
<form method="post" enctype="multipart/form-data">
  <input type="file" name="Photos[]" multiple>
  <input type="submit" name="" value="Upload">
</form>
