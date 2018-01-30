<?php
defined('_VIDMIZER_') or die();

class ContentTrigger {
    private static $capability1 = 'edit_posts';
    private static $capability2 = 'edit_pages';
    private static $class = 'trigger_content';
    public static function content_trigger_button() {
            if ( current_user_can( self::$capability1 ) && current_user_can( self::$capability2 ) ) {
              add_filter( 'mce_buttons', array('ContentTrigger', 'register_content_trigger_button') );
              add_filter( 'mce_external_plugins', array('ContentTrigger', 'add_content_trigger_button') );
            }
    }
    public static function register_content_trigger_button($buttons) {
            array_push( $buttons, 'trigger_content' );
            return $buttons;
    }
    public static function add_content_trigger_button( $plugin_array ) {
            $plugin_array[self::$class] = plugins_url( 'assets/js/contenttrigger.js', dirname(__FILE__) );
            return $plugin_array;
    }
}
