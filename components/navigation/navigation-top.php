<?php
/**
* Displays navigation menu
* @param array $args Arguments
*/

if ( has_nav_menu( 'top' ) ) {
    $args = array(
        'theme_location'  => 'top',
        'container'       => 'nav',
        'container_id'    => 'site-navigation',
        'container_class' => 'main-navigation ',
        'menu_id'         => 'primary-menu',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 0,
    );
    wp_nav_menu( $args );
}
?>
