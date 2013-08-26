<?php
/*
Plugin Name: Mint Sliders
Plugin URI: http://taraprasad.com/wordpress/mintsliders/
Description: A Image Slider Plugin for Wordpress.
Version: 1.5.0
Author: Taraprasad Swain
Author URI: http://www.taraprasad.com

Copyright 2012 by Taraprasad Swain (email : swain.tara@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

include('mint-config.php');

add_action('init', 'create_post_type');

add_action('save_post', 'com_save_metaa');

add_action('admin_init', 'com_register_meta_box');

add_action('wp_ajax_mint_loadnggallery', 'mint_loadnggallery_callback');

add_shortcode('mintslider', 'mintslider_func' );

add_filter('manage_edit-mintimagesliders_columns', 'set_custom_edit_mintimagesliders_columns' );

add_action('manage_mintimagesliders_posts_custom_column' , 'custom_mintimagesliders_column', 10, 2 );

add_action('wp_enqueue_scripts', 'mint_scripts_method');

function is_nggal_there() {
	$plugins = get_plugins('/nextgen-gallery');
	if($plugins) return true;
	
	return false;
}

function is_nggal_active() {
	if(is_plugin_active('nextgen-gallery/nggallery.php')) {
		return true;
	}
	return false;
}

function check_nggal() {
	if(is_nggal_there()) {
		if(!is_nggal_active()) {
			echo "Please activate nextgen-gallery plugin";
		}else {
			return;
		}
	}else {
		echo "Please install nextgen-gallery plugin<br />http://wordpress.org/extend/plugins/nextgen-gallery/";
	}
	exit();
}

function mint_scripts_method() {
	//wp_enqueue_script('jquery',plugins_url('/js/jquery-1.6.3.min.js', __FILE__));
	//wp_enqueue_script('highlight',plugins_url('/js/highlight.js', __FILE__));
	wp_enqueue_script('animate-colors',plugins_url('/js/jquery.animate-colors-min.js', __FILE__));
	wp_enqueue_script('easing',plugins_url('/js/jquery.easing.1.3.js', __FILE__));
	wp_enqueue_script('skitter',plugins_url('/js/jquery.skitter.js', __FILE__));
	
	//wp_enqueue_style('styles', plugins_url('/css/styles.css', __FILE__));
	//wp_enqueue_style('highlight', plugins_url('/css/highlight.css', __FILE__));
	//wp_enqueue_style('highlight-black', plugins_url('/css/highlight.black.css', __FILE__));
	wp_enqueue_style('skitter-styles', plugins_url('/css/skitter.styles.css', __FILE__));
}

function set_custom_edit_mintimagesliders_columns($columns) {
	$tempdate = $columns['date'];
	unset($columns['date']);
	return $columns + array('short_code' => __('Short Code'), 'date'=> $tempdate);
}

function custom_mintimagesliders_column( $column, $post_id ) {
    switch($column) {
      case 'short_code':
        echo '<input type="text" onclick="this.select();" value="[mintslider id='.$post_id.']" />';
        break;
    }
}

function mintslider_func($atts) {
	$postid = (int)$atts['id'];
	
	ob_start();
	if($postid>0) {
		$post = get_post($postid);
		if($post->post_type=='mintimagesliders') {
			include('views/imageslider.php');
		}else {
			
		}
	}
	$string = ob_get_contents();
	ob_end_clean();
	return $string;
}

function com_save_metaa($postId) {
	$screen = get_current_screen();
	
	if($screen->post_type=='mintimagesliders' and isset($_POST)) {
		
		//update_post_meta($postId, 'title_text', $_POST['title_text']);
		
		if(isset($_POST['mis_gallery'])) update_post_meta($postId, 'mis_gallery', $_POST['mis_gallery']);
		
		if(isset($_POST['mis_global_trans'])) update_post_meta($postId, 'mis_global_trans', $_POST['mis_global_trans']);
		
		if(isset($_POST['mis_height'])) update_post_meta($postId, 'mis_height', $_POST['mis_height']);
		
		if(isset($_POST['mis_width'])) update_post_meta($postId, 'mis_width', $_POST['mis_width']);
		
		if(isset($_POST['mis_controls'])) update_post_meta($postId, 'mis_controls', $_POST['mis_controls']);
		
		if(isset($_POST['mis_focus'])) update_post_meta($postId, 'mis_focus', $_POST['mis_focus']);
		
		if(isset($_POST['mis_nav'])) update_post_meta($postId, 'mis_nav', $_POST['mis_nav']);
		
		if(isset($_POST['mis_interval'])) update_post_meta($postId, 'mis_interval', $_POST['mis_interval']);
		
		if(isset($_POST['mis_velocity'])) update_post_meta($postId, 'mis_velocity', $_POST['mis_velocity']);
		
		if(isset($_POST['mis_easing'])) update_post_meta($postId, 'mis_easing', $_POST['mis_easing']);
		
		if(isset($_POST['mis_align'])) update_post_meta($postId, 'mis_align', $_POST['mis_align']);
		
		if(isset($_POST['mis_autoplay'])) {
			update_post_meta($postId, 'mis_autoplay', $_POST['mis_autoplay']);
		}else {
			update_post_meta($postId, 'mis_autoplay', '');
		}
		
		if(isset($_POST['mis_navkey'])) {
			update_post_meta($postId, 'mis_navkey', $_POST['mis_navkey']);
		}else {
			update_post_meta($postId, 'mis_navkey', '');
		}
		
		if(isset($_POST['mis_fullscreen'])) {
			update_post_meta($postId, 'mis_fullscreen', $_POST['mis_fullscreen']);
		}else {
			update_post_meta($postId, 'mis_fullscreen', '');
		}
		
		if(isset($_POST['mis_random'])) {
			update_post_meta($postId, 'mis_random', $_POST['mis_random']);
		}else {
			update_post_meta($postId, 'mis_random', '');
		}
		
		if(isset($_POST['mis_stopover'])) {
			update_post_meta($postId, 'mis_stopover', $_POST['mis_stopover']);
		}else {
			update_post_meta($postId, 'mis_stopover', '');
		}
		
		if(isset($_POST['mis_lrnav'])) {
			update_post_meta($postId, 'mis_lrnav', $_POST['mis_lrnav']);
		}else {
			update_post_meta($postId, 'mis_lrnav', '');
		}
		
		if(isset($_POST['mis_preview'])) {
			update_post_meta($postId, 'mis_preview', $_POST['mis_preview']);
		}else {
			update_post_meta($postId, 'mis_preview', '');
		}
		
		if(isset($_POST['mis_progressbar'])) {
			update_post_meta($postId, 'mis_progressbar', $_POST['mis_progressbar']);
		}else {
			update_post_meta($postId, 'mis_progressbar', '');
		}
		
		if(isset($_POST['mis_label'])) {
			update_post_meta($postId, 'mis_label', $_POST['mis_label']);
		}else {
			update_post_meta($postId, 'mis_label', '');
		}
		
		if(isset($_POST['misgallerydata'])) update_post_meta($postId, 'misgallerydata', serialize($_POST['misgallerydata']));
		
	}
}

function mint_loadnggallery_callback() {
	include('admin-views/mint_loadnggallery_callback.php');
	die(); // this is required to return a proper result
}

function com_register_meta_box() {
	add_meta_box('mintimageslider_meta', __('Image Slider Options'), 'mintimageslider_meta', 'Mint Image Sliders', 'normal', 'high');
	add_meta_box('mintimageslider_meta_images', __('Slider Images'), 'mintimageslider_meta_images', 'Mint Image Sliders', 'normal', 'high');
}

function mintimageslider_meta() {
	include('admin-views/mintimageslider-meta.php');
}

function mintimageslider_meta_images() {
	include('admin-views/mintimageslider-images-meta.php');
}

/*
 * Creating Admin Menus
 */
function create_post_type() {
	register_post_type( 'Mint Image Sliders',
	array(
      'labels' => array(
        'name' => __( 'Image Sliders' ),
		'add_new_item' => __('Add New Image Slider'),
        'singular_name' => __( 'Menu item' )
	),
	'public' => true,
	'exclude_from_search' => true,
	'show_in_nav_menus' => false,
	'show_in_menu' => true,
	'menu_position'=> 5,
	'supports' => array( 'title', 'page-attributes', 'thumbnail'),
	'rewrite' => false
	)
	);
}

add_filter( 'enter_title_here', 'change_default_title' );

function change_default_title( $title ){
	$screen = get_current_screen();

	if($screen->post_type == 'mintimagesliders') {
		$title = 'Enter Image Slider Name';
	}
	
	return $title;
}
?>