<?php

// Register widgetized areas

function the_widgets_init() {
    if ( !function_exists('register_sidebars') )
        return;

    register_sidebar(array('name' => 'Social Header Links','id' => 'social-sidebar','before_widget' => '','after_widget' => '','before_title' => '','after_title' => ''));
    
    register_sidebar(array('name' => 'Sidebar','id' => 'sidebar-1','before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
    
    register_sidebars(3,array('name' => 'Footer %d','before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3 class="widget_title">','after_title' => '</h3><div class="fix"></div>'));

}

add_action( 'init', 'the_widgets_init' );


    
?>