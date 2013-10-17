<?php

	class settings extends alpha
	{
		
		function __construct()
		{
			parent::__construct('setting');
			
			$this->table_name = 'book_settings';
			$this->table      = new table_creator;
			$this->table->check_if_table_exists_if_not_create_one(array(
				'table_name'  => $this->table_name,
				'fields'      => array(
					array(
						'column_name' => 'name',
						'data_type'   => 'longtext',
					),
					array(
						'column_name'=> 'value',
						'data_type'  => 'longtext' 
					),
				)
			));
		}

		public function get_option ($option_name)
		{	
			return $this->table->get_row($this->table_name, 'name', $option_name);
		}
	}

?>