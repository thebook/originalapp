
<?php extract($passed_params); ?>

<?php if ( $main_opts["header_title_state"] == "none" or $layout == "noheader" ) : ?>
	
	<hgroup class="lf-sitetitle-none">			
		<h1 >
			
			<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo('name', 'display')); ?>">
					<?php bloginfo('name'); ?>
			</a>
		
		</h1>		
	
	</hgroup>
		
<?php endif; ?>

<?php if ( $layout != "noheader" ) : ?>

	<div class="lf-header-main-wrap">

		<div class="lf-header">
			
			<div class="lf-sitetitle-whole-wrap">
				
				<?php if ( isset( $layout ) && $layout == 'topad' ) : ?>
							
					<?php lf_create_header_ad(); ?>
					
				<?php endif; ?>
			
				<div class="lf-sitetitle-wrap">	
					
					<div class="lf-sitetitle-align-wrap">
						
						<!-- Logo creation before the title -->
						<?php if ( $main_opts["header_title_state"] == "titlelogo" || $main_opts["header_title_state"] == "logo" and $main_opts["logo_orentation"] == "before" ) : ?>
									
							<div class="lf-header-logo">
										
								<a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo('name', 'display'); ?>">
											
									<img src="<?php echo $main_opts["logo_upload"]; ?>">
												
								</a>
										
							</div>

						<?php endif; ?>
							
						<!-- Title creation -->
						<?php if ( $main_opts["header_title_state"] == "titlelogo" or $main_opts["header_title_state"] == "title" ) : ?>
				
							<hgroup class="lf-sitetitle">			
								
								<h1>
									
									<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo('name', 'display')); ?>">
										
										<?php bloginfo('name'); ?>
									
									</a>
								</h1>		

							</hgroup>
					
						<?php endif; ?>

						<!-- Logo creation after title -->
						<?php if ( $main_opts["header_title_state"] == "titlelogo" || $main_opts["header_title_state"] == "logo" and $main_opts["logo_orentation"] == "after" ) : ?>
									
							<div class="lf-header-logo">
											
								<a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo('name', 'display'); ?>">
							
									<img src="<?php echo $main_opts["logo_upload"]; ?>"/>
							
								</a>
										
							</div>
											
						<?php endif; ?>
				
					</div>
				
				</div>
				
				<!-- Bottom Ad Creation -->
				<?php if ( isset( $layout ) && $layout == 'leftad' or $layout == 'rightad' or $layout == 'bottomad' ) : ?>
						
					<?php lf_create_header_ad(); ?>
					
				<?php endif; ?>
			
			</div>
				
		</div> 

	</div>

<?php endif; ?>