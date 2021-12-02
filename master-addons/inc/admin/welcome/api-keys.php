<div class="jltma-master-addons-tab-panel" id="jltma-master-addons-api-keys" style="display: none;">
	<div class="jltma-master-addons-features">
		<div class="jltma-tab-dashboard-header-wrapper">
			<div class="jltma-tab-dashboard-header-right is-flex">
				<button type="submit" class="jltma-button jltma-tab-element-save-setting">
					<?php _e('Save Settings', JLTMA_TD); ?>
				</button>
			</div>
		</div>

		<?php $jltma_api_options = get_option('jltma_api_save_settings'); ?>

		<div class="jltma-tab-dashboard-wrapper">
			<form action="" method="POST" id="jltma-api-forms-settings" class="jltma-api-forms-settings" name="jltma-api-forms-settings">
				<div class="jltma-addons-dashboard-tabs-wrapper is-flex">
					<!-- Start of reCaptcha Settings -->
					<div class="jltma-api-settings-element jltma-half">
						<h4><?php echo esc_html__('reCaptcha Settings', JLTMA_TD); ?></h4>
						<div class="jltma-api-element-inner">
							<div class="jltma-api-forms">

								<div class="jltma-form-group is-flex">
									<label for="recaptcha_site_key">
										<?php echo esc_html__('reCAPTCHA Site key', JLTMA_TD); ?>
									</label>
									<input name="recaptcha_site_key" type="text" class="jltma-form-control recaptcha_site_key" value="<?php echo isset($jltma_api_options['recaptcha_site_key']) ? $jltma_api_options['recaptcha_site_key'] : ""; ?>">
								</div>

								<div class="jltma-form-group is-flex">
									<label for="recaptcha_secret_key">
										<?php echo esc_html__('reCAPTCHA Secret key', JLTMA_TD); ?>
									</label>
									<input type="text" name="recaptcha_secret_key" class="jltma-form-control recaptcha_secret_key" value="<?php echo isset($jltma_api_options['recaptcha_secret_key']) ? $jltma_api_options['recaptcha_secret_key'] : ""; ?>">
								</div>

								<p>
									<?php echo sprintf(__('Go to your Google <a href="%1$s" target="_blank"> reCAPTCHA</a> > Account > Generate Keys (reCAPTCHA V2 > Invisible) and Copy and Paste here.', JLTMA_TD), esc_url('https://www.google.com/recaptcha/about/'));
									?>
								</p>
							</div>
						</div><!-- /.jltma-api-element-inner -->
					</div><!-- /.jltma-api-settings-element -->
					<!-- End of reCaptcha Settings -->



					<!-- Start of Twitter Settings -->
					<div class="jltma-api-settings-element jltma-half">
						<h4><?php echo esc_html__('Twitter Settings', JLTMA_TD); ?></h4>
						<div class="jltma-api-element-inner">
							<div class="jltma-api-forms">

								<div class="jltma-form-group is-flex">
									<label for="twitter_username">
										<?php echo esc_html__('Username', JLTMA_TD); ?>
									</label>
									<input name="twitter_username" type="text" class="jltma-form-control twitter_username" value="<?php echo isset($jltma_api_options['twitter_username']) ? $jltma_api_options['twitter_username'] : ""; ?>">
								</div>

								<div class="jltma-form-group is-flex">
									<label for="twitter_consumer_key">
										<?php echo esc_html__('Consumer Key', JLTMA_TD); ?>
									</label>
									<input name="twitter_consumer_key" type="text" class="jltma-form-control twitter_consumer_key" value="<?php echo isset($jltma_api_options['twitter_consumer_key']) ? $jltma_api_options['twitter_consumer_key'] : ""; ?>">
								</div>

								<div class="jltma-form-group is-flex">
									<label for="twitter_consumer_secret">
										<?php echo esc_html__('Consumer Secret', JLTMA_TD); ?>
									</label>
									<input type="text" name="twitter_consumer_secret" class="jltma-form-control twitter_consumer_secret" value="<?php echo isset($jltma_api_options['twitter_consumer_secret']) ? $jltma_api_options['twitter_consumer_secret'] : ""; ?>">
								</div>

								<div class="jltma-form-group is-flex">
									<label for="twitter_access_token">
										<?php echo esc_html__('Access Token', JLTMA_TD); ?>
									</label>
									<input type="text" name="twitter_access_token" class="jltma-form-control twitter_access_token" value="<?php echo isset($jltma_api_options['twitter_access_token']) ? $jltma_api_options['twitter_access_token'] : ""; ?>">
								</div>

								<div class="jltma-form-group is-flex">
									<label for="twitter_access_token_secret">
										<?php echo esc_html__('Access Token Secret', JLTMA_TD); ?>
									</label>
									<input type="text" name="twitter_access_token_secret" class="jltma-form-control twitter_access_token_secret" value="<?php echo isset($jltma_api_options['twitter_access_token_secret']) ? $jltma_api_options['twitter_access_token_secret'] : ""; ?>">
								</div>

								<p>
									<?php echo sprintf(__('Go to <a href="%1$s" target="_blank"> https://developer.twitter.com/en/apps/create</a> for creating your Consumer key and Access Token.', JLTMA_TD), esc_url('https://developer.twitter.com/en/apps/create'));
									?>
								</p>
							</div>
						</div><!-- /.jltma-api-element-inner -->
					</div><!-- /.jltma-api-settings-element -->
					<!-- End of Twitter Settings -->
				</div>
			</form>
		</div>
	</div>
</div>
