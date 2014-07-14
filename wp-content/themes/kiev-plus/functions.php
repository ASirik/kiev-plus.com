<?php
/**
 * Created by PhpStorm.
 * User: andrewsirik
 * Date: 7/10/14
 * Time: 11:48 PM
 */

error_reporting('^ E_ALL ^ E_NOTICE');
ini_set('display_errors', '0');
error_reporting(E_ALL);
ini_set('display_errors', '0');

define('THEMEROOT',get_stylesheet_directory_uri());
define('IMAGES',THEMEROOT.'/images');

add_action( 'wp_enqueue_scripts', 'load_custom_script' );

function load_custom_script(){
    wp_enqueue_script('custom_script', THEMEROOT . '/js/custom.js','/js/jquery.bxslider.min.js', array('jquery'), true);
    wp_enqueue_script('bxslider', THEMEROOT . '/js/jquery.bxslider.min.js', array('jquery'), true);
}


/**
 * Add menu
 */

function register_my_menus(){
    register_nav_menu(array(
        'main-menu' => 'Main Menu'
    ), 'my menus');
}

add_action('init', 'register_my_menus');

/*
 *
 * Add theme support
 */

if(function_exists('add_theme_support')){
    add_theme_support('post-thumbnails');
    add_theme_support('post-thumbnails-big');
    set_post_thumbnail_size(154,124);
    add_image_size( 'card-big-img-width', 1038, 576, true );
}

/**
 * add custom fields to post
 */

add_action('add_meta_boxes', 'custom_add_meta_box');

function custom_add_meta_box(){
    add_meta_box(
        'plastic_card_details', //ID
        'Plastic Card Details',  //Title
        'custom_display_meta_box', //CallBack
        'post',                     //post type
        'normal'                    //position

    );
}

function custom_display_meta_box($post, $content){
    $card_description = get_post_meta($post->ID, 'card_description', true);
    //$card_small_image = get_post_meta($post->ID, 'card_small_image', true);
    $card_big_image_description = get_post_meta($post->ID, 'card_big_image_description', true);
    wp_nonce_field('card_meta_nonce', 'card_nonce');
    ?>
    <p>

<?php
$valueeee2 =  get_post_meta($_GET['post'], 'SMTH_METANAME_VALUE' , true ) ;
wp_editor( htmlspecialchars_decode($valueeee2), 'card_description', $settings = array('textarea_name'=>'card_description') );

?>
    </p>

    <p>
        <label for="card_big_image_description">Card big image description</label><br/>
        <?php wp_editor( $card_big_image_description, 'card_big_image_description', $settings = array() ); ?>
    </p>
<?php
}

add_action('save_post', 'custom_save_card_details');

function custom_save_card_details($post_id){
    //secure

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if(!isset($_POST['card_nonce']) || !wp_verify_nonce($_POST['card_nonce'], 'card_meta_nonce')) return;

    //Save or update

    if (!empty($_POST['card_description']))
    {
        $datta=htmlspecialchars_decode($_POST['card_description']);
        update_post_meta($post_id, 'SMTH_METANAME_VALUE', $datta );
    }
    if(isset($_POST['card_big_image_description']) &&  $_POST['card_big_image_description'] != ''){
        update_post_meta($post_id, 'card_big_image_description' , esc_html($_POST['card_big_image_description']));
    }
    if(isset($_POST['card_big_image_description']) &&  $_POST['card_big_image_description'] != ''){
        update_post_meta($post_id, 'card_big_image_description' , esc_html($_POST['card_big_image_description']));
    }

}
add_action( 'edit_page_form', 'my_second_editor' );
function my_second_editor($post) {
    // get and set $content somehow...
    $content = get_post_meta($post->ID, 'card_desc', true);
    wp_editor( $content, 'card_desc' );
}

function wptuts_get_the_ip() {
    if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    else {
        return $_SERVER["REMOTE_ADDR"];
    }
}

function wptuts_contact_form_sc( $atts ) {

    extract( shortcode_atts( array(
        // if you don't provide an e-mail address, the shortcode will pick the e-mail address of the admin:
        "email" => get_bloginfo( 'admin_email' ),
        "subject" => "",
        "label_name" => "Your Name",
        "label_email" => "Your E-mail Address",
        "label_subject" => "Subject",
        "label_message" => "Your Message",
        "label_submit" => "Submit",
        // the error message when at least one of the required fields are empty:
        "error_empty" => "Please fill in all the required fields.",
        // the error message when the e-mail address is not valid:
        "error_noemail" => "Please enter a valid e-mail address.",
        // and the success message when the e-mail is sent:
        "success" => "Thanks for your e-mail! We'll get back to you as soon as we can."
    ), $atts ) );

}
add_shortcode( 'contact', 'wptuts_contact_form_sc' );

