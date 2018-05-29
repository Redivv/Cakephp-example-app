<header>
  <div class="container-fluid page_header">
      <div class="row">
        <div class="col-md-12">
          <div class="page_logo">
            <a href="/sites/index" class="page_logo_link black" style="text-decoration:none;"><?php echo $settingss[7]['Settings']['value']; ?></a>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="page_menu col-md-12" style="text-decoration:none;">
              <a href="/sites/about/" class="col-lg-1 col-md-2 col-sm-2 black col-xs-3 col-sm-offset-2 col-md-offset-2 col-lg-offset-4 menu_box anim_short"><?php echo $settingss[8]['Settings']['value']; ?><div class="strip anim_short"></div></a>
              <div id="gallery" class="col-lg-1 col-md-2 col-sm-2 black col-xs-3 menu_box"><a style="color:inherit !important;"><?php echo $settingss[9]['Settings']['value']; ?></a>

                <!-- menu slide -->
                <div class="slide-menu m-t-20">
                  <?php if(!($galleries==null)){for ($i=1; $i<count($galleries); $i++){
                    echo'<a href="/sites/gallery?id='.$galleries[$i]['id'].'" class="button anim_short">'.$galleries[$i]['name'].'</a>';
                  }echo'<a href="/sites/gallery?id='.$galleries[count($galleries)]['id'].'" class="button anim_short">'.$galleries[count($galleries)]['name'].'</a>';}?>
                </div>
                <!-- menu slide -->
              </div>
              <a href="/sites/polecam" class="col-lg-1 col-md-2 col-sm-2 black col-xs-3 menu_box anim_short"><?php echo $settingss[10]['Settings']['value']; ?><div class="strip anim_short"></div></a>
              <a href="/sites/contact" class="col-lg-1 col-md-2 col-sm-2 black col-xs-3 menu_box anim_short"><?php echo $settingss[11]['Settings']['value']; ?><div class="strip anim_short"></div></a>
          </div>
        </div>
    </div>
  </header>
