<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Opmmodel extends SB_Model 
{

	public $table = 'tb_bigbluebutton';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tb_bigbluebutton.* FROM tb_bigbluebutton   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE tb_bigbluebutton.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
