<?php
/*
  Plugin Name: Lao piti Fonts
  Plugin URI: http://piti.laotechtalk.com
  Description: Plugin ສຳລັບປ່ຽນຟ້ອນໃນເວັບໄຊ້ຂອງທ່ານ: Phetsarath OT, Noto Sans Ui...
  Version: 1.0.0
  Author: Piti Phanthasombath
  Author URI: http://facebook.com/piti.laos
  
*/

 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
 //Menu
 add_action( 'admin_menu', 'LFS_wp_lao' );
 
 function LFS_wp_lao()
 {
	 add_menu_page( 'ຕັ້ງຄ່າ ຟັ້ອນລາວ', 'Lao Fonts', 'manage_options', 'lao-fonts', 'LFS_lao_fonts_options' );
	 
 }
 
 function LFS_lao_fonts_options()
 {
	 if(!current_user_can('manage_options'))
	 {
		 wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	 }
	 include __DIR__."/options.php";
 }

global $wpdb;
$tbl = $wpdb->options;
$chosen = $wpdb->get_row( "SELECT * FROM $tbl WHERE option_name='LFS_lao_font'");
$setFont = $chosen->option_value;

 // Action
switch ($setFont)
{
	case $setFont=='phetsarath':
		LFS_phetsarath();
		break;
	case $setFont=='LaoSansPro':
		LFS_LaoSansPro();
		break;
	case $setFont=='NotoSerifLao':
		LFS_NotoSerifLao();
		break;
	default:
		LFS_phetsarath();
		break;
}

function LFS_phetsarath()
{
	add_action('wp_enqueue_scripts','LFS_phetsarath_f');
	function LFS_phetsarath_f()
	{
		$locate = plugins_url('phetsarath/style.css',__FILE__);
		wp_register_style( 'lao_fonts',$locate);
		wp_enqueue_style('lao_fonts');
	}
}


function LFS_NotoSerifLao()
{
	add_action('wp_enqueue_scripts','LFS_NotoSerifLao_f');
	function LFS_NotoSerifLao_f()
	{
		$locate = plugins_url('NotoSerifLao/style.css',__FILE__);
		wp_register_style( 'lao_fonts',$locate);
		wp_enqueue_style('lao_fonts');
	}
}

?>