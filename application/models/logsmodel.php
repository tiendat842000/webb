<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logsmodel extends SB_Model 
{

	public $table = 'tb_logs';
	public $primaryKey = 'auditID';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tb_logs.* FROM tb_logs   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE tb_logs.auditID IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
