<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modulemodel extends SB_Model 
{

	public $table = 'tb_module';
	public $primaryKey = 'module_id';

	public function __construct() {
		parent::__construct();
		
	}

	
}

?>
