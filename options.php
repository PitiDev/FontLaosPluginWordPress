<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(! current_user_can('administrator')) exit;

// if this fails, check_admin_referer() will automatically print a "failed" page and die.
if ( ! empty( $_POST ) && check_admin_referer( 'nonce_verify', 'chkNonce' ) ) {
   // process form data, e.g. update fields
}

if(isset($_POST['submit']))
{
	$f = $_POST['LFS_fonts'];
	if($f=== ''){
		$f = 'phetsarath';
	}
	
	$safe_f = sanitize_text_field($f);
	update_post_meta($post->ID,'LFS_fonts',$safe_f);
	update_option("LFS_lao_font",$safe_f);
	echo '<div id="message" class="updated fade"><p><h1>ອັບເດດແລ້ວ!</h1></p></div>';
	echo '<script>location.reload();</script>';
}
?>

<?php
global $wpdb;
$tbl = $wpdb->options;
$chosen = $wpdb->get_row( "SELECT * FROM $tbl WHERE option_name='LFS_lao_font'");

if($chosen->option_value === "phetsarath")
{
	$fname = "Phetsarath OT";
}

else if($chosen->option_value === "NotoSerifLao")
	$fname = "Noto Serif Lao";


?>

<div class="wrap">
<h1><span class="dashicons dashicons-admin-customizer"></span> ຕັ້ງຄ່າ Lao Piti Fonts</h1>
<br>
<br>

<img src="<?= esc_url(plugins_url('laoflag.png',__FILE__)); ?>" width="150" height="150">
<h1 stlye="text-shadow: 2px 2px #ff0000;"><u>ພາສາລາວ ສຳລັບ Wordpress</u></h1>
<p style="font-size:22px">ທ່ານກຳລັງໃຊ້ຟ້ອນ <strong><span style="color:red"><?= esc_html($fname); ?></span></strong></p>
<br>
<form method="post">
<table style="font-size:22px">
	<tr>
		<td>ເລືອກ Font ທີ່ຕ້ອງການ: </td>
		<td>
			<select style="font-size:18px;width:300px;" name="LFS_fonts" id="LFS_fonts">
				<option value="phetsarath">Phetsarath OT</option>
				<option value="NotoSerifLao">Noto Sane Lao</option>
			</select>
		</td>
	<tr>
	<tr>
		<td><?php wp_nonce_field( 'nonce_verify', 'chkNonce' ); ?></td>
		<td><input type="submit" value="ປ່ຽນ Font" name="submit" style="font-size:18px"></td>
	</tr>
</table>
</form>
<br>
<center>
<p style="font-weight:bold;font-size:18px;">ພັດທະນາໂດຍ : ທ.ປິຕິ ພັນທະສົມບັດ</p>
<p><a href="#" target="_blank"><img src="<?= esc_url(plugins_url('Globe.png',__FILE__)); ?>" width="50" height="50"></a> <a href="http://facebook.com/piti.laos" target="_blank"><img src="<?= esc_url(plugins_url('facebook.png',__FILE__)); ?>" width="50" height="50"></a></p>
</center>
</div>