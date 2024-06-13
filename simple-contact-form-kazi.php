<?php
/**
 * Plugin Name:       Simple Contact Form Kazi
 * Plugin URI:        https://wordpress.org/plugins/kazi-visite-count/
 * Description:       A Simple Contact Form
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      8.1
 * Author:            Kazi Rabiul Islam
 * Author URI:        https://profiles.wordpress.org/distinctcoder/
 */

 if( !defined('ABSPATH') )
 {
     die('!Oop. Please Don\'t do anything here.');
 }

class simpleContactFormKazi {
    public function __construct() {

        // Create Custom Post Type
        add_action('init', array( $this,'create_custom_post_type') );

        // Add assets
        add_action( 'wp_enqueue_scripts', array( $this,'load_assets') );

        // Add shortcode
        add_shortcode( 'contact_form', array( $this,'contact_form_shortcode') );

    }

    public function create_custom_post_type() {
        
        $args = array(
         'public' => true,
         'has_archive' => true,
         'supports' => array('title'),
         'exclude_from_search' => true,
         'publicly_queryable' => false,
         'capability'=> 'manage_options',
         'labels' => array(
            'name' => 'Contact Form',
            'singular_name' => 'Contact Form Kazi',
         ),
        'menu_icon' => 'dashicons-id-alt',
        );

        register_post_type('simple_contact_form', $args);

    }

    public function load_assets() {
        wp_enqueue_style( 
            'simple-contact-form-kazi-css', 
            plugin_dir_url( __FILE__ ) . 'css/simple-contact-form-kazi.css', 
            array(), 
            1.0, 
            'all' 
        );

        wp_enqueue_script(
            'simple-contact-form-kazi-js',
            plugin_dir_url( __FILE__ ) . 'css/simple-contact-form-kazi.js', 
            array('jquery'), 
            1.0, 
            true
        ) ;

    }

    public function contact_form_shortcode() {
        
        $forms = '<div class="contact-form-kazi">';
        $forms .= '<h2>Contact Form</h2>';
        $forms .= '<p>Please fill out the form below.</p>';
        $forms .= '<input type="text" name="name" placeholder="Name" />';
        $forms .= '<input type="email" name="email" placeholder="Email" />';
        $forms .= '<input type="text" name="subject" placeholder="Subject" />';
        $forms .= '<textarea name="message" placeholder="Message"></textarea>';
        $forms .= '<input type="submit" value="Submit" />';
        $forms = '</div>';       
        return $forms; 
    
    }
}

new SimpleContactFormKazi();