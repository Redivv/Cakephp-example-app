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
Ustawienia Folderu
<section class="Folder_form">
  <form class="" action="" method="post" enctype="multipart/form-data">
    <input type="text" name="name" value="<?php echo $element['folder']['name']; ?>">
    <textarea name="description" placeholder="Opis" ><?php echo $element['folder']['description']; ?></textarea><br>
    <label>Miniaturka</label>
    <?php if(!($element['folder']['thumbnail'] == null)){echo'<img src="/upload/'.$element['folder']['thumbnail'].'" class="folder_thumbnail">';}?>
    <input type="file"  name="thumbnail[]">
    <input type="submit" name="folder_form">
  </form>
</section>
<br>
Zdjęcia
<section class="Photos">
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
        <input class="x-del_folder" type="button" value="Usuń Zdjęcie" data-asoc="<?php echo $element['Folder_photos.id'][$i]; ?>" data-id="<?php echo $_GET['id']; ?>" style="float:right;">
        <BR/>
      </form>

    </div><?php } ?>
    <div class="clearfix"><br>
    <!-- wyskakujące okienko z potwiedzeniem usunięcia -->
      <div id="light3" class="white_content">
        <h3 style="text-align:center;">Czy na pewno chcesz usunąć zdjęcie?</h3>
       <form class="delete_photo" method="post">
         <input type="submit" name="delete" value="Tak" style="float:right;">
         <input type="button" value="Nie" onclick="close3()">
       </form>
      </div>
      <div id="fade3" class="black_overlay"></div>
    <!-- -->
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="Photos[]" multiple>
    <input type="submit" name="" value="Upload">
  </form>

</section>
