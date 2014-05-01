<?php
add_action( 'admin_init', 'instagram_options_init1' );
add_action( 'admin_menu', 'instagram_options_add_page1' );
function instagram_options_init1(){
	register_setting( 'instagram_options', 'instagram_plugin_options', 'instagram_options_validate' );
}
function instagram_options_add_page1() {
	add_menu_page( __( 'Instagram Widget', 'sampletheme' ), __( 'Instagram Options', 'sampletheme' ), 'edit_theme_options', 'instagram_options', 'instagram_options_do_page1', plugins_url('img/logo.png',__FILE__ ) );
}
function instagram_options_do_page1() {
	global $select_options, $radio_options;
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;?>

<div class="wrap">
  <?php screen_icon(); echo "<h2>Minimalist Instagram Options</h2>"; ?>
  <?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
  <div class="updated fade">
    <p><strong>
      <?php _e( 'Options saved', 'sampletheme' ); ?>
      </strong></p>
  </div>
  <?php endif; ?>
  <form method="post" action="options.php">
    <?php settings_fields( 'instagram_options' ); ?>
    <?php $options = get_option( 'instagram_plugin_options' ); ?>
    <h3>Options:</h3>
    <p>If you do not already have your Instagram Access Token, you can retrieve it here: <a target="_blank" href="http://www.pinceladasdaweb.com.br/instagram/access-token/">http://www.pinceladasdaweb.com.br/instagram/access-token/</a>. Copy and paste it below.</p>
                    <p>Your Instagram User ID is no longer required, you can simply enter the username of the Instagram account you want to display in the widget or in the shortcode ( [minstagram username="your_username_here"]). This allows you to display multiple accounts across your website. The User ID will still be used if a username is not provided, but may be phased out in future.</p>

    <table class="form-table">
      <tr valign="top">
        <th scope="row"><?php _e( 'Instagram User ID (Legacy)', 'sampletheme' ); ?>
        </th>
        <td>
        <input  id="ui" class="regular-text" type="text" name="instagram_plugin_options[ui]" value="<?php esc_attr_e( $options['ui'] ); ?>" /></td>
      </tr> 
      <tr valign="top">
        <th scope="row"><?php _e( 'Access Token', 'sampletheme' ); ?></th>
        <td><input  id="at" class="regular-text" type="text" name="instagram_plugin_options[at]" value="<?php esc_attr_e( $options['at'] ); ?>" /></td>
      </tr> 
    </table>
    <h3>Caching Options</h3>
    <table class="form-table">
 <tr valign="top">
        <th scope="row"><?php _e( 'Enable Caching', 'sampletheme' ); ?></th>
        <td><input id="caching" name="instagram_plugin_options[caching]" type="checkbox" value="1" <?php checked( '1', $options['caching'] ); ?> /></td>
      </tr>
      <tr valign="top">
        <th scope="row"><?php _e( 'Cache Expiry (Hrs)', 'sampletheme' ); ?></th>
        <td><input  id="cache_exp" class="regular-text" type="text" name="instagram_plugin_options[cache_exp]" value="<?php esc_attr_e( $options['cache_exp'] ); ?>" /></td>
      </tr> 
    </table>
        <p class="submit">
      <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'sampletheme' ); ?>" />
    </p>
  </form>
</div>
<?php
}
function instagram_options_validate( $input ) {
	$input['at'] = wp_filter_nohtml_kses( $input['at'] );
	$input['ui'] = wp_filter_nohtml_kses( $input['ui'] );
	$input['cache_exp'] = wp_filter_nohtml_kses( $input['cache_exp'] );
	if ( ! isset( $input['caching'] ) )
		$input['caching'] = null;
		$input['caching'] = ( $input['caching'] == 1 ? 1 : 0 );
	return $input;
}