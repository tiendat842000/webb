<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Groupsmodel extends SB_Model 
{

	public $table = 'tb_groups';
	public $primaryKey = 'group_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT  
	tb_groups.group_id,
	tb_groups.name,
	tb_groups.description,
	tb_groups.level


FROM tb_groups   ";
	}
	public static function queryWhere(  ){
		
		return "   WHERE tb_groups.group_id IS NOT NULL    ";
	}
	
	public static function queryGroup(){
		return "     ";
	}
	
}

?>
