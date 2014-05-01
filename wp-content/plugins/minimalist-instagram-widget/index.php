<?php 
/* Plugin Name: Minimalist Instagram Widget
Plugin URI: http://impression11.co.uk/
Version: 1.3
Description: A minimalist Instagram widget to display your photos and videos.
Author: Ethan Gibson
Author URI: http://impression11.co.uk/
*/
require_once ( dirname(__FILE__).'/options.php' );

add_shortcode('minstagram', 'minstagram');

function minstagram($atts){

extract( shortcode_atts( array(
	      'count' => '4',
	      'row' => '2',
	      'video' => 0,
	      'username' => ''
     ), $atts ) );
	
$options = get_option( 'instagram_plugin_options' );
//Ensure the widget is correctly configured.
//Compromise for now while the old User ID setting is still available
if (isset($options['ui']) || isset($username)){$usercheck = 1;}
if($count =='' || $options['at'] =='' || !$usercheck == 1){echo 'Please ensure this plugin is correctly configured under "Instagram Options" & "Widgets"';}
else{
if (!$username==''){
	$file = plugin_dir_path( __FILE__ ).$username.$count.'_insta.txt';

}else{
	$file = plugin_dir_path( __FILE__ ).$options['ui'].$count.'_insta.txt';
}
// If the cache is set but doesn't have a time set it to 1 hour
if($options['cache_exp']==""){$options['cache_exp']=1;}
if($options['caching']==1 && file_exists($file) && time()-filemtime($file) < $options['cache_exp'] * 3600){
echo file_get_contents($file);
// Tell us how long the cache is set for so we know it's working!
echo '<!-- Cached File ('.$options['cache_exp'].' hours) -->';
}
else{
$cache ='';
$cache .='<style>.row'.$row.'{width:'.(100/$row).'%}</style>';
		// Supply a user id and an access token
		$userid = $options['ui'];
		$accessToken = $options['at'];
		// Gets our data
		if (!function_exists('fetchData')) {
		function fetchData($url){
		     $ch = curl_init();
		     curl_setopt($ch, CURLOPT_URL, $url);
		     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		     curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		     $result = curl_exec($ch);
		     curl_close($ch); 
		     return $result;
		}}
		
		if (!$username == ''){
		
		
		$query = http_build_query(
                array(
                    'q'=> $username,
                    'count'=>1,
                    'access_token'=>$accessToken

                )
            );  
    $url = "https://api.instagram.com/v1/users/search?{$query}";
		$result = fetchData($url);
    $result = json_decode($result);
    $userid = $result->data[0]->id;}
		
		// Pulls and parses data.
		$result = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}&count={$count}");
		$result = json_decode($result);
$cache .='<ul id="instagram">';
//get the url of where cached images will go
$cacheurl = plugins_url().'/minimalist-instagram-widget/cache';
//get plugin path for placing cached images
$dir = plugin_dir_path( __FILE__ );
global $wp_version;
if(count($result->data)<1){echo'Please check your Account Details and ensure your Instagram Account has photos';}else{
    foreach($result->data as $data)
    {
       if ($data->type == "video" && $wp_version >= 3.6 && $video == 1){
		           $cache .= '<li class="row'.$row.'">'.do_shortcode('[video preload="metadata" src="'.$data->videos->low_resolution->url.'"]').'</li>';}
		           else{
       // Get the image link
       $img = $data->images->thumbnail->url;
       //get the image name
             if($options['caching']==1){
       $imgfile = substr($img,strrpos($img,'/'),strlen($img));
       // add the image name onto the path
	   $newdir = $dir.'cache'.$imgfile;
	   // pull the image from instagrams servers
	   if(!file_exists($newdir)){
	   copy($img, $newdir);}}
       // Switch the size for a bigger one to link to
       $link = str_replace("_5","_6",$img);
       $link = str_replace("_s","_a",$link);
       if($options['caching']==1){
       $img = $cacheurl.$imgfile;}
       //Put together the list item for the image.
       $cache .= '<li class="row'.$row.'"><a href="'.$link.'" title="'.$data->caption->text.'" rel="lightbox" ><img title="'.$data->caption->text.'" src="'.$img.'" /></a></li>';}
    }}
$cache .= '</ul>';
echo $cache;
if($options['caching']==1){file_put_contents( $file, $cache);}
}}	
}

class wp_insta extends WP_Widget
{
  public function __construct()
  {
    parent::__construct(
      'wordpress-insta',
      'Minimalist Instagram Widget',
      array(
        'description' => 'Displays your Instagram Photos in the sidebar.'
      )
    );
  }
  public function widget( $args, $instance )
  {
  echo $args['before_widget'];
  echo $args['before_title'].$instance['title'].$args['after_title'];
  echo do_shortcode('[minstagram username="'.$instance['username'].'" count="'.$instance['count'].'" row="'.$instance['row'].'" video="'.$instance['video'].'"]');
  echo $args['after_widget'];

}
  public function form( $instance )
  {
    // removed the for loop, you can create new instances of the widget instead
    ?>

<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">Widget Title</label>
  <br />
  <input type="text" class="img" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $instance['title']; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('username'); ?>">Instagram Username</label>
  <br />
  <input type="text" class="img" name="<?php echo $this->get_field_name('username'); ?>" id="<?php echo $this->get_field_id('username'); ?>" value="<?php echo $instance['username']; ?>" />
</p>

<p>
  <label for="<?php echo $this->get_field_id('count'); ?>"># of Photos</label>
  <br />
  <input type="text" class="img" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo $instance['count']; ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('video'); ?>">
    <?php _e( 'Enable Video' ); ?>
  </label>
  <select name="<?php echo $this->get_field_name('video'); ?>" id="<?php echo $this->get_field_id('video'); ?>" class="widefat">
    <option value="0"<?php selected( $instance['video'], '0' ); ?>>
    <?php _e('False'); ?>
    </option>
    <option value="1"<?php selected( $instance['video'], '1' ); ?>>
    <?php _e('True'); ?>
    </option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('row'); ?>">
    <?php _e( 'Photos per row' ); ?>
  </label>
  <select name="<?php echo $this->get_field_name('row'); ?>" id="<?php echo $this->get_field_id('row'); ?>" class="widefat">
    <option value="1"<?php selected( $instance['row'], '1' ); ?>>
    <?php _e('1'); ?>
    </option>
    <option value="2"<?php selected( $instance['row'], '2' ); ?>>
    <?php _e('2'); ?>
    </option>
    <option value="3"<?php selected( $instance['row'], '3' ); ?>>
    <?php _e('3'); ?>
    </option>
    <option value="4"<?php selected( $instance['row'], '4' ); ?>>
    <?php _e('4'); ?>
    </option>
    <option value="5"<?php selected( $instance['row'], '5' ); ?>>
    <?php _e('5'); ?>
    </option>
    <option value="6"<?php selected( $instance['row'], '6' ); ?>>
    <?php _e('6'); ?>
    </option>
    <option value="7"<?php selected( $instance['row'], '7' ); ?>>
    <?php _e('7'); ?>
    </option>
    <option value="8"<?php selected( $instance['row'], '8' ); ?>>
    <?php _e('8'); ?>
    </option>
  </select>
</p>
<?php
  }
} 
add_action( 'widgets_init', create_function('', 'return register_widget("wp_insta");') );
function wp_insta_css()
{wp_enqueue_style('minimal-insta', plugins_url('wp-insta.css',__FILE__ ), null, null);
wp_enqueue_script('jQuery');
wp_enqueue_script('slimebox', plugins_url('slimbox2.js',__FILE__ ), null, null);}
add_action('init', 'wp_insta_css');

