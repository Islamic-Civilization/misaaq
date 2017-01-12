<?php
if ( ! defined( 'ABSPATH' ) ) exit;
include_once(dirname( __FILE__ ) .'/global.php');

add_action( 'profile_personal_options', 'misaaq_extra_profile_fields' );

function misaaq_extra_profile_fields( $user ) {
    // get the value of a single meta key
    $meta_value = get_user_meta( $user->ID, mUserCodeMelli, true ); // $user contains WP_User object
    // do something with it.
    ?>
    <input type="text" value="<?php echo esc_attr( $meta_value ); ?>" name="value" />
    <?php
}

add_action( 'show_user_profile', 'misaaq_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'misaaq_show_extra_profile_fields' );

function misaaq_show_extra_profile_fields( $user ) {
  $jense = get_the_author_meta( mUserJenseKey, $user->ID );
  $code_meli = get_the_author_meta( mUserCodeMelli, $user->ID );
  $code_daneshjo = get_the_author_meta( mUserCodeDaneshjo, $user->ID );
  $telephone = get_the_author_meta( mUserTelephone, $user->ID );
  $eskan = get_the_author_meta( mUserEskan, $user->ID );
  $hesab = get_the_author_meta( mUserHesab, $user->ID );
  	?>
	<h2>اطلاعات شخصی کاربر</h2>

	<table class="form-table">
<?php /*
$first_name = get_the_author_meta( mUserFirstNameKey, $user->ID) ;
$last_name = get_the_author_meta( mUserLastNameKey, $user->ID );
<tr>
<th><label for="<?php echo mUserFirstNameKey;?>">نام</label></th>
<td>
	<input type="text" name="<?php echo mUserFirstNameKey;?>" id="<?php echo mUserFirstNameKey;?>" value="<?php echo esc_attr( $first_name ); ?>" class="regular-text" /><br />
</td></tr>
<tr>
<th><label for="<?php echo mUserLastNameKey;?>">نام خانوادگی</label></th>
<td>
	<input type="text" name="<?php echo mUserLastNameKey;?>" id="<?php echo mUserLastNameKey;?>" value="<?php echo esc_attr( $last_name ); ?>" class="regular-text" /><br />
</td></tr>
*/
$disabled_for_admin = (current_user_can('administrator')) ? '' : 'disabled';
?>
<tr>
<th><label for="<?php echo mUserJenseKey;?>">جنسیت</label></th>
<td>
  <input <?php echo $disabled_for_admin;?> type="radio" name="<?php echo mUserJenseKey;?>" id="<?php echo mUserJenseKey;?>" value="male" <?php if($jense =='male')echo 'checked="checked"' ?>>مرد</input>
  <input <?php echo $disabled_for_admin;?> type="radio" name="<?php echo mUserJenseKey;?>" value="female"  <?php if($jense =='female')echo 'checked="checked"' ?>>زن</input>
</td>
</tr>

<tr>
<th><label for="<?php echo mUserCodeMelli;?>">کد ملّی</label></th>
<td>
	<input <?php echo $disabled_for_admin;?> type="text" name="<?php echo mUserCodeMelli;?>" id="<?php echo mUserCodeMelli;?>" value="<?php echo esc_attr( $code_meli ); ?>" class="regular-text" /><br />
  <?php if(strlen($disabled_for_admin)>1) echo '<span class="description">برای تغییر با مدیریت سایت تماس حاصل نمایید.</span>'?>
</td>
</tr>

<tr>
<th><label for="<?php echo mUserHesab;?>">حساب پولی</label></th>
<td>
	<input <?php echo $disabled_for_admin;?> type="text" name="<?php echo mUserHesab;?>" id="<?php echo mUserHesab;?>" value="<?php echo esc_attr( $hesab ); ?>" class="regular-text" /><br />
  <?php if(strlen($disabled_for_admin)>1) echo '<span class="description">در صورت مغایرت با مدیریت سایت تماس حاصل نمایید.</span>'?>
</td>
</tr>

<tr>
<th><label for="<?php echo mUserCodeDaneshjo;?>">کد دانشجویی یا کارمندی</label></th>
<td>
	<input type="text" name="<?php echo mUserCodeDaneshjo;?>" id="<?php echo mUserCodeDaneshjo;?>" value="<?php echo esc_attr( $code_daneshjo ); ?>" class="regular-text" /><br />
</td>
</tr>

<tr>
<th><label for="<?php echo mUserTelephone;?>">تلفن همراه</label></th>
<td>
	<input type="text" name="<?php echo mUserTelephone;?>" id="<?php echo mUserTelephone;?>" value="<?php echo esc_attr( $telephone ); ?>" class="regular-text" /><br />
</td>
</tr>

<tr>
<th><label for="eskan">محلّ اسکان</label></th>

<td>
<select name="eskan" id="eskan" class="input">
<option value="tehran" <?php if($eskan == 'tehran')echo 'selected';?> >تهرانی</option>
<option value="tarasht2" <?php if($eskan == 'tarasht2')echo 'selected';?>>طرشت۲</option>
<option value="tarasht3" <?php if($eskan == 'tarasht3')echo 'selected';?>>طرشت۳</option>
<option value="ahmadi_roshan" <?php if($eskan == 'ahmadi_roshan')echo 'selected';?>>احمدی روشن</option>
<option value="shoride" <?php if($eskan == 'shoride')echo 'selected';?>>شوریده</option>
</select>
<span class="description">ممکن است در محل اسکان امکان توقف نباشد.</span>
</td>
</tr>

	</table>
<?php }

add_action( 'personal_options_update', 'misaaq_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'misaaq_save_extra_profile_fields' );
function misaaq_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

  if(strlen($disabled_for_admin)<=1){
    if(! empty( $_POST[mUserCodeMelli] ))
      update_user_meta( $user_id, mUserCodeMelli, trim( $_POST[mUserCodeMelli] ) );
    if ( ! empty( $_POST[mUserJenseKey] ) )
      update_user_meta( $user_id, mUserJenseKey, trim( $_POST[mUserJenseKey] ) );
    if ( ! empty( $_POST[mUserHesab] ) )
      update_user_meta( $user_id, mUserHesab, trim( $_POST[mUserHesab] ) );
  }
  elseif ((empty( $_POST[mUserFirstNameKey] ) || ! empty( $_POST[mUserFirstNameKey] ) && trim( $_POST[mUserFirstNameKey] ) == '') ||
      (empty( $_POST[mUserLastNameKey] ) || ! empty( $_POST[mUserLastNameKey] ) && trim( $_POST[mUserLastNameKey] ) == '') ||
      // (empty( $_POST[mUserCodeMelli] ) || ! empty( $_POST[mUserCodeMelli] ) && trim( $_POST[mUserCodeMelli] ) == '') ||
      (empty( $_POST[mUserCodeDaneshjo] ) || ! empty( $_POST[mUserCodeDaneshjo] ) && trim( $_POST[mUserCodeDaneshjo] ) == '') ||
      (empty( $_POST[mUserTelephone] ) || ! empty( $_POST[mUserTelephone] ) && trim( $_POST[mUserTelephone] ) == '')) {
    return false;
  }


  if ( ! empty( $_POST[mUserCodeDaneshjo] ) )
    update_user_meta( $user_id, mUserCodeDaneshjo, trim( $_POST[mUserCodeDaneshjo] ) );
  if ( ! empty( $_POST[mUserTelephone] ) )
    update_user_meta( $user_id, mUserTelephone, trim( $_POST[mUserTelephone] ) );
  if ( ! empty( $_POST[mUserEskan] ) )
    update_user_meta( $user_id, mUserEskan, trim( $_POST[mUserEskan] ) );
}
?>
