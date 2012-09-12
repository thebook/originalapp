<?php
/*
	@package WordPress
	@subpackage White_Whale
	@since White Whale 1.0
*/
?>
<div class="leftblock">
	
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			
			<input type="text" class="field lf-widget-field" name="s" id="s" placeholder="<?php esc_attr_e( 'Input Search Here', 'liquidflux' ); ?>" />
			
			<input type="submit" class="lf-button" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'liquidflux' ); ?>" />
	
	</form>
	
</div>