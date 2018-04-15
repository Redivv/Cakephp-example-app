<style media="screen">
  .folders_folder{
    display: inline-block;
    margin-top:20px;
    width: 500px;
    height: 250px;
  }
  .folder_thumbnail{
    display: block;
    width: 300px;
    height: 150px;
  }
  .folder_title{
    margin-top: 5px;
    width: 300px;
    border: 1px solid #000;
    text-align: center;
  }
  input{
    margin-top: 5px;
  }
</style>
<form class="" action="" method="post">
  <label for="">Nazwa Galerii</label><br>
  <input type="text" name="name" value="<?php echo $element['gallery']['name']; ?>">
  <input type="submit" name="Gallery_name">
</form>
<section class="popup window">
  <a href="#" onclick="box2();">Dodaj Folder</a>
  <div id="light2" class="white_content">
    <div class="exit_box"><input type="button" class="exit" onclick="close2()" value="Zamknij"></div>
   <form class="" method="post" enctype="multipart/form-data">
     <input type="text" name="name" value="" placeholder="Nazwa"/>
     <input type="file"  name="thumbnail[]">
     <input type="submit" name="Folder">
   </form>
    </div>
  <div id="fade2" class="black_overlay"></div>
</section>
<section class="folders">
  <?php if(isset($element['Folders'])){for ($i=1; $i<=count($element['Folders']) ; $i++) {?>
    <div class="folders_folder">
      <a href="/admin/folder_edit?id=<?php echo $element['Folders'][$i]['id']; ?>"><?php if(!($element['Folders'][$i]['thumbnail'] == null)){echo '<img src="/upload/'.$element['Folders'][$i]['thumbnail'].'" class="folder_thumbnail">';}?>
      <div class="folder_title"><?php echo $element['Folders'][$i]['name']; ?></div></a>
      <form class="" action="" method="post">
        <input type="hidden" name="folder_id" value="<?php echo $element['Folders'][$i]['id']; ?>">
        <input type="submit" name="delete_folder" value="Usuń">
      </form>
    </div>
  <?php }} ?>
</section>
