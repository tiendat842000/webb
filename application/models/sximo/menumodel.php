<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menumodel extends SB_Model 
{

	public $table = 'tb_menu';
	public $primaryKey = 'menu_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT tb_menu.* FROM tb_menu  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE tb_menu.menu_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	
}

?>
