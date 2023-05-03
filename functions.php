<?php add_action('admin_init', function () {
    if (!isset($_GET['updated'])) {
        return;
    }
    $nonce = $_GET['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'update-core')) {
        wp_die('Security check failed');
    }
}, 100);
?>

<?php
function assets()
{
    wp_enqueue_style('style', get_template_directory_uri() . '/css/main.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'assets');

function script_modal()
{
    wp_enqueue_script('modal', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'script_modal');
function montheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
}
add_action('after_setup_theme', 'montheme_supports');
?>

<?php
function add_search_form($items, $args)
{
    if ($args->theme_location == 'footer') {
        $items .= '<li>TOUS DROITS RÉSERVÉS</li>';
    } else {
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);


function add_search_form2($items, $args)
{
    if ($args->theme_location == 'header') {
        $items .= '<button id="myBtn" class="myBtn contact header " > Contact</button>';
    } else {
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'add_search_form2', 10, 2);
?>
<?php ini_set('zlib.output_compression', 'Off'); ?>


<?php add_filter('admin_init', 'my_admin_init');
function my_admin_init()
{
    add_filter('admin_notices', 'my_admin_notices');
}
function my_admin_notices()
{
    global $pagenow;
    if ($pagenow == 'plugins.php' && isset($_GET['deleted'])) {
        if ($_GET['deleted'] == 'true') {
            echo '<div class="notice notice-success is-dismissible"><p>Plugin has been successfully deleted!</p></div>';
        } else {
            echo '<div class="notice notice-error is-dismissible"><p>There was an error deleting the plugin.</p></div>';
        }
    }
}
?>