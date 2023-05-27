<?php

/**

*Plugin Name: WP Posts Rest API Custom Fields
*Plugin URL: http://bhaskargogoi.in
* Description: Plugin to get data through custom fields in wordpress rest api.
* Version: 0.1
*Author: Bhaskar Gogoi
*Author Url: bhaskargogoi.in
 **/

add_action("rest_api_init", function(){
    register_rest_route('wc/v3', 'posts', [
        'methods' => 'GET',
        'callback' => 'wp_custom_Api'
    ]);
});


function wp_custom_Api(){
    // return "OUR TEST CUSTOME REST API";
    $args = [
        'numberposts' => 99999,
        'post_type' => 'post'
    ];

    $post = get_posts($args);
    $i = 0;

    $data = [];

    return $post;
    exit();

    foreach($post as $post){
        if($post->post_status == 'publish'){


        
        if ($i >= 3) {
            break;
        }

        $data[$i]["id"] = $post->ID;

        $data[$i]["status"]= $post->post_status;
        $data[$i]["date"]= $post->post_modified;
        $data[$i]["guid"]= $post->guid;
        $data[$i]["title"]= $post->post_title;
        $data[$i]["post_excerpt"]= $post->post_excerpt;
        $data[$i]['content'] = $post->post_content;
        $date[$i]['date'] = $post->post_date; 
        $data[$i]['slug'] = $post->post_name;
        $data[$i]['featured_image']['thumbnail'] = get_the_post_thumbnail_url($post->ID, 'thumbnail'); 
        $data[$i]['featured_image']['median'] = get_the_post_thumbnail_url($post->ID, 'median');
        $data[$i]['featured_image']['large'] = get_the_post_thumbnail_url($post->ID, 'large');
        $i++;
    }
    }

return $data;

};

?>