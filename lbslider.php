<?php

/*
Plugin Name: LightBox Slider Widget
Description: Adds a custom slider widget to Elementor.
Version: 1.0
Author: Sanjay Kumar
*/


if(! defined('ABSPATH')) {
    exit;
}

// Register Slider Widget 

function register_slider_widget($widget_manager){

    require_once(__DIR__.'/widgets/lbslider-widget.php');

    $widget_manager->register(new \lbslider_widget());
}

add_action( 'elementor/widgets/register', 'register_slider_widget' );