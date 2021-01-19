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



