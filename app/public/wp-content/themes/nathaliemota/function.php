<?php
function nathaliemota_setup() {
    if (function_exists('add_theme_support')) {
        // support pour title tag
        add_theme_support('title-tag');

        // support pour custom logo
        add_theme_support('custom-logo');

        // support pour post thumbnails
        add_theme_support('post-thumbnails');
    }

    // Registration pour main menu
    register_nav_menus(array(
        'main-menu' => __('Main Menu', 'nathaliemota')
    ));
}
add_action('after_setup_theme', 'nathaliemota_setup');

// Enqueue styles
function nathaliemota_enqueue_styles() {
    wp_enqueue_style('nathaliemota-style', get_template_directory_uri() . 'css/style.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'nathaliemota_enqueue_styles');

?>
<?php
// Enqueue jQuery and custom script

function my_theme_enqueue_scripts() {
    wp_enqueue_script('load-more', get_template_directory_uri() . '/js/script.js', array('jquery'), null, true);

    wp_localize_script('load-more', 'loadmore_params', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('loadmore_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');

// AJAX handler

function loadmore_ajax_handler() {
    check_ajax_referer('loadmore_nonce', 'nonce');

    $paged = isset($_POST['page']) ? intval($_POST['page']) + 1 : 1;

    $args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 8,
        'paged'          => $paged,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template/photos');
        }
        wp_reset_postdata();

        $content = ob_get_clean();

        wp_send_json_success(array('content' => $content, 'next_page' => $paged));
    } else {
        wp_send_json_error('No more posts');
    }
}

add_action('wp_ajax_loadmore', 'loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmore', 'loadmore_ajax_handler');
?>


