<?php 

/**
* Response class group
*/
class response
{
	var $return = array('header' => '', 'message' => ''); 
	var $transitions = array('price');

	function __construct($text)
	{
		$this->return['header'] = array_shift($text);
		$this->_split_into_paragraphs($text);

		return $this->return;
	}

	protected function _split_into_paragraphs ($array_of_text)
	{
		foreach ($array_of_text as $text) :
			
			$this->return['message'] .= ( is_array($text)?$this->_list($text) : $this->_paragraph($text) );

		endforeach;

		$this->return['message'] = trim($this->return['message']);
	}

	protected function _paragraph ($text)
	{
		$translated = $this->_translate($text);
		return "<p class=\"seperate_notifications\">$translated</p>";
	}

	protected function _list ($array_containing_array_to_be_extracted_and_what_to_extract)
	{
		$array_to_turn_into_list = extract_and_return_a_member_of_nested_array($array_containing_array_to_be_extracted_and_what_to_extract[0], $array_containing_array_to_be_extracted_and_what_to_extract[1] );

		$return_string = '<ul>';

		foreach ($array_to_turn_into_list as $text) :

			$translated = $this->_translate($text);
			$return_string .= "<li>$translated</li>";	

		endforeach;

		return $return_string .= '</ul>';
	}
	
	protected function _translate ($text)
	{
		$text = $this->_apply_all_transtions($text);

		return str_replace(
			array('_o', 'o_', '_@', '@_'),
			array('<strong>', '</strong>', '<span style="text-decoration: underline;">', '</span>'),
			$text);
	}

	protected function _apply_all_transtions ($text)
	{
		foreach ($this->transitions as $transition_name) :

			$transition = "_translate_$transition_name";
			$text = $this->$transition($text);

		endforeach;

		return $text;
	}

	protected function _translate_price ($text)
	{
		$remplacement_array = array();

		preg_match_all('/[^£]+!/', $text, $matched);
		
		foreach ($matched[0] as $number) {
			$remplacement_array[] = str_replace('!', '', $number ) / 100;
		}

		return str_replace($matched[0], $remplacement_array, $text );
	}
}

?>	