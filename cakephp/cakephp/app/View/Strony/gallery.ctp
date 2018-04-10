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
<section class="folders">
  <?php if(isset($element['Folders'])){for ($i=1; $i<=count($element['Folders']) ; $i++) {?>
    <div class="folders_folder">
      <a href="/cakephp/strony/folder?id=<?php echo $element['Folders'][$i]['id']; ?>"><img src="/cakephp/upload/<?php echo $element['Folders'][$i]['thumbnail'];?> " class="folder_thumbnail"></a>
      <div class="folder_title"><?php echo $element['Folders'][$i]['name']; ?></div>
    </div>
  <?php }} ?>
</section>
