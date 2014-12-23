<?php

//
//  Custom Child Theme Functions
//

// I've included a "commented out" sample function below that'll add a home link to your menu
// More ideas can be found on "A Guide To Customizing The Thematic Theme Framework" 
// http://themeshaper.com/thematic-for-wordpress/guide-customizing-thematic-theme-framework/

// Adds a home link to your menu
// http://codex.wordpress.org/Template_Tags/wp_page_menu
//function childtheme_menu_args($args) {
//    $args = array(
//        'show_home' => 'Home',
//        'sort_column' => 'menu_order',
//        'menu_class' => 'menu',
//        'echo' => true
//    );
//	return $args;
//}
//add_filter('wp_page_menu_args','childtheme_menu_args');

// Unleash the power of Thematic's dynamic classes
// 
// define('THEMATIC_COMPATIBLE_BODY_CLASS', true);
// define('THEMATIC_COMPATIBLE_POST_CLASS', true);

// Unleash the power of Thematic's comment form
//
// define('THEMATIC_COMPATIBLE_COMMENT_FORM', true);

// Unleash the power of Thematic's feed link functions
//
// define('THEMATIC_COMPATIBLE_FEEDLINKS', true);

// This will create your widget area
function my_widgets_init() {
    register_sidebar(array(
        'name' => 'Header Aside',
        'id' => 'header-aside',
        'before_widget' => '<li id="%1$s" class="widgetcontainer %2$s">',
        'after_widget' => "</li>",
        'before_title' => "<h3 class=\"widgettitle\">",
        'after_title' => "</h3>\n",
    ));
    register_sidebar(array(
        'name' => 'Banner',
        'id' => 'banner-aside',
        'before_widget' => '<li id="%1$s" class="widgetcontainer %2$s">',
        'after_widget' => "</li>",
        'before_title' => "<h3 class=\"widgettitle\">",
        'after_title' => "</h3>\n",
    ));

}
add_action( 'init', 'my_widgets_init' );

// adding the widget area to your child theme
function my_header_widgets() {
if ( function_exists('dynamic_sidebar') && is_sidebar_active('header-aside') ) {
    echo '<div id="header-aside" class="aside">'. "\n" . '<ul class="xoxo">' . "\n";
    dynamic_sidebar('header-aside');
    echo '' . "\n" . '</ul></div><!-- #header-aside .aside -->'. "\n";
    echo "\n" . '</div><!-- #header-box -->'. "\n";
}
}
add_action('thematic_header', 'my_header_widgets', 8);

function remove_branding() {
    remove_action('thematic_header','thematic_brandingopen',1);
}
add_action('init', 'remove_branding');

function my_brandingopen() { ?>
    <div id="header_box">
        <div id="branding">
<?php }
add_action('thematic_header','my_brandingopen',1);

// Turn on shortcodes in sidebar widgets
add_filter('widget_text', 'do_shortcode');

//Change search box text
function childtheme_search_value() {
    return "Search the site..";
}
add_filter('search_field_value', 'childtheme_search_value');

// Add widget below menu that spans full width
function my_banner() {
if ( function_exists('dynamic_sidebar') && is_sidebar_active('banner-aside') ) {
    echo '<div id="banner-aside" class="aside">'. "\n" . '<ul class="xoxo">' . "\n";
    dynamic_sidebar('banner-aside');
    echo '' . "\n" . '</ul></div><!-- #banner-aside .aside -->'. "\n";
}
}
add_filter('thematic_abovecontainer', 'my_banner');

function childtheme_override_postheader_posttitle() {
    $posttitle = "\n\n\t\t\t\t\t";

    if (is_single() || is_page()) {
        $posttitle .= '<h1 class="entry-title">' . $title_content . "</h1>\n";
    } elseif (is_404()) {
        $posttitle .= '<h1 class="entry-title">' . __('Not Found', 'thematic') . "</h1>\n";
    } else {
        $posttitle .= '<h2 class="entry-title">';
        $posttitle .= sprintf('<a href="%s" title="%s" rel="bookmark">%s</a>',
                                apply_filters('the_permalink', get_permalink()),
                                sprintf( esc_attr__('Permalink to %s', 'thematic'), the_title_attribute( 'echo=0' ) ),
                                $title_content
                                );
        $posttitle .= "</h2>\n";
    }

    return apply_filters('thematic_postheader_posttitle',$posttitle);
}

function childtheme_override_postheader() {

    global $post;

    if ( is_404() || $post->post_type == 'page') {
        $postheader = thematic_postheader_posttitle();
    } else {
        $postheader = thematic_postheader_posttitle() . thematic_postheader_postmeta();
    }

    echo apply_filters( 'thematic_postheader', $postheader ); // Filter to override default post header
}


?>
