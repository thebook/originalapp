<?php

/**
*  root book class 
*/
class book extends alpha
{
	var $book_table;
	var $reserved_table;
	var $section_definition;
	var $level_maximum;
	var $number_maximum;
	var $unwanted_table;
	var $unwanted_section_definition;
	var $unwanted_level_maximum;
	var $unwanted_number_maximum;

	function __construct()
	{	
		parent::__construct('book');
		$this->section_definition = array( 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's' );
		$this->level_maximum  = 5;
		$this->number_maximum = 40;

		$this->unwanted_section_definition = array('x');
		$this->unwanted_level_maximum  = 5;
		$this->unwanted_number_maximum = 40;

		$this->book_table = 'book';
		$this->reserved_table = 'reserved_section';
		$this->unwanted_table = 'unwanted';

		$table = new table_creator;
		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->book_table,
			'primary_key' => 'item_sku',
			'fields'      => array(
				array( 
					'column_name'    => 'item_sku',
					'auto_increment' => true,
					'data_type'      => 'INT'
				),
				array( 
					'column_name'    => 'section',
					'data_type'      => 'varchar(5)'
				),
				array( 
					'column_name'    => 'level',
					'data_type'      => 'varchar(5)'
				),
				array( 
					'column_name'    => 'number',
					'data_type'      => 'tinyint'
				),
				array( 
					'column_name'    => 'external_product_id',
					'data_type'      => 'varchar(13)'
				),
				array( 
					'column_name'    => 'external_product_id_type',
					'data_type'      => 'varchar(13)'
				),
				array( 
					'column_name'    => 'item_name',
					'data_type'      => 'varchar(100)'
				),
				array( 
					'column_name'    => 'author',
					'data_type'      => 'varchar(100)'
				),
				array( 
					'column_name'    => 'binding',
					'data_type'      => 'varchar(22)'
				),
				array( 
					'column_name'    => 'publication_date',
					'data_type'      => 'date'
				),
				array( 
					'column_name'    => 'standard_price',
					'data_type'      => 'varchar(11)'
				),
				array( 
					'column_name'    => 'quantaty',
					'data_type'      => 'varchar(4)'
				),
				array(
					'column_name'    => 'condition_type',
					'data_type'      => 'varchar(1)'
				),
				array(
					'column_name'    => 'product_description',
					'data_type'      => 'text'	
				),
				array(
					'column_name'    => 'main_image_url',
					'data_type'      => 'tinytext'
				)
			)
		));

		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->unwanted_table,
			'primary_key' => 'id',
			'fields'      => array(
				array( 
					'column_name'    => 'id',
					'auto_increment' => true,
					'data_type'      => 'INT'
				),
				array(
					'column_name' => 'section',
					'data_type'   => 'varchar(5)',
				),
				array(
					'column_name' => 'level',
					'data_type'   => 'varchar(5)',
				),
				array(
					'column_name' => 'number',
					'data_type'   => 'smallint',
				),
				array(
					'column_name' => 'item_name',
					'data_type'   => 'varchar(100)',
				),
				array(
					'column_name' => 'author',
					'data_type'   => 'varchar(100)',
				),
				array(
					'column_name' => 'user',
					'data_type'   => 'INT'
				),
				array(
					'column_name' => 'email',
					'data_type'   => 'varchar(30)'
				),
				array(
					'column_name' => 'first_name',
					'data_type'   => 'varchar(22)'
				),
				array(
					'column_name' => 'second_name',
					'data_type'   => 'varchar(22)'
				),
				array(
					'column_name' => 'address',
					'data_type'   => 'varchar(200)',
				),
				array(
					'column_name' => 'post_code',
					'data_type'   => 'varchar(7)',
				),
				array(
					'column_name' => 'town',
					'data_type'   => 'varchar(30)',
				),
				array(
					'column_name' => 'area',
					'data_type'   => 'varchar(50)',
				),
				array(
					'column_name' => 'reason_for_rejection',
					'data_type'   => 'text',
				)

			)
		));

		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->reserved_table,
			'fields'      => array(
				array( 
					'column_name'    => 'section',
					'data_type'      => 'varchar(5)'
				),
				array( 
					'column_name'    => 'level',
					'data_type'      => 'varchar(5)'
				)
			)
		));
	}

	public function get_table ()
	{
		$table = new table_creator;
		return $table->get_all_rows($this->book_table);
	}

	public function set_book ($array_of_books)
	{
		$table = new table_creator;

		foreach ($array_of_books as $book) :
			$book['section'] = 1;
			$book['level']   = 1;
			$book['number']  = 1;
			$table->add_row_to_table($this->book_table, $book);
		endforeach;
	}
}
	
?>