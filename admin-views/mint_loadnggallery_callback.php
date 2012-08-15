<?php
check_nggal();
global $wpdb, $nggdb, $mint_animations, $mint_positions, $mint_navigations;
$ngid = addslashes($_POST['id']);
$postid = (int)$_POST['postid'];

if($postid>0) {
	$post = get_post($postid);
	$mis_gallery_info = get_post_meta($post->ID, 'misgallerydata', true);
	$mis_array = unserialize($mis_gallery_info);
}

$mis_nggallery = $nggdb->get_gallery($ngid);

$k = 0;
foreach($mis_nggallery as $mis_galid=>$row) {
	if($k>0) {
		?>
		<hr style="border: 0;color: #9E9E9E;background-color: #9E9E9E;height: 1px;width: 100%;text-align: left;" />
		<?php
	}
?>
<div style="padding: 10px; float: left;">
<div style="float: left;padding: 5px;">
<img src="<?php echo $row->thumbURL; ?>">
</div>
<div style="float: left;">
<label for="mis_image_trans<?php echo $k; ?>">Transaction</label>
<select id="mis_image_trans<?php echo $k; ?>" name="misgallerydata[mis_image_trans<?php echo $mis_galid; ?>]" style="width: 150px;">
	<?php
	foreach($mint_animations as $animation) {
	?>
	<option<?php echo (isset($mis_array["mis_image_trans$mis_galid"]) and $mis_array["mis_image_trans$mis_galid"]==$animation) ? ' selected="selected"' : ''; ?> value="<?php echo $animation; ?>"><?php echo $animation; ?></option>
	<?php
	}
	?>
</select><br /><br />
<label for="mis_image_link<?php echo $k; ?>">Link</label>: 
<input type="text" id="mis_image_link<?php echo $k; ?>" name="misgallerydata[mis_image_link<?php echo $mis_galid; ?>]" value="<?php echo isset($mis_array["mis_image_link$mis_galid"]) ? $mis_array["mis_image_link$mis_galid"] : ''; ?>"/>
<select id="mis_link_target<?php echo $mis_galid; ?>" name="misgallerydata[mis_link_target<?php echo $mis_galid; ?>]">
<option value="">Target</option>
<option<?php echo (isset($mis_array["mis_link_target$mis_galid"]) and $mis_array["mis_link_target$mis_galid"]=="_blank") ? ' selected="selected"' : ''; ?> value="_blank">_blank</option>
<option<?php echo (isset($mis_array["mis_link_target$mis_galid"]) and $mis_array["mis_link_target$mis_galid"]=="_new") ? ' selected="selected"' : ''; ?> value="_new">_new</option>
<option<?php echo (isset($mis_array["mis_link_target$mis_galid"]) and $mis_array["mis_link_target$mis_galid"]=="_parent") ? ' selected="selected"' : ''; ?> value="_parent">_parent</option>
<option<?php echo (isset($mis_array["mis_link_target$mis_galid"]) and $mis_array["mis_link_target$mis_galid"]=="_self") ? ' selected="selected"' : ''; ?> value="_self">_self</option>
<option<?php echo (isset($mis_array["mis_link_target$mis_galid"]) and $mis_array["mis_link_target$mis_galid"]=="_top") ? ' selected="selected"' : ''; ?> value="_top">_top</option>
</select>
<input type="checkbox"<?php echo (isset($mis_array["mis_image_disabled$mis_galid"]) and $mis_array["mis_image_disabled$mis_galid"]=='1') ? ' checked="checked"' : ''; ?> id="mis_image_disabled<?php echo $k; ?>" name="misgallerydata[mis_image_disabled<?php echo $mis_galid; ?>]" value="1" />
<label for="mis_image_disabled<?php echo $k; ?>">Disable</label>
</div>
</div>
<div class="clear"></div>
<?php
	$k++;
}
?>