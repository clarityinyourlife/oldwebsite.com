<?php

// Register widgetized areas

function the_widgets_init() {
    if ( !function_exists('register_sidebars') )
        return;

	    register_sidebar(array( 'name' => 'Blog Sidebar','id' => 'sidebar-1','description' => "Normal full width Sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3 class="hl">','after_title' => '</h3>'));   

	    register_sidebar(array( 'name' => 'Blog Sidebar - Small (Left)','id' => 'sidebar-2','description' => "Normal full width Sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3 class="hl">','after_title' => '</h3>'));   

	    register_sidebar(array( 'name' => 'Blog Sidebar - Small (Right)','id' => 'sidebar-3','description' => "Normal full width Sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3 class="hl">','after_title' => '</h3>'));   

	    register_sidebar(array( 'name' => 'Homepage 1','id' => 'home-1', 'description' => "Widetized Homepage", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3 class="hl">','after_title' => '</h3>'));
	    register_sidebar(array( 'name' => 'Homepage 2','id' => 'home-2', 'description' => "Widetized Homepage", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3 class="hl">','after_title' => '</h3>'));
	    register_sidebar(array( 'name' => 'Homepage 3','id' => 'home-3', 'description' => "Widetized Homepage", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3 class="hl">','after_title' => '</h3>'));
}

add_action( 'init', 'the_widgets_init' );


    
?>