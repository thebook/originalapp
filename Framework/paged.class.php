<?php 

/**
* A pagnation class, allows pagnation though single static pages, by use of $_GET['paged'] global variable passed though 
* the url. This works with a custom query, the maximum number of pages the query is split into is know by $q->max_num_pages,
* using this we know how many page links to create inside a static page
*/
class pagnation
{	
	
	/**
	 * "Maximum" page number ( the number of pages there are )
	 * @var int
	 */
	var $m;
	/**
	 * Page "number", the current page we are on
	 * @var [type]
	 */
	var $n;
	
	/**
	 * Sets the $this-m and n variables, Sets the n variable though the page() function
	 * @param int $m The maximum number of pages the posts are split into
	 */
	function __construct($m)
	{
		$this->m = $m;
		$this->n = $this->page();
	}

	/**
	 * Used to set the $this->n variable, it gets the current page number in the "paged" value
	 * @return int Returns the current page number or 0 if "paged" is not set
	 */
	public function page()
	{
		return $num = ( isset($_GET['paged']) ? $_GET['paged'] : 0 );
	}

	/**
	 * Checks if the current "index"($i) is the same value as the page "number" ( $this->n ) if so it leaves out the link
	 * @param  int $i The index
	 * @return html    Returns a 'li' element with a page link, or without if it is the current page
	 */
	public function pagnation($i)
	{
		
		if ( $this->n == $i ) :

			echo "<li>$i</li>";

		else : 

			echo "<li><a href=\"". get_permalink() ."&paged=$i\">$i</a></li>";

		endif;
	}

	/**
	 * Pulls the whole class together, for each of the maximum pages it generates a page link and wraps them 
	 * @return html Pagnation bar
	 */
	public function pag()
	{ ?>
	
		<div>

			<ul>

				<?php for($i=1; $i < $this->m + 1; $i++) : ?>
				
					<?php $this->pagnation($i); ?>

				<?php endfor; ?>

			</ul>

		</div>

<?php }

} 

?>