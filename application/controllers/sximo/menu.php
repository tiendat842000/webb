<?php

class Menu extends SB_Controller  {

	protected $layout = "layouts.main";
	public $module 	= 'menu';
	public $per_page	= '100';
		
	public function __construct() {		
		parent::__construct();	
		$this->load->model('sximo/menumodel');
		$this->model = $this->menumodel;	
		$this->info = $this->model->makeInfo( $this->module);	
		$this->access = $this->model->validAccess($this->info['id']);	

		if(!$this->session->userdata('logged_in'))redirect('user/login',301);
		if($this->session->userdata('gid') !=1) redirect('dashboard',301);		
				
	} 
	
	public function index( $id = null )
	{
	
		$pos = ($this->input->get('pos')!='' ? $this->input->get('pos') : 'top' );
		$rows = $this->db->get_where('tb_menu',array('menu_id'=>$id ));
		if(count($rows->result())>=1)
		{
			$row = $rows->result_array();
			$this->data['row'] =  $row[0];
			$this->data['menu_lang'] = json_decode($this->data['row']['menu_lang'],true);    
		} else {
			$this->data['row'] = $this->model->getColumnTable('tb_menu'); 
			$this->data['menu_lang'] = array(); 
		}
		//echo '<pre>';print_r($this->data['row']);echo '</pre>';exit;

		$this->data['menus']		= SiteHelpers::menus( $pos ,'all');
		$this->data['modules'] 		= $this->db->query("SELECT * FROM tb_module WHERE module_type !='core'")->result();
		$this->data['groups'] 		= $this->db->get('tb_groups');
		$this->data['pages'] 		= $this->db->get('tb_pages');
		$this->data['active'] = $pos;	
		$this->data['content'] = $this->load->view('sximo/menu/index',$this->data, true );		
    	$this->load->view('layouts/main', $this->data );	
	}
	
	function saveOrder( $id =0)
	{
		$rules = array(
			array('field'   => 'reorder','label'   => 'Reorder Array','rules'   => 'required'),
		);
		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() ){
			$menus = json_decode($this->input->post('reorder'),true);
			$child = array();
			$a=0;
			foreach($menus as $m)
			{			
				if(isset($m['children']))
				{
					$b=0;
					foreach($m['children'] as $l)					
					{
						if(isset($l['children']))
						{
							$c=0;
							foreach($l['children'] as $l2)
							{
								$level3[] = $l2['id'];
								$this->db->where(array('menu_id'=>$l2['id']));
								$this->db->update('tb_menu',array('parent_id'=> $l['id'],'ordering'=>$c));
								$c++;	
							}		
						}
						$this->db->where(array('menu_id'=>$l['id']));
						$this->db->update('tb_menu',array('parent_id'=> $m['id'],'ordering'=>$b));
						$b++;
					}							
				}
				$this->db->where(array('menu_id'=>$m['id']));
				$this->db->update('tb_menu',array('parent_id'=> 0,'ordering'=>$a));
				$a++;		
			}

			redirect('sximo/menu',301);
		} else {
			redirect('sximo/menu',301);
		}	
	}
		
	
	function save( $id =0)
	{

		$rules = array(
			array('field'   => 'menu_name','label'   => 'Menu Name','rules'   => 'required'),
			array('field'   => 'active','label'   	 => 'Active','rules'   => 'required'),
			array('field'   => 'menu_type','label'   => 'Menu Type','rules'   => 'required'),
			array('field'   => 'position','label'    => 'Position','rules'   => 'required')
		);
		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() ){
			$pos = $this->input->post('position',true);	
			$data = $this->validatePost('tb_menu');		
			if(CNF_MULTILANG ==1)
			{
				$lang = SiteHelpers::langOption();
				$language =array();
				foreach($lang as $l)
				{
					if($l['folder'] !='en'){
						$menu_lang = (isset($_POST['language_title'][$l['folder']]) ? $_POST['language_title'][$l['folder']] : '');  
						$language['title'][$l['folder']] = $menu_lang;        
					}    
				}	
					
				$data['menu_lang'] = json_encode($language);  
			}	


			$arr = array();
			$groups = $this->db->get('tb_groups')->result();
			foreach($groups as $g)
			{
				$arr[$g->group_id] = (isset($_POST['groups'][$g->group_id]) ? "1" : "0" );	
			}
			$data['access_data'] = json_encode($arr);		
			$data['allow_guest'] 	= (isset($_POST['allow_guest']) ? '1' : '0');
			//echo '<pre>';print_r($data);echo '</pre>';exit;		
			unset($data['ordering']);		
			$this->model->insertRow($data , $this->input->post('menu_id'));			
			redirect('sximo/menu?pos='.$pos);
			
		} else {
			redirect('sximo/menu?pos='.$pos);
		}	
	
	}
	
	public function destroy($id)
	{
		$menus = $this->db->get_where('tb_menu',array('parent_id'=>$id))->result();
		
		foreach($menus as $row)
		{
			$this->model->destroy($row->menu_id);
		}
		
		$this->model->destroy($id);
		// redirect
		$this->session->set_flashdata('message',SiteHelpers::alert('success','Successfully deleted row!'));
		redirect('sximo/menu',301);
	}		
		
	
}	