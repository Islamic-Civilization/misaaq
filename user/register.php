<?php
if ( ! defined( 'ABSPATH' ) ) exit;
include (dirname( __FILE__ ) .'/global.php');

//1. Add a new form element...
add_action( 'register_form', 'misaaq_register_form' );
function misaaq_register_form() {

$first_name = ( ! empty( $_POST[mUserFirstNameKey] ) ) ? trim( $_POST[mUserFirstNameKey] ) : '';
$last_name = ( ! empty( $_POST[mUserLastNameKey] ) ) ? trim( $_POST[mUserLastNameKey] ) : '';
$jense = ( ! empty( $_POST[mUserJenseKey] ) ) ? trim( $_POST[mUserJenseKey] ) : '';
$code_meli = ( isset( $_POST[mUserCodeMelli] ) ) ? trim($_POST[mUserCodeMelli]) : '';
$code_daneshjo = ( isset( $_POST[mUserCodeDaneshjo] ) ) ? trim($_POST[mUserCodeDaneshjo]) : '';
$telephone = ( isset( $_POST[mUserTelephone] ) ) ? trim($_POST[mUserTelephone]) : '';
//_e( 'First Name', 'misaaq-domain' )
	?>
	<p>
		<label for="first_name">نام<br />
			<input required type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr( wp_unslash( $first_name ) ); ?>" size="25" /></label>
	</p>
	<p>
		<label for="last_name">نام خانوادگی<br />
			<input required type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr( wp_unslash( $last_name ) ); ?>" size="25" /></label>
	</p>
	<p>
		<label for="jense" name="jense" id="jense">جنسیت<br />
			<input type="radio" name="jense" id="jense" value="male" checked="checked"> <?php echo "مرد";?></input>
			<input type="radio" name="jense" value="female" ><?php echo "زن"; ?></input>
      </label>
	</p>
    <p>
        <label for="code_meli">کد ملّی<br />
            <input required type="text" name="code_meli" id="code_meli" class="input" value="<?php echo esc_attr( stripslashes( $code_meli ) ); ?>" size="25" /></label>
    </p>
    <p>
        <label for="code_daneshjo">کد دانشجویی یا کارمندی<br />
            <input required type="text" name="code_daneshjo" id="code_daneshjo" class="input" value="<?php echo esc_attr( stripslashes( $code_daneshjo ) ); ?>" size="25" /></label>
    </p>
    <p>
        <label for="telephone">تلفن همراه<br />
            <input required type="text" name="telephone" id="telephone" class="input" value="<?php echo esc_attr( stripslashes( $telephone ) ); ?>" size="25" /></label>
    </p>
    <p>
        <label for="eskan">محلّ اسکان<br />
		<select name="eskan" id="eskan" class="input">
  <option value="tehran" selected >تهرانی</option>
  <option value="tarasht2">طرشت۲</option>
  <option value="tarasht3">طرشت۳</option>
  <option value="ahmadi_roshan">احمدی روشن</option>
  <option value="shoride">شوریده</option>
		</select>
    </p>

    <?php
}
//add_filter( 'wpmu_signup_user_notification', '__return_false' );

//2. Add validation. In this case, we make sure first_name is required.
add_filter( 'registration_errors', 'misaaq_registration_errors', 10, 3 );
function misaaq_registration_errors( $errors, $sanitized_user_login, $user_email ) {
	if ((empty( $_POST[mUserFirstNameKey] ) || ! empty( $_POST[mUserFirstNameKey] ) && trim( $_POST[mUserFirstNameKey] ) == '') ||
      (empty( $_POST[mUserLastNameKey] ) || ! empty( $_POST[mUserLastNameKey] ) && trim( $_POST[mUserLastNameKey] ) == '') ||
      (empty( $_POST[mUserCodeMelli] ) || ! empty( $_POST[mUserCodeMelli] ) && trim( $_POST[mUserCodeMelli] ) == '') ||
      (empty( $_POST[mUserCodeDaneshjo] ) || ! empty( $_POST[mUserCodeDaneshjo] ) && trim( $_POST[mUserCodeDaneshjo] ) == '') ||
      (empty( $_POST[mUserTelephone] ) || ! empty( $_POST[mUserTelephone] ) && trim( $_POST[mUserTelephone] ) == '')) {
		$errors->add( 'first_name_error', __( '<strong>ERROR</strong>: You must fill all registeration filed.', 'misaaq-domain' ) );
	}

	return $errors;
}

//3. Finally, save our extra registration user meta.
add_action( 'user_register', 'misaaq_user_register' );
function misaaq_user_register( $user_id ) {
	if ( ! empty( $_POST[mUserFirstNameKey] ) )
		update_user_meta( $user_id, mUserFirstNameKey, trim( $_POST[mUserFirstNameKey] ) );
	if ( ! empty( $_POST[mUserLastNameKey] ) )
		update_user_meta( $user_id, mUserLastNameKey, trim( $_POST[mUserLastNameKey] ) );
	if ( ! empty( $_POST[mUserJenseKey] ) )
		update_user_meta( $user_id, mUserJenseKey, trim( $_POST[mUserJenseKey] ) );
  if ( ! empty( $_POST[mUserCodeMelli] ) )
		update_user_meta( $user_id, mUserCodeMelli, trim( $_POST[mUserCodeMelli] ) );
  if ( ! empty( $_POST[mUserCodeDaneshjo] ) )
		update_user_meta( $user_id, mUserCodeDaneshjo, trim( $_POST[mUserCodeDaneshjo] ) );
  if ( ! empty( $_POST[mUserTelephone] ) )
		update_user_meta( $user_id, mUserTelephone, trim( $_POST[mUserTelephone] ) );
  if ( ! empty( $_POST[mUserEskan] ) )
		update_user_meta( $user_id, mUserEskan, trim( $_POST[mUserEskan] ) );
	update_user_meta( $user_id, mUserHesab, 0 );
}
?>
