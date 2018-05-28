<a href="/admin/dashboard">główna</a>
<a href="/admin/about">about</a>
<a href="#" onclick="box()">Dodaj nową galerie</a>
<?php if(!($galleries==null)){for ($i=1; $i<=count($galleries); $i++){?>
  <a href="/admin/gallery_edit?id=<?php echo $galleries[$i]['id']; ?>"><?php echo $galleries[$i]['name']; ?></a>
<?php }}?>
<a href="/admin/recommend">Polecam</a>
<a href="/admin/contact">kontakt</a>
<!-- wyskakujące okienko -->
<div id="light" class="white_content">
  <div class="exit_box"><input type="button" value="Zamknij" onclick="close1()" style="float:right;"></div>
 <form class="" method="post">
   <input type="text" name="name" value="" placeholder="Nazwa"/>
   <input type="submit" name="popup">
 </form>
</div>
<!-- ciemne tło za oknem -->
<div id="fade" class="black_overlay"></div>
<a href="/admin/logout">Wyloguj</a>
<div class="clearfix"></div>
