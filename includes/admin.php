<?php

/**
 * Add custom columns to the person post type admin list.
 *
 * @param array $columns The existing columns.
 * @return array Modified columns.
 */
function add_person_admin_columns( $columns ) {
    $new_columns = array();
    foreach ( $columns as $key => $value ) {
        if ( $key === 'title' ) {
            $new_columns['featured_image'] = __( 'Image', 'your-people' );
        }
        $new_columns[$key] = $value;
    }
    return $new_columns;
}
add_filter( 'manage_person_posts_columns', __NAMESPACE__ . '\add_person_admin_columns' );

/**
 * Render custom column content in the person post type admin list.
 *
 * @param string $column_name The name of the column.
 * @param int    $post_id     The current post ID.
 */
function render_person_admin_columns( $column_name, $post_id ) {
    if ( $column_name === 'featured_image' ) {
        $thumbnail_id = get_post_thumbnail_id( $post_id );
        if ( $thumbnail_id ) {
            $thumbnail_url = wp_get_attachment_image_url( $thumbnail_id, 'thumbnail' );
            echo '<div class="person-thumbnail" style="background-image: url(' . esc_url( $thumbnail_url ) . ');"></div>';
        } else {
            echo '—';
        }
    }
}
add_action( 'manage_person_posts_custom_column', __NAMESPACE__ . '\render_person_admin_columns', 10, 2 );

/**
 * Add styles for the person thumbnail in admin columns.
 */
function person_admin_column_styles() {
    echo '<style>
        .column-featured_image { width: 50px; }
        .person-thumbnail {
            width: 40px;
            height: 40px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 2px;
        }
    </style>';
}
add_action( 'admin_head', __NAMESPACE__ . '\person_admin_column_styles' );

/**
 * Change the 'Title' column label to 'Name' for the person post type.
 *
 * @param array $columns The column labels.
 * @return array Modified column labels.
 */
function modify_person_column_labels( $columns ) {
    $columns['title'] = __( 'Name', 'your-people' );
    return $columns;
}
add_filter( 'manage_person_posts_columns', __NAMESPACE__ . '\modify_person_column_labels' );