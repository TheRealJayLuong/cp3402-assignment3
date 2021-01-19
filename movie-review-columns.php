<?php
//manage the columns of the post post type
function setting_up_columns_for_post($columns){
    //remove columns
    unset($columns['title']);
    unset($columns['categories']);
    unset($columns['tags']);
    unset($columns['date']);
    unset($columns['comments']);
    unset($columns['author']);

    //add new columns
    $columns['title']               = 'Title';
    $columns['post_featured_image'] = 'Featured Image';
    $columns['post_content']        = 'Content';
    $columns['categories']          = 'Categories';
    $columns['tags']                = 'Tags';
    $columns['date']                = 'Date';   
    $columns['author']              = 'Author';
    return $columns;
}

add_action('manage_post_posts_columns','setting_up_columns_for_post');


// setting up thumbnail columns for post type
function setting_up_thumbnail_columns($column,$post_id){

    //featured image column
    if($column == 'post_featured_image'){
        //if this post has a featured image
        if(has_post_thumbnail($post_id)){
            // Original: $post_featured_image = get_the_post_thumbnail($post_id,'thumbnail');
            echo the_post_thumbnail( array(100,100) );
        }else{
            echo 'This post has no featured image'; 
        }
    }

    
    //post content column
    if($column == 'post_content'){

        //get the page based on its post_id
        $post = get_post($post_id);
        if($post){
            //get the main content area
            $post_content = apply_filters('the_content', $post->post_content); 
            // Original: echo $post_content;  
            echo wp_trim_words(get_the_content(), 10);
        }
    }
}
add_action('add_post_posts_custom_column','setting_up_thumbnail_columns',10,2);


