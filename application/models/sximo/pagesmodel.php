<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pagesmodel extends SB_Model 
{

	public $table = 'tb_pages';
	public $primaryKey = 'pageID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT tb_pages.* FROM tb_pages  ";
	}
	public static function queryWhere(  ){
		
		return " WHERE tb_pages.pageID IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	
}

?>
