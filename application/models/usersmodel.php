<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usersmodel extends SB_Model 
{

	public $table = 'tb_users';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT  tb_users.*,  tb_groups.name 
FROM tb_users LEFT JOIN tb_groups ON tb_groups.group_id = tb_users.group_id  ";
	}
	public static function queryWhere(  ){
		
		return "    WHERE tb_users.id !=''     ";
	}
	
	public static function queryGroup(){
		return "       ";
	}
	
}

?>
