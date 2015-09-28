<?php
/**
 * 
 * @package Hamza Lite 
 */

class Hamza_Lite_Reveal_IDs{	
	
	function __construct(){
		add_action('admin_init', array(&$this, 'init'));		
		add_action('admin_head', array(&$this, 'add_css'));
	}
	
	function Hamza_Lite_Reveal_IDs() {
		$this->__construct();
	}
    
    function init() {		
		if ( !function_exists("add_action") ) return;
		
		add_filter('manage_media_columns', array(&$this, 'column_add'));
		add_action('manage_media_custom_column', array(&$this, 'column_value'), 10, 2);

		add_filter('manage_link-manager_columns', array(&$this, 'column_add'));
		add_action('manage_link_custom_column', array(&$this, 'column_value'), 10, 2);

		add_action('manage_edit-link-categories_columns', array(&$this, 'column_add'));
		add_filter('manage_link_categories_custom_column', array(&$this, 'column_return_value'), 10, 3);
		
		foreach( get_taxonomies() as $taxonomy ) {
			add_action("manage_edit-${taxonomy}_columns", array(&$this, 'column_add'));
			add_filter("manage_${taxonomy}_custom_column", array(&$this, 'column_return_value'), 10, 3);
			if( version_compare($GLOBALS['wp_version'], '3.0.999', '>') )
				add_filter("manage_edit-${taxonomy}_sortable_columns", array(&$this, 'column_add_clean') );
		}

		foreach( get_post_types() as $ptype ) {
			add_action("manage_edit-${ptype}_columns", array(&$this, 'column_add'));
			add_filter("manage_${ptype}_posts_custom_column", array(&$this, 'column_value'), 10, 3);
			if( version_compare($GLOBALS['wp_version'], '3.0.999', '>') )
				add_filter("manage_edit-${ptype}_sortable_columns", array(&$this, 'column_add_clean') );
		}
	
		add_action('manage_users_columns', array(&$this, 'column_add'));
		add_filter('manage_users_custom_column', array(&$this, 'column_return_value'), 10, 3);
		if( version_compare($GLOBALS['wp_version'], '3.0.999', '>') )
			add_filter("manage_users_sortable_columns", array(&$this, 'column_add_clean') );
		
		add_action('manage_edit-comments_columns', array(&$this, 'column_add'));
		add_action('manage_comments_custom_column', array(&$this, 'column_value'), 10, 2);
		if( version_compare($GLOBALS['wp_version'], '3.0.999', '>') )
			add_filter("manage_edit-comments_sortable_columns", array(&$this, 'column_add_clean') );
	}

	function add_css() {
		echo "\n" . '<style type="text/css">
	table.widefat th.column-hamza_lite_rid {
		width: 70px;
	}
	
	table.widefat td.column-hamza_lite_rid {
		word-wrap: normal;
	}
	</style>' . "\n";
	}
	

	function column_add($cols) {
		$cols['hamza_lite_rid'] = '<abbr title="' . __('IDs', 'hamza_lite') . '">' . __('ID', 'hamza_lite') . '</abbr>';
		return $cols;
	}
	
		
	function column_add_clean($cols) {
		$cols['hamza_lite_rid'] = __('ID', 'hamza_lite');
		return $cols;
	}
	
	
	function column_value($column_name, $id) {
		if ($column_name == 'hamza_lite_rid') echo $id;
	}
	
	
	function column_return_value($value, $column_name, $id) {
		if ($column_name == 'hamza_lite_rid') $value = $id;
		return $value;
	}
}

if ( class_exists('Hamza_Lite_Reveal_IDs') && is_admin() ) {
	$reveal_ids = new Hamza_Lite_Reveal_IDs();
}