<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class {controller}model extends SB_Model 
{

	public $table = '{table}';
	public $primaryKey = '{key}';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  {sql_select}  ";
	}
	public static function queryWhere(  ){
		
		return " {sql_where}   ";
	}
	
	public static function queryGroup(){
		return " {sql_group}  ";
	}
	
}

?>
