<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SB_Model extends CI_Model
{
	public $table;
	public $primaryKey;
	public $_limit         = '0';
	public $_max         = '10';
	public $_offset        ='';
	public $_setting     = array();
	public $_config        = array();
	public $_grid         = array(); 
	public $_forms         = array(); 

	public function __construct() {
		parent::__construct();

	}

	public function getRows( $args )
	{
		$table = $this->table;
		$key = $this->primaryKey;

		extract( array_merge( array(
			'page' 		=> '0' ,
			'limit'  	=> '0' ,
			'sort' 		=> '' ,
			'order' 	=> '' ,
			'params' 	=> '' ,
			'global'	=> '1'
		), $args ));
		
		//$offset = ($page-1) * $limit ;
		$offset = $page-1 ;
		$limitConditional = ($page !=0 && $limit !=0) ? "LIMIT  $offset , $limit" : '';
		$orderConditional = ($sort !='' && $order !='') ?  " ORDER BY {$sort} {$order} " : '';
		
		// Update permission global / own access new ver 1.1
		$table = $this->table;
		if($global == 0 )
				$params .= " AND {$table}.entry_by ='".$this->session->userdata('uid')."'";
		// End Update permission global / own access new ver 1.1

		$rows = array();
		$query = $this->db->query( $this->querySelect() . $this->queryWhere(). "
			{$params} ". $this->queryGroup() ." {$orderConditional}  {$limitConditional} ");
		$result = $query->result();
		$query->free_result();

		if($key =='' ) { $key ='*'; } else { $key = $table.".".$key ; }
		$counter_select = preg_replace( '/[\s]*SELECT(.*)FROM/Usi', 'SELECT count('.$key.') as total FROM', $this->querySelect() );
		//echo 	$counter_select; exit;
		$query = $this->db->query( $counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());
		$res = $query->result();
		$total = $res[0]->total;
		$query->free_result();

		return $results = array('rows'=> $result , 'total' => $total);


	}

	public function getRow( $id )
	{
		 
		$table = $this->table;
		$key = $this->primaryKey;

		$query = $this->db->query(
			$this->querySelect() .
			$this->queryWhere().
			" AND ".$table.".".$key." = '{$id}' ".
			$this->queryGroup()
		);
		$result = $query->row_array();
		return $result;
	}

	public function insertRow( $data , $id)
	{
		$table = $this->table;
		$key = $this->primaryKey;
		
		if($id == NULL )
		{

			// Insert Here
			if(isset($data['createdOn'])) $data['createdOn'] = date("Y-m-d H:i:s");
			if(isset($data['updatedOn'])) $data['updatedOn'] = date("Y-m-d H:i:s");
			$this->db->insert( $table,$data);
			$id = $this->db->insert_id();

		} else {
			// Update here
			// update created field if any
			if(isset($data['createdOn'])) unset($data['createdOn']);
			if(isset($data['updatedOn'])) $data['updatedOn'] = date("Y-m-d H:i:s");
			 $this->db->where( array( $key => $id ));
			 $this->db->update( $table , $data );
		}
		return $id;
	}

	function getComboselect( $params , $nested = array())
	{
		if(isset($params[3]) AND !empty($params[4]) ){
			$table = $params[0];
			$query = $this->db->get_where( $table , array( $param[3] => $param[4] ));
			$rows = $query->result();
		}else{
			$table = $params[0];
			$query = $this->db->get( $table );
			$rows = $query->result();
		}
		$query->free_result();
		return $rows;
		
	}


	function getColumnTable( $table )
	{
		$query = $this->db->query("SHOW COLUMNS FROM $table");
		$columns = array();
		foreach( $query->result() as $row)
			{
			$columns[$row->Field] = '';
			}
		return $columns;
	}

	function makeInfo( $id )
	{
		
		$query =  $this->db->get_where('tb_module', array('module_name'=> $id));
		$data = array();
		foreach($query->result() as $r)
		{
			$data['id']		= $r->module_id;
			$data['title'] 	= $r->module_title;
			$data['note'] 	= $r->module_note;
			$data['table'] 	= $r->module_db;
			$data['key'] 	= $r->module_db_key;
			$data['config'] = SiteHelpers::CF_decode_json($r->module_config);
			$field = array();
			foreach($data['config']['grid'] as $fs)
			{
				foreach($fs as $f)
					$field[] = $fs['field'];

			}
			$data['field'] = $field;

		}
		$query->free_result();
		return $data;


	}

	function getTableList( $db )
	{
	 	$t = array();
		$dbname = 'Tables_in_'.$db ;
		$query = $this->db->query("SHOW TABLES FROM {$db}"); 
		foreach( $query->result() as $table)
		{
			$t[$table->$dbname] = $table->$dbname;
		}
		return $t;
	}

	function getTableField( $table )
	{
		$columns = array();
		$query = $this->db->query("SHOW COLUMNS FROM $table"); 
		foreach( $query->result() as $column){
			$columns[$column->Field] = $column->Field;
		}
		return $columns;
	}

	function getColoumnInfo( )
	{
		$coll = array();

		if( $this->db->dbdriver=='mysqli'){
			while ($field = mysqli_fetch_field($this->db->result_id ))
			{
				$coll[] = $field;
			}
		} else if( $this->db->dbdriver=='mysql'){
			while ($field = mysql_fetch_field($this->db->result_id))
			{
			$coll[] = $field;
			}
		}else{
			$coll = $this->db->list_fields();
		}
		return $coll;
	}


	function builColumnInfo( $statement )
	{
		$driver 		= $this->db->dbdriver;
		$db 		= $this->db->database;
		$dbuser 	= $this->db->username;
		$dbpass 	= $this->db->password;
		$dbhost 	= $this->db->hostname;

		$data = array();
		$mysqli = new mysqli($dbhost,$dbuser,$dbpass,$db);
		if ($result = $mysqli->query($statement)) {

			/* Get field information for all columns */
			while ($finfo = $result->fetch_field()) {
				$data[] = (object) array(
							'Field'	=> $finfo->name,
							'Table'	=> $finfo->table,
							'Type'	=> $finfo->type
							);
			}
			$result->close();
		}

		$mysqli->close();
		return $data;

	}

	function validAccess( $id)
	{

		$query = $this->db->get_where( 'tb_groups_access', array(
		  'module_id' => $id ,
			'group_id' => $this->session->userdata("gid"),
		));
		
		$row = $query->result();
		$query->free_result();

		if(count($row) >= 1)
		{
			$row = $row[0];
			if($row->access_data !='')
			{
				$data = json_decode($row->access_data,true);
			} else {
				$data = array();
			}
			return $data;

		} else {
			return false;
		}

	}
	
	function delete( $where = array() ) {
		
		// if empty, nothing to do
		if( empty( $where )){
			return ;
		}
		
		$_where = array();
		foreach( $where as $fld => $val ){
			if( is_array( $val )){
				if( is_numeric( $val )){
					$_where[] = " `{$fld}` in ( ". implode(",", $val )." ) ";
				}else{
					$_where[] = " `{$fld}` in ( '". implode("','", $val )."' ) ";
				}
			} else {
				if( is_numeric( $val )){
					$_where[] = " `{$fld}` = {$val} ";
				}else{
					$_where[] = " `{$fld}` = '{$val}' ";
				}
			}
		}
		
		$sql = " DELETE FROM $this->table WHERE ( ". implode(' ) AND ( ', $_where )." ) ";
		
		if(!( $query = $this->db->query($sql))){
			return false;
		}
		
	}

	function destroy( $id ) {
		$where = array( $this->primaryKey => $id );
		$this->delete( $where );
	  
	}


}

?>