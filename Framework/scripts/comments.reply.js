addComment = {

	get_an_element_by_id : function(element_id_name) {
		
		return document.getElementById(element_id_name);
	},
	
	moveForm : function(comment_id, comment_parent_id, form_id, current_post_id) {

		var dhis, temporary_placeholder, current_comment, form, cancel_button, comment_parent, current_post;
			
			dhis      		= this;
			current_comment = dhis.get_an_element_by_id(comment_id);
			form        	= dhis.get_an_element_by_id(form_id);
			cancel_button  	= dhis.get_an_element_by_id('cancel-comment-reply-link');
			comment_parent  = dhis.get_an_element_by_id('comment_parent');
			current_post    = dhis.get_an_element_by_id('comment_post_ID');

		if ( ! current_comment || ! form || ! cancel_button || ! comment_parent )
			return;

			dhis.form       = form;
			current_post_id = current_post_id || false;


		//
		//	Check if there is a wp-temp-form-div if not we create one to insert inside the form
		//	
		if ( ! dhis.get_an_element_by_id('wp-temp-form-div') ) {

			temporary_placeholder               = document.createElement('div');
			temporary_placeholder.id            = 'wp-temp-form-div';
			temporary_placeholder.style.display = 'none';
			form.parentNode.insertBefore(temporary_placeholder, form);
		}

		//
		//	Insert the comments form inside the current comment
		//	
		current_comment.parentNode.insertBefore(form, current_comment.nextSibling);
		console.log( current_comment );
		if ( current_post && current_post_id )	
			current_post.value          = current_post_id;
			comment_parent.value        = comment_parent_id;
			cancel_button.style.display = '';

		//
		//	To move back we find the temporary place hodler, and find the form again, and move it back to where the placeholder is
		//
		cancel_button.onclick = function () {
			
			var new_instance		    	= addComment, 
				find_temporary_place_holder = dhis.get_an_element_by_id('wp-temp-form-div'), 
				form    					= dhis.get_an_element_by_id(form_id);
			
			if ( ! find_temporary_place_holder || ! form )
				return;

				dhis.get_an_element_by_id('comment_parent').value = '0';
				find_temporary_place_holder.parentNode.insertBefore(form, find_temporary_place_holder);
				find_temporary_place_holder.parentNode.removeChild(find_temporary_place_holder);
				this.style.display = 'none';
				this.onclick = null;
				return false;
		}

		try { 

			dhis.get_an_element_by_id('comment').focus(); 
		}
		catch(e) {}

		return false;
	}
}