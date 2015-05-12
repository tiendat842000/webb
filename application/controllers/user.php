<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends SB_controller {

	protected $_key 	= 'id';
	protected $_class	= 'welcome';
	protected $_model	= 'usersmodel';

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo  '';
	}

	public function profile()
	{
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);

		$info =	$this->db->get_where('tb_users',array('id'=>$this->session->userdata('uid')));
		$this->data = array(
			'pageTitle'	=> 'My Profile',
			'pageNote'	=> 'View Detail My Info',
			'info'		=> $info->row(),
		);
		$this->data['content'] = $this->load->view('user/profile',$this->data, true );
    	$this->load->view('layouts/'.CNF_THEME.'/index', $this->data );
	}

	public function saveProfile()
	{

		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
		$rules = array(
			array('field'   => 'first_name','label'   => 'First Name','rules'   => 'required'),
			array('field'   => 'last_name','label'   	 => 'Last Name','rules'   => 'required'),
		);

		if($this->input->post('email',true) != $this->session->userdata('eid'))
		{
			$rules[] =array( 'field'=>'email','label'=>'Email Address','rules'=>'required|email|is_unique[tb_users.email]');
		}


		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() ){

			$data = array(
				'first_name'=>	$this->input->post('first_name',true),
				'last_name'	=>	$this->input->post('last_name',true),
				'email'		=>	$this->input->post('email',true),
			);
			if(isset($_FILES['avatar']))
			{
				$this->load->library('upload');
				$destinationPath = "./uploads/users/";

				$config['upload_path'] = $destinationPath;
				$config['allowed_types'] = 'gif|jpg|png';
				$this->upload->initialize($config);
				if($this->upload->do_upload('avatar'))
				{
					$file_data = $this->upload->data();
					$data['avatar'] = $file_data['file_name'];
				}
			}

			$this->db->where('id' ,$this->session->userdata('uid'));
			$this->db->update('tb_users',$data);
			$this->session->set_flashdata('message',SiteHelpers::alert('success','Your Profile has been updated succesfuly'));
			redirect('user/profile',301);

		} else {

			$this->session->set_flashdata('message',SiteHelpers::alert('error','Ops Something went wrong !'));
			redirect('user/profile',301);
		}

	}

	public function savePassword()
	{
		$rules = array(
			array('field'   => 'password','label'   => 'password','rules'   => 'required'),
			array('field'   => 'password_confirmation','label' => 'password confirmation','rules'   => 'required'),
		);
		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() ){

			$data = array('password'=>md5(trim($this->input->post('password'))));
			$this->db->where('id' ,$this->session->userdata('uid'));
			$this->db->update('tb_users',$data);
			$this->session->set_flashdata('message',SiteHelpers::alert('success','Your password has been changed succesfuly'));
			redirect('user/profile',301);

		} else {
			$this->session->set_flashdata('message',SiteHelpers::alert('error','Ops Something went wrong !'));
			redirect('user/profile',301);
		}

	}

	public function login()
	{

		$this->load->library('recaptcha');
		$this->data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();
		
		$this->data['email'] = '';
		if( $this->session->userdata("_POST_DATA")){
			$this->data = array_merge( $this->data , $this->session->userdata("_POST_DATA"));
			$this->session->unset_userdata('_POST_DATA');
		}

		$this->data['content'] = $this->load->view('user/login',$this->data, true );
    	$this->load->view('layouts/login', $this->data );
	}

	public function postLogin()
	{

		// check for captcha here
		if( CNF_RECAPTCHA ){
			$this->load->library('recaptcha');
			$this->recaptcha->recaptcha_check_answer() ;
			if( ! ($this->recaptcha->getIsValid() )){
				$this->session->set_flashdata('message',SiteHelpers::alert('error','Incorrect Captcha'));
				$this->session->set_userdata(array(
					'_POST_DATA' => $_POST,
				));
				redirect("user/login", 301 );
			} 
		}

		$data = array(
			'email'		=> trim($this->input->post('email')),
			'password'	=> md5(trim($this->input->post('password'))),
			'active'	=> '1'
		);

		$row = $this->db->get_where('tb_users',$data)->row();

		if(count($row) >= 1)
		{
			$this->db->where('id',$row->id);
			$this->db->update('tb_users',array('last_login'=> date("Y-m-d H:i:s")));
			$this->session->set_userdata(array(
				'logged_in'	=> true,
				'uid'		=> $row->id,
				'gid'		=> $row->group_id,
				'eid'		=> $row->email,
				'll'		=> $row->last_login,
				'fid'		=> $row->first_name.' '.$row->last_name,
			));
			redirect('dashboard',301);

		} else {
			$this->session->set_flashdata('message',SiteHelpers::alert('error','Invalid email or password combination <br /> or your account is not active yet'));
			redirect('user/login',301);
		}

	}

	public function register() {

		$this->load->library('recaptcha');
		$this->data['recaptcha_html'] = $this->recaptcha->recaptcha_get_html();

		if(CNF_REGIST =='false') :
			if($this->session->userdata('logged_in')):
				redirect('',301);
			else:
				redirect('user/login',301);
			endif;

		else :
			// initiate data
			$this->data['firstname'] = '';
			$this->data['lastname'] = '';
			$this->data['email'] = '';

			// check if there are previous post data
			if( $this->session->userdata("_POST_DATA")){
				$this->data = array_merge( $this->data , $this->session->userdata("_POST_DATA"));
				$this->session->unset_userdata('_POST_DATA');
			}

			$this->data['content'] = $this->load->view('user/register',$this->data, true );
			$this->load->view('layouts/login', $this->data );
		 endif ;



	}

	public function create() {

		// check for captcha here
		if( CNF_RECAPTCHA ){
			$this->load->library('recaptcha');
			$this->recaptcha->recaptcha_check_answer() ;
			if( ! ($this->recaptcha->getIsValid() )){
				$this->session->set_flashdata('message',SiteHelpers::alert('error','Incorrect Captcha'));
				$this->session->set_userdata(array(
					'_POST_DATA' => $_POST,
				));
				redirect("user/create");
			} 
		}



		$rules = array(
			array('field'   => 'firstname','label'   => 'firstname','rules'   => 'required'),
			array('field'   => 'lastname','label'   => 'lastname','rules'   => 'required'),
			array('field'   => 'email','label'   => 'email','rules'   => 'required|email|is_unique[tb_users.email]'),
			array('field'   => 'password','label'   => 'password','rules'   => 'required'),
			array('field'   => 'password_confirmation','label'   => 'password_confirmation','rules'   => 'required'),
		);

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() && $this->recaptcha->getIsValid() ){
			$code = rand(10000,10000000);
			$authen = array(
				'first_name'	=> $this->input->post('firstname',true),
				'last_name'		=> $this->input->post('lastname',true),
				'email'			=> $this->input->post('email',true),
				'activation'	=> $code,
				'group_id'		=>  CNF_GROUP ,
				'password'		=>  md5(trim($this->input->post('password',true))) ,
			);
			if(CNF_ACTIVATION == 'auto') { $authen['active'] = '1'; } else { $authen['active'] = '0'; }
			$this->db->insert('tb_users',$authen);

			$data = array(
				'firstname'	=> $this->input->post('firstname') ,
				'lastname'	=> $this->input->post('lastname') ,
				'email'		=> $this->input->post('email') ,
				'password'	=> $this->input->post('password') ,
				'code'		=> $code

			);
			if(CNF_ACTIVATION == 'confirmation')
			{
				$to = $this->input->post('email');
				$subject = "[ " .CNF_APPNAME." ] REGISTRATION ";
				$message = $this->load->view('emails/registration', $data,true);
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: '.CNF_APPNAME.' <'.CNF_EMAIL.'>' . "\r\n";
					mail($to, $subject, $message, $headers);

				$message = "Thanks for registering! . Please check your inbox and follow activation link";

			} elseif(CNF_ACTIVATION=='manual') {
				$message = "Thanks for registering! . We will validate you account before your account active";
			} else {
				$message = "Thanks for registering! . Your account is active now ";
			}

			$this->session->set_flashdata('message',SiteHelpers::alert('success',$message));
			redirect('user/login',301);
		} else {
			
			$this->session->set_flashdata('message',SiteHelpers::alert('error','Ops Something Went Wrong'));
			$this->session->set_userdata(array(
				'_POST_DATA' => $_POST,
			));
			
			redirect('user/register',301);
		}
	}

	public function activation( )
	{
		$num = $this->input->get('code',true);
		if($num =='')
		{
			$this->session->set_flashdata('message',SiteHelpers::alert('error','Invalid Code Activation!'));
			redirect('user/login',301);
		}
		$user = $this->db->get_where('tb_users',array('activation'=>$num))->row();
		if (count($user) >=1)
		{
			$data = array('active' => 1,'activation'=>'');
			$this->db->where('activation',$num);
			$this->db->update('tb_users',$data);

			$this->session->set_flashdata('message',SiteHelpers::alert('success','Your account is active now!'));
			redirect('user/login',301);

		} else {

			$this->session->set_flashdata('message',SiteHelpers::alert('error','Invalid Code Activation!'));
			redirect('user/login',301);
		}

	}

	public function saveRequest()
	{
		$rules = array(
			array('field'   => 'credit_email','label'   => 'credit email','rules'   => 'required|email'),
		);
		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$user = $this->db->get_where('tb_users',array('email'=>$this->input->post('credit_email',true)))->row();
			if(count($user) >=1)
			{
				$token = rand(10000,10000000);
				$data = array('token'=>$token);
				$to = $this->input->post('credit_email',true);
				$subject = "[ " .CNF_APPNAME." ] REQUEST PASSWORD RESET ";
				$message = $this->load->view('emails/reminder',$data,true);
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: '.CNF_APPNAME.' <'.CNF_EMAIL.'>' . "\r\n";
					mail($to, $subject, $message, $headers);
				$data = array('reminder'=>$token);
				$this->db->where('id',$user->id);
				$this->db->update('tb_users',$data);

				$this->session->set_flashdata('message',SiteHelpers::alert('success','Please check your email and follow reset link '));
				redirect('user/login',301);


			} else {
				$this->session->set_flashdata('message',SiteHelpers::alert('error','Cant find email address'));
				redirect('user/login',301);
			}

		}  else {
				$this->session->set_flashdata('message',SiteHelpers::alert('error','Please write your email address'));
				redirect('user/login',301);
		}
	}

	public function reset( $token = '')
	{

		$user = $this->db->get_where('tb_users',array('reminder'=>$token))->row();
		if(count($user) >=1)
		{
			$this->data = array('verCode'=>$token);
			$this->data['content'] = $this->load->view('user/remind',$this->data, true );
			$this->load->view('layouts/login', $this->data );

		} else {
			$this->session->set_flashdata('message',SiteHelpers::alert('error','Cant find your reset code'));
			redirect('user/login',301);
		}

	}

	public function saveReset( $token = '')
	{
		$rules = array(
			array('field'   => 'password','label'   => 'password','rules'   => 'required'),
			array('field'   => 'password_confirmation','label'   => 'password confirmation','rules'   => 'required|matches[password]'),
		);


		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{

			$user = $this->db->get_where('tb_users',array('reminder'=>$token))->row();
			if(count($user) >=1)
			{
				$data = 	array('password'=>md5(trim($this->input->post('password'))),'reminder'=>'');
				$this->db->where('id',$user->id);
				$this->db->update('tb_users',$data);
			}
			$this->session->set_flashdata('message',SiteHelpers::alert('success','Password has been saved!'));
			redirect('user/login',301);

		} else {
			$this->session->set_flashdata(
				array(
					'message'	=>SiteHelpers::alert('error','The following errors occurred'),
					'errors'	=> validation_errors('<li>', '</li>')
					)
			);
			redirect('user/reset/'.$token,301);
		}

	}

	public function logout()
	{
		$this->session->unset_userdata(array(
				'logged_in'	=> '',
				'uid'		=> '',
				'gid'		=> '',
				'eid'		=> '',
				'll'		=> '',
				'fid'		=> '',
			));
		redirect('',301);
	}
	
	public function hlogin ( $provider ){
	  
		include_once "hauth.php";
		
		$hauth = new HAuth();
		$profile = $hauth->login( $provider );
		
		$data = array(
			'email'		=> trim($profile['user_profile']->email ),
			'active'	=> '1'
		);

		$row = $this->db->get_where('tb_users',$data)->row();

		if(count($row) >= 1)
		{
			$this->session->set_userdata(array(
				'logged_in'	=> true,
				'uid'		=> $row->id,
				'gid'		=> $row->group_id,
				'eid'		=> $row->email,
				'll'		=> $row->last_login,
				'fid'		=> $row->first_name.' '.$row->last_name,
			));
			redirect('',301);

		} else {
			$this->session->set_flashdata('message',SiteHelpers::alert('error','Invalid '.$provider.' account <br /> or your account is not active yet'));
			redirect('user/login',301);
		}

		
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/page.php */