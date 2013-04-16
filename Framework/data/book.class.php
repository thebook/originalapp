<?php

/**
*  root book class 
*/
class book extends alpha
{
	$post_book_table;
	$recyclabus_one_table;

	function __construct()
	{	
		$this->post_book_table      = 'post_book';
		$this->recyclabus_one_table = 'recyclabus_one';

		$table->check_if_table_exists_if_not_create_one(array(
			'table_name'  => $this->post_book_table,
			'primary_key' => 'item_sku',
			'fields'      => array(
				array( 
					'column_name'    => 'item_sku',
					'auto_increment' => true
					'data_type'      => 'INT'
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
	}
}
	
?>