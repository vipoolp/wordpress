<?php
/*
 * Plugin Name: WP Vidmizer
 * Plugin URI: http://xoomsolutions.com
 * Description: Create and customize sticky video in pages
 * Author: Xoom Solutions
 * Version: 1.0
 * Author URI: http://xoomsolutions.com
 */
if ( ! defined( 'ABSPATH' ) ) exit;
/******************************************
 * FOR CLIENT CODE ERROR error_reporting(0);
 *****************************************/
error_reporting(0);
/******************/
define('_VIDMIZER_', 1);
include_once('inc/Main.php');
Assets::run();
add_action( 'admin_menu', array('Main','plugin_menu_page' ));
add_action( 'admin_init', array('StickyClass', 'sticky_class_button') );
add_action( 'admin_init', array('ContentTrigger', 'content_trigger_button') );
include_once('template/Frontend.php');
add_action( 'wp', array('Frontend', 'sticky_page'));
add_action( 'wp', array('Frontend', 'trigger_page'));
if($_GET['page']=="wp-vidmizer" || $_GET['page']=="sticky_campaign" || $_GET['page']=="triggered_campaign"){
	echo '
	<style>
		#wpwrap{
			background: #4AC29A;  
			background: -webkit-linear-gradient(to right, #BDFFF3, #4AC29A);  
			background: linear-gradient(to right, #BDFFF3, #4AC29A); 
			

		}

		
		table thead, table tbody {
			background-color: #fff;
		   
		}
		table thead th, table tfoot th,  table tbody td{
			color: #666;
    		padding: 10px;
    		
		}

		table thead th, table tfoot th{

    		border-bottom: 1px solid rgba(0,0,0,0.5);
		}

		table tbody td{
			
    		border-top: 1px solid rgba(0,0,0,0.5);
		}
		
	</style>

	<style type="text/css">
			.tabssss{
			  font-family: \'Lato\', sans-serif;
			}
			.tabssss ul {
			  font-size: 0;
			  position: relative;
			  padding: 0;
			  width: 100%;
			  margin: auto;
			  -webkit-user-select: none;
			     -moz-user-select: none;
			      -ms-user-select: none;
			          user-select: none;
			}

			.tabssss li {
			  display: inline-block;
			  width: 220px;
			  height: 60px;
			  background: #39CCCC;
			  font-size: 16px;
			  text-align: center;
			  line-height: 60px;
			  color: #fff;
			  text-transform: uppercase;
			  position: relative;
			  overflow: hidden;
			  cursor: pointer;
			}

			.tabssss .slider {
			  display: block;
			  position: absolute;
			  bottom: 0;
			  left: 0;
			  height: 4px;
			  background: #ED5564;
			  -webkit-transition: all 0.5s;
			  transition: all 0.5s;
			}
			/*  Ripple */

			.tabssss .ripple {
			  width: 0;
			  height: 0;
			  border-radius: 50%;
			  background: rgba(255, 255, 255, 0.4);
			  -webkit-transform: scale(0);
			          transform: scale(0);
			  position: absolute;
			  opacity: 1;
			}

			.tabssss .rippleEffect {
			  -webkit-animation: rippleDrop .6s linear;
			          animation: rippleDrop .6s linear;
			}

			@-webkit-keyframes rippleDrop {
			  100% {
			    -webkit-transform: scale(2);
			            transform: scale(2);
			    opacity: 0;
			  }
			}

			@keyframes rippleDrop {
			  100% {
			    -webkit-transform: scale(2);
			            transform: scale(2);
			    opacity: 0;
			  }
			}
		</style>
	';
}