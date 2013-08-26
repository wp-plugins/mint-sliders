<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
check_nggal();
global $wpdb, $nggdb, $mint_animations, $mint_positions, $mint_navigations;
$ngid = get_post_meta($post->ID, 'mis_gallery', true);

$mis_global_trans = get_post_meta($post->ID, 'mis_global_trans', true);

$mis_controls = get_post_meta($post->ID, 'mis_controls', true);

$mis_galh = get_post_meta($post->ID, 'mis_height', true);
$mis_galw = get_post_meta($post->ID, 'mis_width', true);

$mis_focus = get_post_meta($post->ID, 'mis_focus', true);
$mis_nav = get_post_meta($post->ID, 'mis_nav', true);

$mis_autoplay = get_post_meta($post->ID, 'mis_autoplay', true);
$mis_navkey = get_post_meta($post->ID, 'mis_navkey', true);
$mis_fullscreen = get_post_meta($post->ID, 'mis_fullscreen', true);
$mis_random = get_post_meta($post->ID, 'mis_random', true);
$mis_stopover = get_post_meta($post->ID, 'mis_stopover', true);
$mis_lrnav = get_post_meta($post->ID, 'mis_lrnav', true);

$mis_easing = get_post_meta($post->ID, 'mis_easing', true);
$mis_align = get_post_meta($post->ID, 'mis_align', true);
$mis_preview = get_post_meta($post->ID, 'mis_preview', true);
$mis_progressbar = get_post_meta($post->ID, 'mis_progressbar', true);
$mis_label = get_post_meta($post->ID, 'mis_label', true);
$mis_interval = get_post_meta($post->ID, 'mis_interval', true);
$mis_velocity = get_post_meta($post->ID, 'mis_velocity', true);
	
$mis_gallery_info = get_post_meta($post->ID, 'misgallerydata', true);
$mis_array = unserialize($mis_gallery_info);
//echo '<pre>';print_r($mis_array);echo '</pre>';
$mis_nggallery = $nggdb->get_gallery($ngid);
?>
<script>
jQuery(document).ready(function() {
	var options = {};
	<?php
	echo "options['numbers'] = false;options['navigation'] = false;";
	echo ($mis_autoplay=='1') ? "options['auto_play'] = true;" : "options['auto_play'] = false;";
	echo ($mis_navkey=='1') ? "options['enable_navigation_keys'] = true;" : "options['enable_navigation_keys'] = false;";
	echo ($mis_fullscreen=='1') ? "options['fullscreen'] = true;" : "options['fullscreen'] = false;";
	echo ($mis_random=='1') ? "options['show_randomly'] = true;" : "options['show_randomly'] = false;";
	echo ($mis_stopover=='1') ? "options['stop_over'] = true;" : "options['stop_over'] = false;";
	echo ($mis_controls!='none' and $mis_controls!='') ? "options['controls'] = true;options['controls_position']='$mis_controls';" : "";
	echo ($mis_focus!='none' and $mis_focus!='') ? "options['focus'] = true;options['focus_position']='$mis_focus';" : "";
	
	echo ($mis_easing!='' and $mis_easing!='none') ? "options['easing_default'] = '$mis_easing';" : "";
	echo ($mis_align!='' and $mis_align!='none') ? "options['numbers_align'] = '$mis_align';" : "";
	
	echo ($mis_preview=='1') ? "options['preview'] = true;" : "options['preview'] = false;";
	echo ($mis_progressbar=='1') ? "options['progressbar'] = true;" : "options['progressbar'] = false;";
	echo ($mis_label=='1') ? "options['label'] = true;" : "options['label'] = false;";
	echo ($mis_interval!='') ? "options['interval'] = '$mis_interval';" : "";
	
	echo "options['velocity'] = '$mis_velocity';";
	
	echo ($mis_lrnav=='1') ? "options['navigation'] = true;" : "options['navigation'] = false;";
	
	if($mis_nav!='none' and $mis_nav!='') {
		if($mis_nav=='dots') {
			echo "options['dots'] = true;";
		}else if($mis_nav=='numbers') {
			echo "options['numbers'] = true;";
		}else if($mis_nav=='thumbs') {
			echo "options['thumbs'] = true;";
		}
	}else {
	//	echo "options['navigation'] = false;";
		echo "options['hideTools'] = false;";
	}
	?>
	jQuery('#mintimgslider<?php echo $post->ID; ?>').skitter(options);
});
</script>
<div class="box_skitter" style="height: <?php echo $mis_galh; ?>; width: <?php echo $mis_galw; ?>" id="mintimgslider<?php echo $post->ID; ?>">

<ul>
<?php
$k=0;
foreach($mis_nggallery as $mis_galid=>$row) {
	if($mis_array["mis_image_disabled$mis_galid"]=='1') continue;
?>
<li>
<?php
if($mis_array["mis_image_link$mis_galid"]!='') {
?>
<a href="<?php echo ($mis_array["mis_image_link$mis_galid"]!='') ? $mis_array["mis_image_link$mis_galid"] : '#'; ?>"<?php echo (isset($mis_array["mis_link_target$mis_galid"]) and $mis_array["mis_link_target$mis_galid"]!='' and $mis_array["mis_image_link$mis_galid"]!='') ? ' target="'.$mis_array["mis_link_target$mis_galid"].'"' : ''; ?>>
<img src="<?php echo $row->imageURL; ?>" class="<?php echo ($mis_array["mis_image_trans$mis_galid"]!='' and $mis_array["mis_image_trans$mis_galid"]!='none') ? $mis_array["mis_image_trans$mis_galid"] : $mis_global_trans; ?>" />
</a>
<?php
}else {
?>
<img src="<?php echo $row->imageURL; ?>" class="<?php echo ($mis_array["mis_image_trans$mis_galid"]!='' and $mis_array["mis_image_trans$mis_galid"]!='none') ? $mis_array["mis_image_trans$mis_galid"] : $mis_global_trans; ?>" />
<?php
}
?>
<div class="label_text"><p><?php echo $row->description; ?></p></div>
</li>
<?php
	$k++;
}
?>
</ul>
</div>