<div class="hidden" id="apus_login_register_form_wrapper">
	<div class="apus_login_register_form" data-effect="fadeIn">
		<div class="form-login-register-inner">
			<!-- Social -->
			<ul class="nav nav-tabs">
			  	<li class="active"><a id="apus_login_forgot_tab" class="text-theme" data-toggle="tab" href="#apus_login_forgot_form"><?php esc_html_e( 'Login', 'edumy' ); ?></a></li>
			  	<li><a id="apus_register_tab" class="text-theme" data-toggle="tab" href="#apus_register_form"><?php esc_html_e( 'Register', 'edumy' ); ?></a></li>
			</ul>
			
			<?php if ( defined('EDUMY_DEMO_MODE') && EDUMY_DEMO_MODE ) { ?>
				<div class="sign-in-demo-notice">
					Username: <strong>learner</strong> or <strong>instructor</strong><br>
					Password: <strong>demo</strong>
				</div>
			<?php } ?>
			
			<div class="tab-content">
				<div id="apus_login_forgot_form" class="tab-pane fade active in">
					<?php get_template_part( 'template-parts/login-form' ); ?>
			  	</div>
			  	<div id="apus_register_form" class="tab-pane fade in">
					<?php get_template_part( 'template-parts/register-form' ); ?>
			  	</div>
			</div>
			
		</div>
	</div>
</div>