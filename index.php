<?php
/*
Plugin Name: RSS Add Image Header
Plugin URI: http://www.brainphp.com/wordpress-plugins/rss-add-image-header/
Description: Adds logo/image to the header in RSS feed.
Version: 1.0
Author: Leonid Shalimov
Author URI: http://brainphp.com
*/

add_action('admin_menu', 'rss_add_image_head_menu');
add_option('rss_add_image_head_url', 'http://yourimg.url/');

function rss_add_image_head_menu() {
    add_submenu_page('options-general.php', 'Edit RSS Header Image', 'RSS Header Image', 'administrator', 'rss-header-edit', 'rss_add_image_head_options');
    add_action('admin_init', 'register_options');

    function register_options() { 
    	register_setting('rss-add-image-settings', 'rss_add_image_head_url');
	}
}

function rss_add_image_head_options() {
    ?>
	<div class="wrap">
	<h2>RSS Image Header Options</h2>
	<form method='POST' action='options.php'>
 	   <?php settings_fields('rss-add-image-settings'); ?>
 	   <table class='form-table'>
			<tr>
              <th scope='row'>Current Logo</th>
              <td><img src="<?php echo get_option('rss_add_image_head_url'); ?>" border="1" /></td>
			</tr>
	        <tr valign='top'>
	          <th scope='row'>Logo URL</th>
	          <td><input type='text' name='rss_add_image_head_url' size='50' value='<?php echo get_option('rss_add_image_head_url'); ?>' /></td>
 	        </tr>
 	   </table>
    <p class='submit'>
        <input type='submit' class='button-primary' value='<?php _e('Save Changes') ?>' />
    </p>
</form>
</div>
<?
}

if( !function_exists( 'rss_add_image_head' ) ) {
	function rss_add_image_head( ) {
		// Work on setting as an option on backend so it can be changed dynamically
		$logo = get_option("rss_add_image_head_url");

		echo '<image><title>', bloginfo_rss('name'), '</title>';
   		echo '<url>', $logo, '</url>';
    	echo '<link>', bloginfo_rss('url'), '</link></image>';
	}
	add_action('rss2_head', 'rss_add_image_head', 10);
}
?>
