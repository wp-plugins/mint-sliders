<script type="text/javascript" >
function mint_loadnggallery(obj, postid) {
	if(jQuery(obj).val()=='') {
		jQuery('#mis_gallery_img_div').html('<label for="mis_gallery">Please Select Gallery</label>');
		return false;
	}
	jQuery('#mis_gallery_img_div').html('<center><h4>Loading...</h4></center>');
	var data = {
			action: 'mint_loadnggallery',
			postid: postid,
			id: jQuery(obj).val()
		};
	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery.post('admin-ajax.php', data, function(response) {
		jQuery('#mis_gallery_img_div').html(response);
	});
}
</script>
<?php
check_nggal();
global $nggdb, $mint_animations, $mint_positions, $mint_navigations, $mint_easings, $mint_aligns;

if(isset($_REQUEST['post']) && is_numeric($_REQUEST['post'])) {
	$post = (int)$_REQUEST['post'];
	$post = get_post($post);
	
	$mis_gallery = get_post_meta($post->ID, 'mis_gallery', true);
	$mis_global_trans = get_post_meta($post->ID, 'mis_global_trans', true);
	
	$mis_easing = get_post_meta($post->ID, 'mis_easing', true);
	$mis_align = get_post_meta($post->ID, 'mis_align', true);
	
	$mis_height = get_post_meta($post->ID, 'mis_height', true);
	$mis_width = get_post_meta($post->ID, 'mis_width', true);
	
	$mis_controls = get_post_meta($post->ID, 'mis_controls', true);
	$mis_focus = get_post_meta($post->ID, 'mis_focus', true);
	$mis_nav = get_post_meta($post->ID, 'mis_nav', true);
	
	$mis_autoplay = get_post_meta($post->ID, 'mis_autoplay', true);
	$mis_navkey = get_post_meta($post->ID, 'mis_navkey', true);
	$mis_fullscreen = get_post_meta($post->ID, 'mis_fullscreen', true);
	$mis_random = get_post_meta($post->ID, 'mis_random', true);
	$mis_stopover = get_post_meta($post->ID, 'mis_stopover', true);
	$mis_lrnav = get_post_meta($post->ID, 'mis_lrnav', true);
	
	$mis_preview = get_post_meta($post->ID, 'mis_preview', true);
	$mis_progressbar = get_post_meta($post->ID, 'mis_progressbar', true);
	$mis_label = get_post_meta($post->ID, 'mis_label', true);
	$mis_interval = get_post_meta($post->ID, 'mis_interval', true);
	$mis_velocity = get_post_meta($post->ID, 'mis_velocity', true);
}else {
	$mis_gallery = '';
	$mis_global_trans = '';
	
	$mis_easing = '';
	$mis_align = '';
	
	$mis_height = '';
	$mis_width = '';
	$mis_controls = '';
	$mis_focus = '';
	$mis_nav = '';
	$mis_autoplay = '';
	$mis_navkey = '';
	$mis_fullscreen = '';
	$mis_random = '';
	$mis_stopover = '';
	$mis_lrnav = '';
	
	$mis_preview = '';
	$mis_progressbar = '';
	$mis_label = '';
	$mis_interval = '';
	$mis_velocity = '';
}
?>
<script>
jQuery(document).ready(function() {
	<?php
	if(isset($post)) {
	?>
	mint_loadnggallery(jQuery('#mis_gallery'), '<?php echo $post->ID; ?>');
	<?php
	}
	?>
});
</script>
<div style="padding: 10px; float: left;">
<label style="float: left; padding: 6px;" for="mis_gallery">Gallery</label>
<div style="float: left;">
<select name="mis_gallery" id="mis_gallery" onchange="mint_loadnggallery(this, '<?php echo isset($post->ID) ? $post->ID : ''; ?>');" style="width: 150px;">
	<option value="">Select</option>
	<?php
	foreach($nggdb->find_all_galleries() as $alb) {
		?>
	<option <?php echo ($mis_gallery == $alb->gid) ? ' selected="selected"' : ''; ?> value="<?php echo $alb->gid; ?>"><?php echo $alb->name; ?></option>
	<?php
	}
	?>
</select>
</div>
<label style="float: left; padding: 6px;" for="mis_global_trans">Global Transactions</label>
<div style="float: left;">
<select name="mis_global_trans" id="mis_global_trans" style="width: 150px;">
	<?php
	foreach($mint_animations as $animation) {
	?>
	<option <?php echo ($mis_global_trans == $animation) ? ' selected="selected"' : ''; ?> value="<?php echo $animation; ?>"><?php echo $animation; ?></option>
	<?php
	}
	?>
</select>
</div>
</div>


<div style="padding: 10px; float: left;">
<label style="float: left; padding: 6px;" for="mis_easing">Default Easing</label>
<div style="float: left;">
<select name="mis_easing" id="mis_easing" style="width: 150px;">
	<?php
	foreach($mint_easings as $row) {
		?>
	<option <?php echo ($row == $mis_easing) ? ' selected="selected"' : ''; ?> value="<?php echo $row; ?>"><?php echo $row; ?></option>
	<?php
	}
	?>
</select>
</div>
<label style="float: left; padding: 6px;" for="mis_align">Alignment</label>
<div style="float: left;">
<select name="mis_align" id="mis_align" style="width: 150px;">
	<?php
	foreach($mint_aligns as $row) {
	?>
	<option <?php echo ($mis_align == $row) ? ' selected="selected"' : ''; ?> value="<?php echo $row; ?>"><?php echo $row; ?></option>
	<?php
	}
	?>
</select>
</div>
</div>


<div style="padding: 10px; float: left;">
<label style="float: left; padding: 6px;" for="mis_height">Slider Height</label>
<div style="float: left;">
<input type="text" name="mis_height" id="mis_height" value="<?php echo $mis_height; ?>" />
</div>
<label style="float: left; padding: 6px;" for="mis_width">Slider Width</label>
<div style="float: left;">
<input type="text" name="mis_width" id="mis_width" value="<?php echo $mis_width; ?>" />
</div>
</div>
<div class="clear"></div>
<div style="padding: 10px; float: left;">
<label style="float: left; padding: 6px;" for="mis_controls">Controls</label>
<div style="float: left;">
<select name="mis_controls" id="mis_controls" style="width: 100px;">
	<?php
	foreach($mint_positions as $pos) {
	?>
	<option <?php echo ($mis_controls == $pos) ? ' selected="selected"' : ''; ?> value="<?php echo $pos; ?>"><?php echo $pos; ?></option>
	<?php
	}
	?>
</select>
</div>
<label style="float: left; padding: 6px;" for="mis_focus">Focus Position</label>
<div style="float: left;">
<select name="mis_focus" id="mis_focus" style="width: 100px;">
	<?php
	foreach($mint_positions as $pos) {
	?>
	<option <?php echo ($mis_focus == $pos) ? ' selected="selected"' : ''; ?> value="<?php echo $pos; ?>"><?php echo $pos; ?></option>
	<?php
	}
	?>
</select>
</div>
<label style="float: left; padding: 6px;" for="mis_nav">Navigation</label>
<div style="float: left;">
<select name="mis_nav" id="mis_nav" style="width: 100px;">
	<?php
	foreach($mint_navigations as $nav) {
	?>
	<option <?php echo ($mis_nav == $nav) ? ' selected="selected"' : ''; ?> value="<?php echo $nav; ?>"><?php echo $nav; ?></option>
	<?php
	}
	?>
</select>
</div>
</div>
<div class="clear"></div>


<div style="padding: 10px; float: left;">
<div style="float: left;padding: 6px;">
<input type="checkbox" id="mis_autoplay" name="mis_autoplay" value="1"<?php echo ($mis_autoplay=='1') ? ' checked="checked"' : ''; ?> />
</div>
<label style="float: left; padding: 6px;" for="mis_autoplay">Autoplay</label>
<div style="float: left;padding: 6px;">
<input type="checkbox" id="mis_navkey" name="mis_navkey" value="1"<?php echo ($mis_navkey=='1') ? ' checked="checked"' : ''; ?> />
</div>
<label style="float: left; padding: 6px;" for="mis_navkey">Navigation Keys</label>
<div style="float: left;padding: 6px;">
<input type="checkbox" id="mis_fullscreen" name="mis_fullscreen" value="1"<?php echo ($mis_fullscreen=='1') ? ' checked="checked"' : ''; ?> />
</div>
<label style="float: left; padding: 6px;" for="mis_fullscreen">Fullscreen</label>
<div style="float: left;padding: 6px;">
<input type="checkbox" id="mis_random" name="mis_random" value="1"<?php echo ($mis_random=='1') ? ' checked="checked"' : ''; ?> />
</div>
<label style="float: left; padding: 6px;" for="mis_random">Random</label>
<div style="float: left;padding: 6px;">
<input type="checkbox" id="mis_stopover" name="mis_stopover" value="1"<?php echo ($mis_stopover=='1') ? ' checked="checked"' : ''; ?> />
</div>
<label style="float: left; padding: 6px;" for="mis_stopover">Stop Over</label>
<div style="float: left;padding: 6px;">
<input type="checkbox" id="mis_lrnav" name="mis_lrnav" value="1"<?php echo ($mis_lrnav=='1') ? ' checked="checked"' : ''; ?> />
</div>
<label style="float: left; padding: 6px;" for="mis_lrnav">Left Right Navigation</label>
</div>
<div class="clear"></div>


<div style="padding: 10px; float: left;">
<div style="float: left;padding: 6px;">
<input type="checkbox" id="mis_preview" name="mis_preview" value="1"<?php echo ($mis_preview=='1') ? ' checked="checked"' : ''; ?> />
</div>
<label style="float: left; padding: 6px;" for="mis_preview">Preview</label>
<div style="float: left;padding: 6px;">
<input type="checkbox" id="mis_progressbar" name="mis_progressbar" value="1"<?php echo ($mis_progressbar=='1') ? ' checked="checked"' : ''; ?> />
</div>
<label style="float: left; padding: 6px;" for="mis_progressbar">Progressbar</label>
<div style="float: left;padding: 6px;">
<input type="checkbox" id="mis_label" name="mis_label" value="1"<?php echo ($mis_label =='1') ? ' checked="checked"' : ''; ?> />
</div>
<label style="float: left; padding: 6px;" for="mis_label">Show Labels</label>
<label style="float: left; padding: 6px;" for="mis_interval">Interval</label>
<div style="float: left;padding: 6px;">
<input type="text" style="width:50px;" id="mis_interval" name="mis_interval" value="<?php echo ($mis_interval!='') ? $mis_interval : '2500'; ?>" />
</div>
<label style="float: left; padding: 6px;" for="mis_velocity">Velocity</label>
<div style="float: left;padding: 6px;">
<input type="text" style="width:50px;" id="mis_velocity" name="mis_velocity" value="<?php echo ($mis_velocity!='') ? $mis_velocity : '0.75'; ?>" />
</div>
</div>
<div class="clear"></div>