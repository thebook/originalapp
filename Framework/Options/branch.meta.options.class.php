<?php 

/**
* A class which inits all meta box classes and allows them to be generated
* adds actions for registering meta boxes and saving
*/
class branch_meta extends alpha_tree_options
{
	
	function __construct($options)
	{
		parent::__construct($options['id'], $options['class'], $options['default_type']);

		$this->params['manifestation'] = ( include $options['definition'] );	
		add_action( 'add_meta_boxes', array( $this, 'create_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	public function create_meta_boxes ()
	{
		multi( $this->params['manifestation'] );
	}

	public function save_post ($the_post_id)
	{										
		if ( defined( 'DOING_AUTOSAVE' ) and DOING_AUTOSAVE )
									
			return;
			
		if ( !isset( $_POST[$this->params['manifestation']['options']] ) or !isset( $_POST[$this->params['manifestation']['nonce']] ) or !wp_verify_nonce($_POST[$this->params['manifestation']['nonce']], $this->params['manifestation']['nonce_value'] ) ) 
		
			return;
						
		if ( !current_user_can( 'edit_post', $the_post_id ) )
										
			return;
		
		update_post_meta( $the_post_id, 'main_meta', $_POST[$this->params['manifestation']['options']] );
	}
}
?>