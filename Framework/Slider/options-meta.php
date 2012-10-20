<?php 

function lf_slide_meta() {

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
									'f' => 'lf_meta_opt',
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
									'f' => 'lf_meta_opt',
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
											array( '#lf-post-meta-slide_type', 
												   '#slide_embed-hook', 
												   '["video"]' )  ) ),
								// Captions 
								array(
									'f' => 'lf_meta_opt',
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
											array( '#lf-post-meta-slide_type', 
												   '#slide_caption-hook', 
												   '["image"]' )  ) ),
								// Image upload 
								array(
									'f' => 'lf_meta_opt',
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
											array( '#lf-post-meta-slide_type', 
												   '#slide_upload-hook', 
												   '["image"]' )  ) ),
								//  Featured post
								array(
									'f' => 'lf_meta_opt',
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
											array( '#lf-post-meta-slide_type', 
												   '#slide_post-hook', 
												   '["featured"]' ) ) )																									
									) )
								);

	return $m;
}

?>