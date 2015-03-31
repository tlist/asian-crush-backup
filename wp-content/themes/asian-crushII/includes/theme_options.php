<?php

/* Admin styles & scripts */
add_action( 'admin_init', 'amr_admin_init' );
function amr_admin_init() {
   wp_register_style( 'amr_admin_css', get_bloginfo( 'template_url' ) . '/includes/theme_options.css' );
   wp_register_script( 'amr_admin_js', get_bloginfo( 'template_url' ) . '/includes/theme_options.js' );
}

function amr_admin_styles() {
   wp_enqueue_style('postbox');
   wp_enqueue_style('media-upload');
   wp_enqueue_style('thickbox');
	 wp_enqueue_style( 'farbtastic' );
   wp_enqueue_style( 'amr_admin_css' );
}
function amr_admin_js() {
   wp_enqueue_script('media-upload');
   wp_enqueue_script('thickbox');
	 wp_enqueue_script( 'farbtastic' );
   wp_enqueue_script( 'amr_admin_js' );
}

/* Add admin pages */
function amr_options_page() {
    add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', basename(__FILE__), 'amr_options' );
    add_action( 'admin_print_styles', 'amr_admin_styles' );
    add_action( 'admin_enqueue_scripts', 'amr_admin_js' );
}
add_action('admin_menu', 'amr_options_page');

function amr_select_font_family($strFont='', $strVarName='') {
	$strResult	=	'';
	$strResult	.=	'<select';
	$strResult	.=	$strFont ? ' name="'.$strVarName.'" id="'.$strVarName.'"' : '';
	$strResult	.=	'>';
	$strResult	.=		'<option value="Helvetica" '. ($strFont == 'Helvetica' ? 'selected="selected"' : '') .'> '. __('Helvetica') .'</option>';
	$strResult	.=		'<option value="Arial" '. ($strFont == 'Arial' ? 'selected="selected"' : '') .'> '. __('Arial') .'</option>';
	$strResult	.=		'<option value="Georgia" '. ($strFont == 'Georgia' ? 'selected="selected"' : '') .'> '. __('Georgia') .'</option>';
	$strResult	.=		'<option value="Droid Sans Mono" '. ($strFont == 'Droid Sans Mono' ? 'selected="selected"' : '') .'> '. __('Droid Sans Mono') .'</option>';
	$strResult	.=		'<option value="Arvo" '. ($strFont == 'Arvo' ? 'selected="selected"' : '') .'> '. __('Arvo') .'</option>';
	$strResult	.=		'<option value="Bentham" '. ($strFont == 'Bentham' ? 'selected="selected"' : '') .'> '. __('Bentham') .'</option>';
	$strResult	.=		'<option value="Lato" '. ($strFont == 'Lato' ? 'selected="selected"' : '') .'> '. __('Lato') .'</option>';
	$strResult	.=	'</select>';
	
	return $strResult;
}

/***** Options page *****/

function amr_options() {
    if ( isset( $_POST['update_options'] ) ) { amr_options_update(); }  //check options update
	?>
    <div class="wrap dailyfashion">
        <div id="icon-options-general" class="icon32"><br /></div>
		<h2><?php _e('Asian Crush Theme Options'); ?></h2>
				<form method="post" action="">
            <fieldset>
                <input type="hidden" name="update_options" value="true"/>

                <div id="poststuff" class="metabox-holder">
                    <div class="meta-box-sortables">
										
											<!-- Home page -->
											<div class="postbox">
												<div class="handlediv" title="<?php _e('Click to toggle'); ?>">
														<br/>
												</div>
												
												<h3 class="hndle"><span><?php _e('Home page Options'); ?></span></h3>
												<div class="inside">
													
													<h3><?php _e('Slideshow Category'); ?></h3>
													<table class="form-table">
													
													<?php
													for ($i=1; $i<7; $i++) {
													?>
														
														<tr>
															<th scope="row">
																<label for="amr_home_cate_<?php echo $i ?>"><?php echo __('Category ID').' - '.$i; ?></label>
															</th>
															<td>
																<input type="text" name="amr_home_cate_<?php echo $i ?>" id="amr_home_cate_<?php echo $i ?>" value="<?php echo get_option('amr_home_cate_'.$i) ?>"/>
																<br />
																<span class="description"><?php printf(__('ID of the Movie genre to show on line %d, from Movies -> Genres. zero or blank means not shown'), $i); ?></span>
															</td>
														</tr>
														
													<?php
													}
													?>
														<tr>
															<th scope="row">
																<label for="amr_slideshow_speed"><?php echo __('Speed'); ?></label>
															</th>
															<td>
																<input type="text" name="amr_slideshow_speed" id="amr_slideshow_speed" value="<?php echo get_option('amr_slideshow_speed') ?>"/>
																<br />
																<span class="description"><?php echo __('Speed of the transition, in milisecond'); ?></span>
															</td>
														</tr>
														
													</table>
													
													<h3><?php _e('Caching'); ?></h3>
													<table class="form-table">
														<tr>
															<th scope="row">
																<label for="amr_cache_clear"><?php echo __('Clear cache') ?></label>
															</th>
															<td>
																<input type="checkbox" name="amr_cache_clear" id="amr_cache_clear" />
																<br />
																<span class="description"><?php echo __('Clear the cache of blocks in the theme') ?></span>
															</td>
														</tr>
													</table>
													
													<p><input type="submit" value="<?php _e('Save Changes'); ?>" class="button button-primary"/></p>
												</div>
											</div>
											<!-- /Home page -->

											<!-- Find Operator -->
											<div class="postbox">
												<div class="handlediv" title="<?php _e('Click to toggle'); ?>">
														<br/>
												</div>
												<h3 class="hndle"><span><?php _e('Watch Asian Crush Options'); ?></span></h3>

												<div class="inside">
													
													<table class="form-table">
														<tr>
															<th scope="row">
																<label for="amr_watch_page_intro"><?php echo __('Intro Text') ?></label>
															</th>
															<td>
																<input type="text" size="120" name="amr_watch_page_intro" id="amr_watch_page_intro" value="<?php echo get_option('amr_watch_page_intro') ?>"/>
																<br />
																<span class="description"><?php __('Intro text for this Watch Asian Crush page') ?></span>
															</td>
														</tr>
													</table>
													
													<p><input type="submit" value="<?php _e('Save Changes'); ?>" class="button button-primary"/></p>
												</div>
											</div>
											<!-- /Find Operator -->
											
											<!-- Contact -->
											<div class="postbox">
												<div class="handlediv" title="<?php _e('Click to toggle'); ?>">
														<br/>
												</div>
												<h3 class="hndle"><span><?php _e('Contact Options'); ?></span></h3>

												<div class="inside">
													
													<h3><?php _e('Email'); ?></h3>
													<table class="form-table">
														<tr>
															<th scope="row">
																<label for="amr_contact_recipient_emails"><?php echo __('Recipient Emails') ?></label>
															</th>
															<td>
																<input type="text" size="120" name="amr_contact_recipient_emails" id="amr_contact_recipient_emails" value="<?php echo get_option('amr_contact_recipient_emails') ?>"/>
																<br />
																<span class="description"><?php __('Emails of recipients for contact page, each email is separated by comma. Leave blank, the email will be sent to admin') ?></span>
															</td>
														</tr>
													</table>
													
													<p><input type="submit" value="<?php _e('Save Changes'); ?>" class="button button-primary"/></p>
												</div>
											</div>
											<!-- /Contact -->
											
											<!-- Submit film -->
											<div class="postbox">
												<div class="handlediv" title="<?php _e('Click to toggle'); ?>">
														<br/>
												</div>
												<h3 class="hndle"><span><?php _e('Submit Film Options'); ?></span></h3>

												<div class="inside">
													
													<h3><?php _e('Email'); ?></h3>
													<table class="form-table">
														<tr>
															<th scope="row">
																<label for="amr_submit_film_recipient_emails"><?php echo __('Recipient Emails') ?></label>
															</th>
															<td>
																<input type="text" size="120" name="amr_submit_film_recipient_emails" id="amr_submit_film_recipient_emails" value="<?php echo get_option('amr_submit_film_recipient_emails') ?>"/>
																<br />
																<span class="description"><?php __('Emails of recipients for submit film page, each email is separated by comma. Leave blank, the email will be sent to admin') ?></span>
															</td>
														</tr>
													</table>

													
													<p><input type="submit" value="<?php _e('Save Changes'); ?>" class="button button-primary"/></p>
												</div>
											</div>
											<!-- /Submit film -->

											<!-- Company information -->
											<div class="postbox">
												<div class="handlediv" title="<?php _e('Click to toggle'); ?>">
														<br/>
												</div>
												<h3 class="hndle"><span><?php _e('Company Infomation'); ?></span></h3>

												<div class="inside">
													<h3><?php _e('Company Infomation'); ?></h3>
													<table class="form-table">
														<tr>
															<th scope="row">
																<label for="amr_company_information_intro"><?php echo __('Company Intro') ?></label>
															</th>
															<td>
																<textarea name="amr_company_information_intro" cols="60" rows="5"><?php echo get_option('amr_company_information_intro') ?></textarea>
																<br />
																<span class="description"><?php __('Put introduction for your company here') ?></span>
															</td>
														</tr>
													</table>
													
													<h3><?php _e('Company Contact'); ?></h3>
													<table class="form-table">
														<tr>
															<th scope="row">
																<label for="amr_company_information_address"><?php echo __('Address') ?></label>
															</th>
															<td>
																<textarea name="amr_company_information_address" cols="60" rows="5"><?php echo get_option('amr_company_information_address') ?></textarea>
																<br />
																<span class="description"><?php __("Company's Address") ?></span>
															</td>
														</tr>
														<tr>
															<th scope="row">
																<label for="amr_company_information_tel"><?php echo __('Telephone') ?></label>
															</th>
															<td>
																<input type="text" size="120" name="amr_company_information_tel" id="amr_company_information_tel" value="<?php echo get_option('amr_company_information_tel') ?>"/>
																<br />
																<span class="description"><?php  __("Company's Telephone")  ?></span>
															</td>
														</tr>
														<tr>
															<th scope="row">
																<label for="amr_company_information_email"><?php echo __('Emails') ?></label>
															</th>
															<td>
																<input type="text" size="120" name="amr_company_information_email" id="amr_company_information_email" value="<?php echo get_option('amr_company_information_email') ?>"/>
																<br />
																<span class="description"><?php __("Company's Email") ?></span>
															</td>
														</tr>

													</table>

													
													<p><input type="submit" value="<?php _e('Save Changes'); ?>" class="button button-primary"/></p>
												</div>
											</div>
											<!-- /Submit film -->
											
											<!-- Option For MailChimp -->
											<div class="postbox">
												<div class="handlediv" title="<?php _e('Click to toggle'); ?>">
														<br/>
												</div>
												<h3 class="hndle"><span><?php _e('MailChimp Setup'); ?></span></h3>

												<div class="inside">
																										
													<h3><?php _e('MailChimp Config'); ?></h3>
													<table class="form-table">
														<tr>
															<th scope="row">
																<label for="amr_mailchimp_apikey"><?php echo __('API Key') ?></label>
															</th>
															<td>
															<input type="text" size="120" name="amr_mailchimp_apikey" id="amr_mailchimp_apikey" value="<?php echo get_option('amr_mailchimp_apikey') ?>"/>
																<br />
																<span class="description"><?php __('API Key - see http://admin.mailchimp.com/account/api') ?></span>
															</td>
														</tr>
														<tr>
															<th scope="row">
																<label for="amr_list_id"><?php echo __('List Id') ?></label>
															</th>
															<td>
																<input type="text" size="120" name="amr_list_id" id="amr_list_id" value="<?php echo get_option('amr_list_id') ?>"/>
																<br />
																<span class="description"><?php  __("Login to MC account, go to List, then List Tools, and look for the List ID entry")  ?></span>
															</td>
														</tr>
														<tr>
															<th scope="row">
																<label for="amr_api_url"><?php echo __('MailChimp Api URL') ?></label>
															</th>
															<td>
																<input type="text" size="120" name="amr_api_url" id="amr_api_url" value="<?php echo get_option('amr_api_url') ?>"/>
																<br />
																<span class="description"><?php __("MailChimp Api URL") ?></span>
															</td>
														</tr>

													</table>

													
													<p><input type="submit" value="<?php _e('Save Changes'); ?>" class="button button-primary"/></p>
												</div>
											</div>
											<!-- /MailChimp -->

											
                        
										</div>
                </div>

            </fieldset>
        </form>
				
        
    </div>
<?php
}

function amr_options_update() {
	/* Home */
	for ($i=1; $i<7; $i++) {
		if (isset($_POST['amr_home_cate_'.$i])) update_option('amr_home_cate_'.$i, (int)($_POST['amr_home_cate_'.$i]));
	}

	if (isset($_POST['amr_slideshow_speed'])) update_option('amr_slideshow_speed', (int)($_POST['amr_slideshow_speed']));
	
	/* Contact */
	if (isset($_POST['amr_contact_recipient_emails'])) update_option('amr_contact_recipient_emails', strip_tags(trim($_POST['amr_contact_recipient_emails'])));
	
	/* Submit Film */
	if (isset($_POST['amr_submit_film_recipient_emails'])) update_option('amr_submit_film_recipient_emails', strip_tags(trim($_POST['amr_submit_film_recipient_emails'])));
	
	if (isset($_POST['amr_company_information_intro'])) update_option('amr_company_information_intro', stripslashes_deep(trim($_POST['amr_company_information_intro'])));
	
	if (isset($_POST['amr_company_information_address'])) update_option('amr_company_information_address', strip_tags(trim($_POST['amr_company_information_address'])));
	
	if (isset($_POST['amr_company_information_tel'])) update_option('amr_company_information_tel', strip_tags(trim($_POST['amr_company_information_tel'])));
	
	if (isset($_POST['amr_company_information_email'])) update_option('amr_company_information_email', strip_tags(trim($_POST['amr_company_information_email'])));

/* Mail Chimp Config*/
	if (isset($_POST['amr_mailchimp_apikey'])) update_option('amr_mailchimp_apikey', strip_tags(trim($_POST['amr_mailchimp_apikey'])));
	if (isset($_POST['amr_list_id'])) update_option('amr_list_id', strip_tags(trim($_POST['amr_list_id'])));
	if (isset($_POST['amr_api_url'])) update_option('amr_api_url', strip_tags(trim($_POST['amr_api_url'])));
/* /Mail Chimp Config*/
	
	if (isset($_POST['amr_watch_page_intro'])) update_option('amr_watch_page_intro', stripslashes_deep(trim($_POST['amr_watch_page_intro'])));
	
	if (isset($_POST['amr_cache_clear'])) PfBase::app()->clearCache();
}
