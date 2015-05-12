<?php //if (!defined('BASEPATH')) exit('No direct script access allowed');

class SB_Controller extends CI_Controller
{

	var $data = array();
 
	function __construct() {
		parent::__construct();

		if($this->session->userdata('lang') =='')
		{
			$this->session->set_userdata('lang','en');
			$this->load->language('core','en');
		} else {
			$this->load->language('core',$this->session->userdata('lang'));
		}
		
		$this->data['content'] = 'Thiết lập xuất from từ database';
		$this->data['page'] = $this->input->get('page',true);
 
		// init for upload library
		$upload_config = array();
		$this->load->library('upload', $upload_config );
 
		$imagelib_config = array();
		$this->load->library('image_lib', $imagelib_config );
 
	}



	function download()
	{

		$info = $this->model->makeInfo( $this->module);
		// Take param master detail if any

		$results 	= $this->model->getRows( array() );
		$fields		= $info['config']['grid'];
		$rows		= $results['rows'];

		$content = $this->data['pageTitle'];
		$content .= '<table border="1">';
		$content .= '<tr>';
		foreach($fields as $f )
		{
			if($f['download'] =='1') $content .= '<th style="background:#f9f9f9;">'. $f['label'] . '</th>';
		}
		$content .= '</tr>';

		foreach ($rows as $row)
		{
			$content .= '<tr>';
			foreach($fields as $f )
			{
				if($f['download'] =='1'):
					$conn = (isset($f['conn']) ? $f['conn'] : array() );
					$content .= '<td>'. SiteHelpers::gridDisplay($row->$f['field'],$f['field'],$conn) . '</td>';
				endif;
			}
			$content .= '</tr>';
		}
		$content .= '</table>';

		@header('Content-Type: application/ms-excel');
		@header('Content-Length: '.strlen($content));
		@header('Content-disposition: inline; filename="'.$title.' '.date("d/m/Y").'.xls"');

		echo $content;
		exit;

	}

	function search()
	{
		$keyword = $this->module;
		if(!is_null($this->input->get('keyword', true)))
		{
			$keyword = $this->module.'?search='.str_replace(' ','_',$this->input->get('keyword', true));
		}
		return redirect($keyword);

	}

	function multisearch()
	{
		//echo '<pre>';print_r($_POST);echo '</pre>';exit;
		$post = $_POST;
		$items ='';
		foreach($post as $item=>$val):
			if($_POST[$item] !='' and $item !='_token' and $item !='md' && $item !='id'):
				$items .= $item.':'.trim($val).'|';
			endif;

		endforeach;
		redirect($this->module.'?search='.substr($items,0,strlen($items)-1));
	}

	function filter()
	{
		$module = $this->module;
		$sort 	= (!is_null($this->input->get('sort', true)) ? $this->input->get('sort', true) : '');
		$order 	= (!is_null($this->input->get('order', true)) ? $this->input->get('order', true) : '');
		$rows 	= (!is_null($this->input->get('rows', true)) ? $this->input->get('rows', true) : '');
		$md 	= (!is_null($this->input->get('md', true)) ? $this->input->get('md', true) : '');

		$filter = '?';
		if($sort!='') $filter .= '&sort='.$sort;
		if($order!='') $filter .= '&order='.$order;
		if($rows!='') $filter .= '&rows='.$rows;
		if($md !='') $filter .= '&md='.$md;



		return redirect($module . $filter);

	}


	function infoFieldSearch()
	{
		$info =$this->model->makeInfo( $this->module);
		$forms = $info['config']['forms'];
		$data = array();
		foreach($forms as $f)
		{
			if($f['search'] ==1)
            	if($f['alias'] !='' )  {
				$data[] =  array('id'=> $f['alias'].".".$f['field']);
			}
		}
		return $data;
	}
	function buildSearch()
	{
		$keywords = ''; $fields = '';	$param ='';
		$allowsearch = $this->info['config']['forms'];
		foreach($allowsearch as $as) $arr[$as['field']] = $as ;
		if($this->input->get('search', true) !='')
		{
			$type = explode("|",$this->input->get('search', true));
			if(count($type) >= 1)
			{
				foreach($type as $t)
				{
					$keys = explode(":",$t);

					if(in_array($keys[0],array_keys($arr))):
						if($arr[$keys[0]]['type'] == 'select' || $arr[$keys[0]]['type'] == 'radio' )
						{
							$param .= " AND ".$arr[$keys[0]]['alias'].".".$keys[0]." = '".$keys[1]."' ";
						} else {
							$param .= " AND ".$arr[$keys[0]]['alias'].".".$keys[0]." REGEXP '".$keys[1]."' ";
						}
					endif;
				}
			}
		}
		return $param;

	}


	function comboselect()
	{
		$param = explode(':',$this->input->get('filter', true));
		$rows = $this->model->getComboselect($param);
		$items = array();

		$fields = explode("|",$param[2]);

		foreach($rows as $row)
		{
			$value = "";
			foreach($fields as $item=>$val)
			{
				if($val != "") $value .= $row->$val." ";
			}
			$items[] = array($row->$param['1'] , $value);

		}

		echo json_encode($items);
	}

	function combotable()
	{
		$rows = $this->model->getTableList($this->db->database);
		
		$items = array();
		foreach($rows as $row) {
			$items[] = array($row , $row);
		}	
		
		echo json_encode($items);
	}

	function combotablefield()
	{
		$items = array();
		$table = $this->input->get('table', true);
		if($table !='')
		{
			$rows = $this->model->getTableField($this->input->get('table', true));
			foreach($rows as $row)
				$items[] = array($row , $row);
		}
		echo json_encode($items);
	}

	function validateListError( $rules )
	{
		$errMsg = $this->lang->line('core.note_error') ;
		$errMsg .= '<hr /> <ul>';
		foreach($rules as $key=>$val)
		{
			$errMsg .= '<li>'.$key.' : '.$val[0].'</li>';
		}
		$errMsg .= '</li>';
		return $errMsg;
	}
	
	function validateForm()
	{
		$forms = $this->info['config']['forms'];
		$rules = array();
		foreach($forms as $form)
		{
			if($form['required']== '' || $form['required'] !='0')
			{
				$rules[] = array('field'   => $form['field'],'label' => $form['label'], 'rules'   => 'required');	
			} elseif ($form['required'] == 'alpa'){
				$rules[] = array('field'   => $form['field'],'label' => $form['label'], 'rules'   => 'required|alpha');			
			} elseif ($form['required'] == 'alpa_num'){
				$rules[] = array('field'   => $form['field'],'label' => $form['label'], 'rules'   => 'required|alpha_numeric');			
			} elseif ($form['required'] == 'alpa_dash'){
				$rules[] = array('field'   => $form['field'],'label' => $form['label'], 'rules'   => 'required|alpha_dash');			
			}  elseif ($form['required'] == 'email'){
				$rules[] = array('field'   => $form['field'],'label' => $form['label'], 'rules'   => 'required|valid_email');			
			}  elseif ($form['required'] == 'numeric'){
				$rules[] = array('field'   => $form['field'],'label' => $form['label'], 'rules'   => 'required|numeric');			
			}  else {
			
			}				
			
		}
		
		//echo '<pre>';print_r($rules);echo '<pre>';exit;
		return $rules ;
	}

	function validatePost(  $table = '')
	{
		$str = $this->info['config']['forms'];
		
		$data = array();
		
		foreach($str as $f){
			$field = $f['field'];
			if($f['view'] ==1)
			{

				if(!is_null($this->input->get( $field , true )))
				{
					$data[$field] = $this->input->get($field,true);
				}

				switch ($f['type']) {
					case 'textarea_editor':
					case 'textarea':
						$content = $this->input->get_post($field)? $this->input->get_post($field):'';
						$data[$field] =  $content;
 				   
					break;
					
					case 'file' :
						$this->load->library('upload');
						$destinationPath = "./".$f['option']['path_to_upload'];
					
						$config['upload_path'] = $destinationPath;
						$config['allowed_types'] = 'gif|jpg|png';
						
						$this->upload->initialize($config);
						if($this->upload->do_upload($field))
						{
							$file_data = $this->upload->data();
							$filename = $file_data['file_name'];
							$extension =$file_data['file_ext']; //if you need extension of the file


							 if($f['option']['resize_width'] != '0' && $f['option']['resize_width'] !='')
							 {
							 	if( $f['option']['resize_height'] ==0 )
								{
									$f['option']['resize_height']	= $f['option']['resize_width'];
								}
 
							 	$origFile = $destinationPath.'/'.$filename;
								 SiteHelpers::cropImage($f['option']['resize_width'] , $f['option']['resize_height'] , $orgFile ,  $extension,	 $orgFile)	;
							 }

							 $data[$field] = $filename;
						} else {
							unset($data[$field]);
						}
					
 					 break;
					
					case 'checkbox' :
						if(!is_null($this->input->get( $field , true )))
						{
							$data[$field] = implode(",",$this->input->get_post( $field , true ));
						}
 					 
 					 break;
					
					case 'date' :
						$data[$field] = date("Y-m-d",strtotime($this->input->get_post( $field , true )));
 					 break;
					
					case 'select' :
						if( isset($f['option']['is_multiple']) &&  $f['option']['is_multiple'] ==1 )
						{
							$data[$field] = implode(",",$this->input->get_post( $field , true ));
						} else {
							$data[$field] = $this->input->get_post( $field , true );
						}
 					 break;
					
					case 'text' :
					default:
						$data[$field] = $this->input->get_post( $field , true );
					break;
				}				

			}
		}
		 $global	= (isset($this->access['is_global']) ? $this->access['is_global'] : 0 );
		 if($global == 0 )
			 $data['entry_by'] = $this->session->userdata('uid');

		return $data;
	}

	function validAccess( $methode )
	{

		if($this->model->validAccess( $methode ,$this->info['id']) == false)
		{
			$this->session->setflashdata('message', SiteHelpers::alert('error',' Your are not allowed to access the page '));
			return redirect('home');

		}

	}

	function inputLogs( $note = NULL)
	{
		$data = array(
			'module'	=> $this->uri->segment(1),
			'task'		=> $this->uri->segment(2),
			'user_id'	=> $this->session->userdata('uid'),
			'ipaddress'	=> $this->input->ip_address(),
			'note'		=> $note
		);
		 $this->db->insert( 'tb_logs',$data);		;

	}


 
	function paginator($options = array() ) {

		$keepLive = '';
		$sort 	= (!is_null($this->input->get('sort', true)) ? $this->input->get('sort', true) : '');
		$order 	= (!is_null($this->input->get('order', true)) ? $this->input->get('order', true) : '');
		$rows 	= (!is_null($this->input->get('rows', true)) ? $this->input->get('rows', true) : '');
		$search 	= (!is_null($this->input->get('search', true)) ? $this->input->get('search', true) : '');

		$appends = array();
		if($sort!='') 	$keepLive .='&sort='.$sort;
		if($order!='') 	$keepLive .='&order='.$order;
		if($rows!='') 	$keepLive .='&rows='.$rows;
		if($search!='') $keepLive .='&search='.$search;

		$toptions = array_replace_recursive( array(
			'base_url' => site_url( $this->module ).'?'.$keepLive,
			'total_rows' => 0 ,
			'per_page' => $this->per_page,
		), $options ); 
 
		$this->pagination->initialize( $toptions );

		return $this->pagination->create_links();

	} 
	
	function displayError($data)
	{
		$this->load->view('layouts/errors',$data);
	}
	


}




?>