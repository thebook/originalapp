 <?php 

/**
* Alpha
*/
class user_registration
{
	// var $database_table_name;

	function __construct()
	{
		$this->_create_database_table_for_holding_user_info();
	}

	protected function _create_database_table_for_holding_user_info ()
	{
		global $wpdb;
		// var_export($wpdb->last_query);

		// var_export($wpdb->get_col_info('table'));	

		// $wpdb->query('name');
		$results = $wpdb->get_results("SELECT link_name, link_visible, link_url FROM wp_links");
		var_export($results[0]);
		// 'SELECT post_id, meta_key, meta_value FROM wp_postmeta WHERE post_id IN (1)'
	}
}

?>