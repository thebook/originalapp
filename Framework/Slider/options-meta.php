<?php 

function lf_slide_meta() {

	$lf_meta = new meta_options( 'lf-post-meta', 'lf-admin-post-meta-td' );

	$m = 	array( 
				'id' => 'slide',
				'desc' => 'Configure your slide to show video or image',
				'title' => 'Slide',
				'post_type' => 'lf_slide',
				'context' => 'normal',
				'priority' => 'low',
				'arr' => 'main_meta',
				'options' => 
					array( 
						'opt' => 
							array(																				
								// Type 
								array(
									'f' => array( $lf_meta, 'put' ),
									'o' => 
										array(
											'select',
											'Type',
											'Chose the type of slide you want to have',
											'main_meta',
											'slide_type',
											'image',
											array('image', 'video', 'featured'),
											array('Image', 'Video', 'Featured Post') ) ),
								// Video embed 
								array(
									'f' => array( $lf_meta, 'put' ),
									'o' => 
										array(
											'textarea',
											'Embed',
											'Embed your youtube or vimeo video',
											'main_meta',
											'slide_embed',
											'',
											'',
											'',
											array( 'slide_type', '["video"]' )  ) ),
								// Captions 
								array(
									'f' => array( $lf_meta, 'put' ),
									'o' => 
										array(
											'text',
											'Caption',
											'The caption for your image, leave blank if no caption is desired',
											'main_meta',
											'slide_caption',
											'',
											'',
											'',
											array( 'slide_type', '["image"]' )  ) ),
								// Image upload 
								array(
									'f' => array( $lf_meta, 'put' ),
									'o' => 
										array(
											'upload',
											'Upload Image',
											'Upload your slide image',
											'main_meta',
											'slide_upload',
											'',
											'',
											'',
											array( 'slide_type', '["image"]' )  ) ),
								//  Featured post
								array(
									'f' => array( $lf_meta, 'put' ),
									'o' => 
										array(
											'post',
											'Posts',
											'Chose a post to feature on the slide',
											'main_meta',
											'slide_post',
											'',
									        '',
											'',
											array( 'slide_type', '["featured"]' ) ) )																									
									) )
								);

	return $m;
}

?>