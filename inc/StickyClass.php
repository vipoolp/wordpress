<?php
defined('_VIDMIZER_') or die();

class StickyClass {
    private static $capability1 = 'edit_posts';
    private static $capability2 = 'edit_pages';
    private static $class = 'sticky_class';
    public static function sticky_class_button() {
            if ( current_user_can( self::$capability1 ) && current_user_can( self::$capability2 ) ) {
              add_filter( 'mce_buttons', array('StickyClass', 'register_sticky_class_button') );
              add_filter( 'mce_external_plugins', array('StickyClass', 'add_sticky_class_button') );
            }
    }
    public static function register_sticky_class_button($buttons) {
            array_push( $buttons, 'sticky_class' );
            return $buttons;
    }
    public static function add_sticky_class_button( $plugin_array ) {
            $plugin_array[self::$class] = plugins_url( 'assets/js/stickyclass.js', dirname(__FILE__) );
            return $plugin_array;
    }
}
