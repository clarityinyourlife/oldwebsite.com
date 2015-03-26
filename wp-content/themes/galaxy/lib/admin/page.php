<div class="wrap">
  
  <?php 
  /** Get the parent theme data. */
  $galaxy_theme_data = galaxy_theme_data();
  screen_icon();
  ?>
  <h2><?php echo sprintf( __( '%1$s Theme Settings', 'galaxy' ), $galaxy_theme_data['Name'] ); ?></h2>    
  
  <?php settings_errors( 'galaxy_options' ); ?>
  
  <form action="options.php" method="post">
    
    <?php settings_fields('galaxy_options_group'); ?>
    
    <div id="galaxy_tabs" class="galaxy-tabs">
    
      <ul>
        <li><a href="#galaxy_section_blog_tab"><?php _e( 'Blog Options', 'galaxy' ); ?></a></li>
        <li><a href="#galaxy_section_general_tab"><?php _e( 'General Options', 'galaxy' ); ?></a></li>        
      </ul>
      
      <div id="galaxy_section_blog_tab"><?php do_settings_sections( 'galaxy_section_blog_page' ); ?></div>
      <div id="galaxy_section_general_tab"><?php do_settings_sections( 'galaxy_section_general_page' ); ?></div>      
    
    </div>
    
    <p class="submit">
      <input name="Submit" type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'galaxy' ); ?>" />
    </p>
  
  </form>

</div>