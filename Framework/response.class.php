<?php 

/**
* Response class group
*/
class response
{
	private $return = ''; 
	private $language = array(
		'written' => 
			array(
				'~o', 
				'o~', 
				'_!', 
				'!_',
				'((',
				'))',
				'~+',
				'+~',
				'~*',
				'*~'
			),
		'translates' => 
			array(
				'<p class="seperate_notications">', 
				'</p>', 
				'<strong>', 
				'</strong>',
				'<span style="text-decoration: underline;">',
				'</span>',
				'<ul>',
				'</ul>',
				'<li>',
				'</li>'
			)
	);

	function __construct($text)
	{
		return trim($this->_split_into_paragraphs($text));
	}

	protected function _split_into_paragraphs ($text)
	{
		return str_replace(
			$this->language['written'],
			$this->language['translates'],
			$text);
	}
}

?>	