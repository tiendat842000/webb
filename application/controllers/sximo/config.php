<?php

class Config extends SB_Controller  {

	protected $layout = "layouts.main";
	
	public function __construct() {
		
		parent::__construct();
		$this->data = array(
			'pageTitle'	=> 'Site Config',
			'pageNote'	=> 'Manage Setting Configuration'
		); 	
		if(!$this->session->userdata('logged_in'))
		{
			redirect('user/login',301);
		}

		if($this->session->userdata('gid') !=1) redirect('dashboard',301);
			
	} 	


	public function index()
	{
		$this->data['themes'] = self::themeOption();
		$this->data['groups'] = $this->db->get('tb_groups');
		$this->data['content'] = $this->load->view('sximo/config/index',$this->data, true );		
    	$this->load->view('layouts/main', $this->data );
	}
	
	public function postSave()
	{
			$val  =		"<?php \n"; 
			$val .= 	"define('CNF_APPNAME','". $this->input->post('cnf_appname',true)."');\n";
			$val .= 	"define('CNF_APPDESC','". $this->input->post('cnf_appdesc',true)."');\n";
			$val .= 	"define('CNF_COMNAME','". $this->input->post('cnf_comname',true)."');\n";
			$val .= 	"define('CNF_EMAIL','". $this->input->post('cnf_email')."',true);\n";	
			$val .= 	"define('CNF_METAKEY','". $this->input->post('cnf_metakey',true)."');\n";	
			$val .= 	"define('CNF_METADESC','". $this->input->post('cnf_metadesc',true)."');\n";		
			$val .= 	"define('CNF_GROUP','". $this->input->post('cnf_group',true)."');\n";	
			$val .= 	"define('CNF_ACTIVATION','". $this->input->post('cnf_activation',true)."');\n";	
			$val .= 	"define('CNF_REGIST','". $this->input->post('cnf_regist',true)."');\n";	
			$val .= 	"define('CNF_FRONT','".$this->input->post('cnf_front',true)."');\n";		
			$val .= 	"define('CNF_THEME','".$this->input->post('cnf_theme',true)."');\n";
			$val .= 	"define('CNF_MULTILANG','".$this->input->post('cnf_multilang',true)."');\n";
			$val .= 	"define('CNF_RECAPTCHA','".CNF_RECAPTCHA."');\n";
			$val .= 	"define('CNF_RECAPTCHA_PUBLIC','".CNF_RECAPTCHA_PUBLIC."');\n";
			$val .= 	"define('CNF_RECAPTCHA_PRIVATE','".CNF_RECAPTCHA_PRIVATE."');\n";
			$val .= 	"define('CNF_LOGINFB','".CNF_LOGINFB."');\n";
			$val .= 	"define('CNF_LOGINFB_ID','".CNF_LOGINFB_ID."');\n";
			$val .= 	"define('CNF_LOGINFB_SECRET','".CNF_LOGINFB_SECRET."');\n";
			$val .= 	"define('CNF_LOGINGG','".CNF_LOGINGG."');\n";
			$val .= 	"define('CNF_LOGINGG_ID','".CNF_LOGINGG_ID."');\n";
			$val .= 	"define('CNF_LOGINGG_SECRET','".CNF_LOGINGG_SECRET."');\n";
			$val .= 	"define('CNF_LOGINTW','".CNF_LOGINTW."');\n";
			$val .= 	"define('CNF_LOGINTW_ID','".CNF_LOGINTW_ID."');\n";
			$val .= 	"define('CNF_LOGINTW_SECRET','".CNF_LOGINTW_SECRET."');\n";
			$val .= 	"?>";
				
		$filename = 'setting.php';
		file_put_contents( $filename , $val  );
		$this->session->set_flashdata('message',SiteHelpers::alert('success','Site Setting Has Been Updated'));
		redirect( site_url('sximo/config'));
	
	}


	public function blast()
	{
		$this->data = array(
			'groups'	=> $this->db->get('tb_groups'),
			'pageTitle'	=> 'Blast Email',
			'pageNote'	=> 'Send email to users'
		);
		$this->data['content'] = $this->load->view('sximo/config/blast',$this->data, true );		
    	$this->load->view('layouts/main', $this->data );				
	}

	function doBlast()
	{
		if(!is_null($this->input->post('groups')))
		{
			$groups = $this->input->post('groups');
			for($i=0; $i<count($groups); $i++)
			{
				if($this->input->post('uStatus') == 'all')
				{
					$users = $this->db->get_where('tb_users',array('group_id'=>$groups[$i]));
				} else {
					$users = $this->db->get_where('tb_users',array('group_id'=>$groups[$i],'active'=>$this->input->post('uStatus')));
				}
				$count = 0;
				foreach($users->result() as $row)
				{

					$to = $row->email;
					$subject = $this->input->post('subject');
					$message = $this->input->post('message');
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: '.CNF_APPNAME.' <'.CNF_EMAIL.'>' . "\r\n";
						mail($to, $subject, $message, $headers);
					
					$count = ++$count;					
				} 
				
			}
			$this->session->set_flashdata('message',SiteHelpers::alert('success','Total '.$count.' Message has been sent'));
			return redirect('sximo/config/blast',301);

		}
	

	}


	public function email()
	{
		
		$regEmail 	= "application/views/emails/registration.php";
		$resetEmail = "application/views/emails/reminder.php";
		$this->data = array(
			'pageTitle'	=> 'Blast Email',
			'pageNote'	=> 'Send email to users',
			'regEmail' 	=> file_get_contents($regEmail),
			'resetEmail'	=> 	file_get_contents($resetEmail)
		);	
		
		$this->data['content'] = $this->load->view('sximo/config/email',$this->data, true );		
    	$this->load->view('layouts/main', $this->data );	
	
	}
	
	function postEmail()
	{
		$regEmailFile = "application/views/emails/registration.php";
		$resetEmailFile = "application/views/emails/reminder.php";
		
		$fp= fopen($regEmailFile,"w+"); 				
		fwrite($fp,$_POST['regEmail']); 
		fclose($fp);	
		
		$fp= fopen($resetEmailFile,"w+"); 				
		fwrite($fp,$_POST['resetEmail']); 
		fclose($fp);

		$this->session->set_flashdata('message',SiteHelpers::alert('success','Email Has Been Updated'));
		redirect('sximo/config/email',301);	
	
	}

	
	public function themeOption()
	{
    	$theme_path = "application/views/layouts/";
		$themes = scandir( $theme_path );
		$t = array();
		foreach($themes as $value) {
			if($value === '.' || $value === '..') continue;
			if(is_dir( "./application/views/layouts/" . $value) && file_exists("./application/views/layouts/" .$value.'/info.json' ) )
			{
				$fp = file_get_contents( $theme_path .$value.'/info.json');
				$fp = json_decode($fp,true);
				$t[] =  $fp ;
				
			} 
			
		}	
		return $t;
	}		
	
	function security() {
	  
		$this->data['themes'] = self::themeOption();
		$this->data['groups'] = $this->db->get('tb_groups');
		$this->data['content'] = $this->load->view('sximo/config/security',$this->data, true );		
    	$this->load->view('layouts/main', $this->data );
	  
	  
	}
	
	function postSecurity() {
	  
			$val  =		"<?php \n"; 
			$val .= 	"define('CNF_APPNAME','". CNF_APPNAME ."');\n";
			$val .= 	"define('CNF_APPDESC','". CNF_APPDESC ."');\n";
			$val .= 	"define('CNF_COMNAME','". CNF_COMNAME ."');\n";
			$val .= 	"define('CNF_EMAIL','". CNF_EMAIL ."',true);\n";	
			$val .= 	"define('CNF_METAKEY','". CNF_METAKEY ."');\n";	
			$val .= 	"define('CNF_METADESC','". CNF_METADESC ."');\n";		
			$val .= 	"define('CNF_GROUP','". CNF_GROUP ."');\n";	
			$val .= 	"define('CNF_ACTIVATION','". CNF_ACTIVATION ."');\n";	
			$val .= 	"define('CNF_REGIST','". CNF_REGIST ."');\n";	
			$val .= 	"define('CNF_FRONT','".CNF_FRONT ."');\n";		
			$val .= 	"define('CNF_THEME','".CNF_THEME ."');\n";
			$val .= 	"define('CNF_MULTILANG','".CNF_MULTILANG."');\n";
			
			$val .= 	"define('CNF_RECAPTCHA','".$this->input->post('cnf_recaptcha',true)."');\n";
			$val .= 	"define('CNF_RECAPTCHA_PUBLIC','".$this->input->post('cnf_recaptcha_public',true)."');\n";
			$val .= 	"define('CNF_RECAPTCHA_PRIVATE','".$this->input->post('cnf_recaptcha_private',true)."');\n";
			$val .= 	"define('CNF_LOGINFB','".$this->input->post('cnf_loginfb',true)."');\n";
			$val .= 	"define('CNF_LOGINFB_ID','".$this->input->post('cnf_loginfb_id',true)."');\n";
			$val .= 	"define('CNF_LOGINFB_SECRET','".$this->input->post('cnf_loginfb_secret',true)."');\n";
			$val .= 	"define('CNF_LOGINGG','".$this->input->post('cnf_logingg',true)."');\n";
			$val .= 	"define('CNF_LOGINGG_ID','".$this->input->post('cnf_logingg_id',true)."');\n";
			$val .= 	"define('CNF_LOGINGG_SECRET','".$this->input->post('cnf_logingg_secret',true)."');\n";
			$val .= 	"define('CNF_LOGINTW','".$this->input->post('cnf_logintw',true)."');\n";
			$val .= 	"define('CNF_LOGINTW_ID','".$this->input->post('cnf_logintw_id',true)."');\n";
			$val .= 	"define('CNF_LOGINTW_SECRET','".$this->input->post('cnf_logintw_secret',true)."');\n";
			$val .= 	"?>";
	
		$filename = 'setting.php';
		file_put_contents( $filename , $val );
		
		$this->session->set_flashdata('message',SiteHelpers::alert('success','Security Setting Has Been Updated'));
		redirect('sximo/config/security',301);	
	  
	  
	}
	

	
}