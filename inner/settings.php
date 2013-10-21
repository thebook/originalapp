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

			if ( $this->get_option('set')['value'] !== 'yes' ) {
				$this->set_options(array(
					array(
						'name' => 'set',
						'value'=> 'yes'
					),					
					array( 
						'name'  => 'admin',
						'value' => 'recyclaboss'
					),
					array( 
						'name'  => 'password',
						'value' => 'thinkbigger12!'
					),
				));
			}
		}

		public function set_options ($options)
		{
			foreach ($options as $option) {
				$this->set_option($option);
			}
		}

		public function set_option ($option_array)
		{	
			$this->table->add_row_to_table($this->table_name, $option_array );
		}

		public function get_options ($option_names)
		{	
			$options = array();

			foreach ($option_names as $option_name) {
				$options[] = $this->get_option($option_name);
			}	

			return $options;
		}

		public function get_option ($option_name)
		{	
			return $this->table->get_row($this->table_name, 'name', $option_name);
		}

	}

?>