<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Registeronlinemodel extends SB_Model 
{

	public $table = 'tb_register';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tb_register.* FROM tb_register   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE tb_register.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
