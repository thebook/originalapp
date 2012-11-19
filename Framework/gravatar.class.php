<?php 

/**
* A class designated to getting a email and converting it onto a gravatar hash to then get the profile
*/
class gravatar
{
	var $current_persons_gravatar_profile;

	function __construct($passed_info)
	{
		$this->current_persons_gravatar_profile = md5( strtolower( trim($passed_info) ) );
	}

	/**
	 * Gets an entire profile array for a users gravatar, this will confain everything within it, as such various things 
	 * within it can be used to display any way you like. I dont recomend using this to load in just a avatar or something,
	 * getting arrays from the gravatar servers will slow down how long it takes for a page to respond by a lot ( 10 comments 7 seconds on avrage )
	 * as such use this for hover card loads or something with ajax loading, that way it dosent matter how long a single card takes, it wont be that noticable
	 * @param  string $persons_email 
	 * @return array                An array of the persons profile
	 */
	public function _get_all_gravatar_information_for_user_in_an_array ()
	{
		$get_user_profile_array = "http://www.gravatar.com/{$this->current_persons_gravatar_profile}.php";
		$get_user_profile_array = file_get_contents( $get_user_profile_array );
		// $get_user_profile_array = unserialize( $get_user_profile_array );

		// return $get_user_profile_array['entry'][0];
	}

	public function _get_user_avatar ()
	{
		return "http://www.gravatar.com/avatar/{$this->current_persons_gravatar_profile}";
	}
}

?>