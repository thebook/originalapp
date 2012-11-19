<?php 

/**
* A helper class which gets the current date and figures out how many days hours, minutes and seconds ago it was posted
*/
class helper_time
{
	
	public function how_many_days_ago ($inputed_date) 
	{
		
		$inputed_date_in_days = $this->calculate_total_number_of_days($inputed_date);
		$current_date_in_days = $this->calculate_total_number_of_days(date('j/n/Y'));

		$inputed_date_time = explode( '/', $inputed_date );
		$inputed_date_time = array($inputed_date_time[3], $inputed_date_time[4], $inputed_date_time[5]);

		$how_long_ago = ( (int)$current_date_in_days - (int)$inputed_date_in_days );

		( $how_long_ago === 0 ? $how_long_ago = $this->_how_much_time_ago($inputed_date_time ) :  $how_long_ago .= ' days' );

		echo $how_long_ago .= ' ago';
	}

	protected function _how_much_time_ago ($inputed_date)
	{
		$current_date_time = explode( '/', date('G/i/s') );

		$how_much_time_has_passed = ( $current_date_time[0] - $inputed_date[0] );
		
		$format = ' hours';

		if ( $how_much_time_has_passed === 0 ) : 

			$how_much_time_has_passed = ( $current_date_time[1] - $inputed_date[1] );
			
			$format = ' minutes';

			if ( $how_much_time_has_passed === 0 ) : 

			 	$how_much_time_has_passed = ( $current_date_time[2] - $inputed_date[2] );
			 	
			 	$format = ' seconds';

			endif;
		endif;

		return $how_much_time_has_passed . $format; 
	}

	public function calculate_total_number_of_days ($inputed_date)
	{
		$inputed_date = explode( '/', $inputed_date );

		return ( 
			  	$inputed_date[2]*365    + 
			  	$inputed_date[2]/4      - 
			  	$inputed_date[2]/100    + 
			  	$inputed_date[2]/400    + 
			  	$inputed_date[0]        + 
			 	(153*$inputed_date[1]+8)/ 5 
			 );
	}

}

?>