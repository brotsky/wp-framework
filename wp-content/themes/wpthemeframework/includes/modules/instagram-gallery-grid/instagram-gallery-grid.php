<?php

define('INSTAGRAM_GALLERY_GRID_DIR', get_template_directory_uri() . '/includes/modules/instagram-gallery-grid');

function instagram_gallery_grid() {
    instagram_gallery_grid_scripts();
    
    $user = "11686413";
    $code = "41715286.5b9e1e6.fca9565ca3184995935241e066f2cbb3";
    
    if(get_option("instagram_cache_time") < time() - 60 * 60) {
        $json = file_get_contents("https://api.instagram.com/v1/users/$user/media/recent/?access_token=$code");
        update_option("instagram_cache",$json);
        update_option("instagram_cache_time",time());
    }
    
    $json = get_option("instagram_cache");
    $json = json_decode($json);
    ?>
    
    <section id="instagram-gallery-grid">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h3>Instagram Feed</h3>
                    <p>Maecenas bibendum lacus gravida placerat consequat. Vivamus quis hendrerit mauris. Vestibulum laoreet felis sed consectetur sollicitudin.</p>
                </div>
            </div>
        </div>
        <div class="gallery">
            <?php for($i = 0 ; $i < 15 ; $i++) { 
                $image = $json->data[$i]->images->low_resolution->url;
                $link = $json->data[$i]->link;
                $caption = removeEmoji($json->data[$i]->caption->text);
            ?>
            <div class="image">
                <a href="<?php echo $link; ?>" target="_blank">
                    <img src="<?php if($image) echo str_replace( 'http://', 'https://', $image ); ?>" />
                    <div class="caption">
                        <div class="text">
                            <?php echo $caption; ?>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </section>
    <?php
}

function instagram_gallery_grid_scripts() {
    wp_enqueue_style( 'instagram-gallery-grid', INSTAGRAM_GALLERY_GRID_DIR . '/instagram-gallery-grid.css' );
    wp_enqueue_script( 'instagam-gallery-grid', INSTAGRAM_GALLERY_GRID_DIR . '/instagram-gallery-grid.js', array(), '1.0.0', true );
}

function removeEmoji($text) {

    $clean_text = "";

    // Match Emoticons
    $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
    $clean_text = preg_replace($regexEmoticons, '', $text);

    // Match Miscellaneous Symbols and Pictographs
    $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
    $clean_text = preg_replace($regexSymbols, '', $clean_text);

    // Match Transport And Map Symbols
    $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
    $clean_text = preg_replace($regexTransport, '', $clean_text);

    return $clean_text;
}