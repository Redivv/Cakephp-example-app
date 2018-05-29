
<section class="folders">
  <div class="folders_box clearfix">
    <?php if(isset($element['Folders'])){for ($i=1; $i<=count($element['Folders']) ; $i++) {?>
      <div class="folders_folder">
        <a href="/sites/folder?id=<?php echo $element['Folders'][$i]['id']; ?>"><?php if(!($element['Folders'][$i]['thumbnail'] == null)){echo '<img src="/upload/'.$element['Folders'][$i]['thumbnail'].'" class="folder_thumbnail anim">';}?>
        <div class="folder_title"><?php echo $element['Folders'][$i]['name']; ?></div></a>
      </div>
    <?php }} ?>
  </div>
</section>
