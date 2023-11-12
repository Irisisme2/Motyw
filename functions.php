<?php
function techvibe_theme_setup() {
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu'
    ));
    wp_enqueue_style('techvibe-style', get_stylesheet_uri());
}
add_action('after_setup_theme', 'techvibe_theme_setup');

function techvibe_scripts() {
    wp_enqueue_style('techvibe-style', get_stylesheet_uri());
    wp_enqueue_script('techvibe-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true);
    wp_enqueue_script('techvibe-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'techvibe_scripts');

function techvibe_widgets_init() {
    register_sidebar(array(
        'name' => 'Sidebar Widget Area',
        'id' => 'sidebar-1',
        'description' => 'Widgets for the sidebar',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'techvibe_widgets_init');

function techvibe_latest_posts_section() {
    echo '<section class="latest-posts-section">';
    echo '<h2>Najnowsze wpisy</h2>';
    $latest_posts = new WP_Query(array('posts_per_page' => 3));
    if ($latest_posts->have_posts()) {
        echo '<ul>';
        while ($latest_posts->have_posts()) {
            $latest_posts->the_post();
            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo 'Brak najnowszych wpisów.';
    }
    echo '</section>';
    wp_reset_postdata();
}

function techvibe_about_us_section() {
    echo '<section class="about-us-section">';
    echo '<h2>O nas</h2>';
    echo '<p>Cześć! Jesteśmy zespołem TechVibe, pasjonujemy się nowymi technologiami i tworzeniem strony internetowych. Chcemy dzielić się naszą wiedzą z Tobą. Sprawdź nasze najnowsze artykuły i bądź na bieżąco!</p>';
    echo '</section>';
}

function techvibe_contact_section() {
    echo '<section class="contact-section">';
    echo '<h2>Kontakt</h2>';
    echo '<p>Masz pytanie? Chcesz się z nami skontaktować? Wypełnij formularz na stronie kontaktowej lub wyślij wiadomość na adres: kontakt@techvibe.com. Zawsze jesteśmy gotowi pomóc!</p>';
    echo '</section>';
}

function techvibe_featured_posts() {
    echo '<section class="featured-posts">';
    echo '<h2>Wyróżnione artykuły</h2>';
    $featured_posts = new WP_Query(array('posts_per_page' => 3, 'category' => 'featured'));
    if ($featured_posts->have_posts()) {
        echo '<ul>';
        while ($featured_posts->have_posts()) {
            $featured_posts->the_post();
            echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo 'Brak wyróżnionych artykułów.';
    }
    echo '</section>';
    wp_reset_postdata();
}

function techvibe_dynamic_menu() {
    add_filter('nav_menu_css_class', 'techvibe_menu_classes', 10, 2);
    add_filter('nav_menu_link_attributes', 'techvibe_menu_link_attributes', 10, 3);
}

function techvibe_menu_classes($classes, $item) {
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active'; 
    return $classes;
}

function techvibe_menu_link_attributes($atts, $item, $args) {
    if (isset($atts['href']) && in_array('current-menu-item', $item->classes)) {
        $atts['aria-current'] = 'page'; 
    }
    return $atts;
}
