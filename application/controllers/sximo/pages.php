<?php

class Pages extends SB_Controller  {

	protected $layout = "layouts.main";
	public $module = 'pages';
	public $per_page	= '100';
	
	public function __construct() {		
		parent::__construct();	
		$this->load->model('sximo/pagesmodel');
		$this->model = $this->pagesmodel;		
		
		$this->info = $this->model->makeInfo( $this->module);	
		$this->access = $this->model->validAccess($this->info['id']);
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'pages',
		));	
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
		if($this->session->userdata('gid') !=1) redirect('dashboard',301);			
	} 
	
	function index() {
	  
		// Filter sort and order for query 
		$sort = (!is_null($this->input->get('sort', true)) ? $this->input->get('sort', true) : 'CustomerId'); 
		$order = (!is_null($this->input->get('order', true)) ? $this->input->get('order', true) : 'asc');
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null($this->input->get('search', true)) ? $this->buildSearch() : '');
		// End Filter Search for query 

		
		$page = max(1, (int) $this->input->get('page', 1));
		$params = array(
			'page'		=> $page ,
			'limit'		=> (($this->input->get('rows', true)) ? filter_var($this->input->get('rows', true),FILTER_VALIDATE_INT) : $this->per_page ) ,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			//'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRows( $params );		
		
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		#$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);		
		$this->data['rowData']		= $results['rows'];
		// Build Pagination
		
		$pagination = $this->paginator( array(
			'total_rows' => $results['total'] ,
		));

		// Row grid Number 
		$this->data['i']			= ($page * $params['limit'])- $params['limit']; 
		// Grid Configuration 
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['tableForm'] 	= $this->info['config']['forms'];
		$this->data['access']		= $this->access;

		
		$this->data['content'] = $this->load->view('sximo/pages/index',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}	
	
	function add( $id = null)
	{
	
		if($this->access['is_view'] ==0) redirect('',301);		
		
		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  (array) $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_pages'); 
		}
		
		if($id =='') 
		{ 
			$this->data['content'] = '';
		} else {
			
			if($row['pageID'] ==1) {
				$filename = "application/views/pages/home.php";
				$this->data['content'] = file_get_contents($filename);
			
			} else {
			
				$filename = "application/views/pages/".$row['filename'].".php";
				if(file_exists($filename))
				{
					$this->data['content'] = file_get_contents($filename);
				} else {
					$this->data['content'] = '';
				} 	
			}	
		}
		if($this->data['row']['access'] !='')
		{
			$access = json_decode($this->data['row']['access'],true)	;	
		} else {
			$access = array();
		}
		$groups = $this->db->get('tb_groups');
		$group = array();
		foreach($groups->result_array() as $g) {
			$group_id = $g['group_id'];			
			$a = (isset($access[$group_id]) && $access[$group_id] ==1 ? 1 : 0);		
			$group[] = array('id'=>$g['group_id'] ,'name'=>$g['name'],'access'=> $a); 			
		}		

		$this->data['groups'] = $group;	
		
		
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('sximo/pages/form',$this->data, true );		
    	$this->load->view('layouts/main', $this->data );
	}	
	
	function save( $id =0)
	{

		$rules = array(
			array('field'   => 'title','label'   => 'Title','rules'   => 'required'),
			array('field'   => 'alias','label'   	 => 'Label ','rules'   => 'required'),			
		);
		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() ){
			$content = 	$this->input->post('content');
			$data = $this->validatePost('tb_pages');
			$filename = strtolower($this->input->post('filename'));
				if($this->input->post('pageID') ==1)
				{	
					$filename = "application/views/pages/home.php";
				} else {
					$filename = "application/views/pages/".$filename.".php";
				}	
				$fp=fopen($filename,"w+"); 				
				fwrite($fp,$content); 
				fclose($fp);	
				
			 $groups = $this->db->get('tb_groups');
			 $access = array();				
			 foreach($groups->result() as $group) {		 	
				$access[$group->group_id]	= (isset($_POST['group_id'][$group->group_id]) ? '1' : '0');
			 }
		 						
			$data['access'] = json_encode($access);
			
			$data['allow_guest'] 	= (isset($_POST['allow_guest']) ? '1' : '0');
			$data['template'] 		= $this->input->post('template',true);	
			$ID = $this->model->insertRow($data , $this->input->post('pageID'));
			self::createRouters();
			$this->session->set_flashdata('message',SiteHelpers::alert('success','Your password has been changed succesfuly')); 
			if($this->input->post('apply'))
			{
				redirect( 'sximo/pages/add/'.$ID,301);
			} else {
				redirect( 'sximo/pages',301);
			}			

		} else {
			$this->session->set_flashdata('message',SiteHelpers::alert('error','Ops Something went wrong !'));
			redirect('sximo/pages');
		}	
	
	}	

	public function destroy()
	{
		
		if($this->access['is_remove'] ==0) 
			redirect('',301);
		
		$ids = $_POST['id']	;	
		for($i=0; $i<count($ids);$i++)
		{
			$row = $this->db->get_where('tb_pages',array('pageID'=> $ids[$i]));	
			$filename = "./application/views/pages/".$row->filename.".php";
			if(file_exists($filename) && $row->filename !='')
			{
				unlink($filename);
			}				
		} 
				
					
		// delete multipe rows 
		$data = $this->model->destroy($this->input->post('id'));
		self::createRouters();
		$this->session->set_flashdata('message',SiteHelpers::alert('success','Successfully deleted row!'));
		redirect('sximo/pages',301);
	}	
	
	function createRouters()
	{
		$rows =$this->db->get('tb_pages')->result();
		$val  =	"<?php \n"; 
		foreach($rows as $row)
		{
			$val .= '$route["' . $row->alias . '"] = "page/index/' . $row->alias . '";' ."\n";	
			$val .= '$route["' . $row->alias . '/(:any)"] = "page/index/' . $row->alias . '/%1";' ."\n";	
		}
		$val .= 	"?>";
		$filename = 'application/config/pageroutes.php';
		$fp=fopen($filename,"w+"); 
		fwrite($fp,$val); 
		fclose($fp);	
		return true;	
		
	}		
	
}	