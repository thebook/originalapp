<?php
/*
	@package WordPress
	@subpackage White_Whale
	@since White Whale 1.0 
*/ 

$main_opts = get_option("main_options");

$layout = layout_finder( 'main_options', 'main_meta', $post->ID, 'chosen_layout', 'header_state' );

?>

<?php if ( $main_opts["header_title_state"] == "none" ||  $layout == "noheader" ) : ?>
	
		<hgroup class="lf-sitetitle-none">			
			<h1 >
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo('name', 'display')); ?>">
						<?php bloginfo('name'); ?>
				</a>
			</h1>		
		</hgroup>
		
<?php endif; ?>

<?php if ( $main_opts['header_show_topbar'] == 'yes' ) : ?>

<div class="lf-header-bar boxshadowone ">

	<small class="lf-top-bot-bar-text">&nbsp;	
		
		<?php echo $main_opts["header_topbar_text"]; ?>	
	
	</small>
	
</div>

<?php endif; ?>



<?php 

if ( $layout != "noheader" ) : ?>

<div class="lf-header-main-wrap">

	<?php if ( $main_opts["header_background_state"] == "custom" ) : ?>

	<img class="lf-header-background-image" src="<?php echo $main_opts["header_background_image"]; ?>" />
	
	<?php endif; ?>

<div class="lf-header">
	
	<div class="lf-sitetitle-whole-wrap">
	
<?php 

	if ( isset( $layout ) ) {
		
		if ( $layout == 'topad'	) {
			
			lf_create_header_ad();
		
		}
	
	}

?>
	
	<div class="lf-sitetitle-wrap">	
	
	<div class="lf-sitetitle-align-wrap">
	
<?php 	
		
			
			if ( $main_opts["header_title_state"] == "titlelogo" || $main_opts["header_title_state"] == "logo"  ) { 
				
				if ( $main_opts["logo_orentation"] == "before" ) {
			
					echo '<div class="lf-header-logo">';
				
					echo '<a href="'. home_url('/') .'" title="'. get_bloginfo('name', 'display') .'">';
				
					echo '<img src="' . $main_opts["logo_upload"] . '"  />';
					
					echo '</a>';
				
					echo '</div>';
					
				}
				
			}

?>	
	
	<?php if ( $main_opts["header_title_state"] == "title" ||  $main_opts["header_title_state"] == "titlelogo" ) : ?>
	
		<hgroup class="lf-sitetitle">			
			<h1 >
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo('name', 'display')); ?>">
						<?php bloginfo('name'); ?>
				</a>
			</h1>		
		</hgroup>
		
	<?php endif; ?>
			
<?php 	

			
		
			if ( $main_opts["header_title_state"] == "titlelogo" || $main_opts["header_title_state"] == "logo"  ) {
			
				if ( $main_opts["logo_orentation"] == "after" ) {
			
					echo '<div class="lf-header-logo">';
					
				if (  $main_opts["header_title_state"] == "logo" ) {
					
					echo '<hgroup>';
					
					echo '<h1 class="lf-logo-h1">';
						
					echo '<a href="'. home_url('/') .'" title="'. get_bloginfo('name', 'display') .'">';
					
				}
				
					echo '<img src="' . $main_opts["logo_upload"] . '"  />';
				
				if (  $main_opts["header_title_state"] == "logo" ) {				
					
					echo '</a>';
					
					echo '</h1>';
					
					echo '</hgroup>';
					
				}
				
					echo '</div>';
					
				}
			
			}
			
?>
		
	</div>
		
	</div>
	
<?php 

	if ( isset( $layout ) ) {
		
		if ( $layout == 'leftad'
			|| $layout == 'rightad'
			|| $layout == 'bottomad'	) {
			
			lf_create_header_ad();
		
		}
	
	}

?>
	</div>
		
</div> 

</div>

<?php 

endif;

if ( $main_opts['header_show_bottombar'] == 'yes' ) : ?>

<div class="lf-header-bar boxshadowone ">

	<small class="lf-top-bot-bar-text" >&nbsp;
		
		<?php echo $main_opts["header_bottombar_text"]; ?>		
	
	</small>
	
</div>

<?php endif; ?>