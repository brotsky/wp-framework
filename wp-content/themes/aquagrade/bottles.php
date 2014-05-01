<?php
/*
Template Name: Bottles
*/    
    $meta_key = "";
    $type = "NUMERIC";
    $orderby = $_REQUEST['orderby'];
    if($orderby == NULL) $orderby = "name";
    if($orderby == "tds") { 
        $orderby = "meta_value_num";
        $meta_key = "tds";
        $type = "NUMERIC";
    }
    
    $order = $_REQUEST['order']; //either ASC or DESC
    if($order == NULL) $order = "ASC";
    
    $q = $_REQUEST['q'];
    if($q == NULL) $q = "";
    
    $page = $_REQUEST['page'];
    if($page == NULL) $page = 1;
    
    $tdsmin = (int)($_REQUEST['tdsmin']);
    $tdsmax = (int)($_REQUEST['tdsmax']);
    
    if($tdsmin == NULL) $tdsmin = 0;
    if($tdsmax == NULL) $tdsmax = 1000;
    
    
    $args = array(
    	'posts_per_page'   => -1,
    	'offset'           => 0,
    	'category'         => '',
    	'orderby'          => $orderby,
    	'order'            => $order,
    	'include'          => '',
    	'exclude'          => '',
    	'meta_key'         => $meta_key,
    	'meta_value'       => array($tdsmin,$tdsmax),
    	'meta_compare' => 'BETWEEN',
    	'meta_type' => $type,
    	'post_type'        => 'bottle',
    	'post_mime_type'   => '',
    	'post_parent'      => '',
    	'post_status'      => 'publish',
    	'suppress_filters' => true,
    	's'                => $q,
    	'paged'            => $page
    	);

        $posts_array = get_posts( $args ); 
        
        $post_query = new WP_Query( $args );

        $posts_array = $post_query->posts;
    if($_REQUEST['data'] == "true") {
    
        the_bottle_list_html($posts_array);
                
    } else if($_REQUEST['data'] == "json") {
        if($_REQUEST['id']) {
            $id = $_REQUEST['id'];
            
            $post = get_post($id);
            $bottle_info = array(
                "id" => $id,
                "title" => $post->post_title,
                "thumbnail" => wp_get_attachment_image_src( get_post_thumbnail_id($id), 'shop_single'),
                "tds" => get_field("tds",$id),
                "gallery" => get_field("images",$id),
                "types" => wp_get_post_terms($id,"type",array()),
                "content" => $post->post_content,
                "website" => get_field("website",$id),
                "phone_number" => get_field("phone_number",$id),
                "customer_service" => get_field("customer_service",$id),
                "factory_address" => get_field("factory_address"),
                "map_title" => get_field("map_title")
            );
            
            echo json_encode($bottle_info);
        } else {
            $count = 0;
            foreach($posts_array as $post) {
                $bottles[$count] = array(
                    "id" => $post->ID,
                    "title" => $post->post_title,
                //    "content" => $post->post_content,
                    "thumbnail" => wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'mobile-thumbnail'),
                    "tds" => get_field("tds",$post->ID),
                    "types" => wp_get_post_terms($post->ID,"type",array())
                 //   "gallery" => get_field("images",$post->ID)
                );
                $count++;
            }
            echo json_encode($bottles);
        }
} else {
get_header(); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php the_content(); ?>
            
 
            </div>
        </div>
        <div class="row">
            <div id="bottles-sidebar" class="col-md-3">
                <h3>Filter Bottles</h3>
                <h5>By Name</h5>
                <input id="bottle-q" type="input" placeholder="search" />
                <h5>By TDS</h5>
                <div id="tds-range"></div>
                <p id="amount">TDS: 0 - 1000</p>
                <h5>Order By</h5>
                <div id="orderby-options" class="btn-group">
                    <button id="orderby-button" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        Name <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" data-orderby="name">Name</a></li>
                        <li><a href="#" data-orderby="tds">TDS</a></li>
                    </ul>
                    <button id="order-button" type="button" class="btn btn-primary">
                        <i class="fa fa-arrow-up"></i>
                    </button>
                </div>
                <h5>Number of Bottles</h5>
                <p id="number-of-results"></p>
            </div>
            <div id="bottles-list" class="col-md-9">
                <?php the_bottle_list_html($posts_array); ?>
            </div>
        </div>
    </div>

<?php
get_footer();

}