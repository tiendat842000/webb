<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends SB_controller {

	protected $_key 	= 'id';
	protected $_class	= 'page';
	protected $layout = "layouts/main";
	
	function __construct()
	{
		parent::__construct();	
		$this->layout = 'layouts/'.CNF_THEME.'/index';
				
	}
	
	
	public function index( $page = null)
	{
		if(CNF_FRONT =='false' && $this->uri->segment(1) =='' ) :
			redirect('dashboard',301);
		endif; 
	
		if($page != null) :
			$row = $this->db->query("SELECT * FROM tb_pages WHERE alias ='$page' and status='enable' ")->row();

			if(count($row) >=1)
			{

				$this->data['pageTitle'] = $row->title;
				$this->data['pageNote'] = $row->note;		
				$this->data['breadcrumb'] = 'active';					
				
				if($row->access !='')
				{
					$access = json_decode($row->access,true)	;	
				} else {
					$access = array();
				}	

				// If guest not allowed 
				if($row->allow_guest !=1)
				{	
					$group_id = $this->session->userdata('gid');				
					$isValid =  (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );	
					if($isValid ==0)
					{
						redirect('',301);				
					}
				}				
				if($row->template =='backend')
				{
					 $this->layout = "layouts/main";
				}
				
				$filename = "application/views/pages/".$row->filename.".php";
				if(file_exists($filename))
				{
					$page = $row->filename;
				} else {
					redirect('',301);						
				}
				
			} else {
				redirect('',301);			
			}
			
			
		else :
			$this->data['pageTitle'] = 'Home';
			$this->data['pageNote'] = 'Welcome To Our Site';
			$this->data['breadcrumb'] = 'inactive';			
			$page = 'home';
		endif;	
			
		
		$this->data['content'] = $this->load->view('pages/'.$page,$this->data, true );		
    	$this->load->view($this->layout, $this->data );
		
	}

	function  submitcontact()
	{
	
		$rules = array(
			array('field'   => 'name','label'   => ' Please Fill Name','rules'   => 'required'),
			array('field'   => 'email','label'   => 'email ','rules'   => 'required|email'),
			array('field'   => 'message','label'   => 'message','rules'   => 'required'),
		);	


		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			
			$data = array(
				'name'=>$this->input->post('name',true),
				'email'=>$this->input->post('email',true),
				'subject'=> 'New Form Submission',
				'notes'=>$this->input->post('message',true)
			); 
			$message = $this->load->view('emails/contact', $data,true); 
			
			
			$to 		= 	CNF_EMAIL;
			$subject 	= 'New Form Submission';
			$headers  	= 'MIME-Version: 1.0' . "\r\n";
			$headers 	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers 	.= 'From: '.$this->input->post('name',true).' <'.$this->input->post('sender',true).'>' . "\r\n";
				//mail($to, $subject, $message, $headers);			
			$message = "Thank You , Your message has been sent !";
			$this->session->set_flashdata('message',SiteHelpers::alert('success',$message));
			redirect('contact-us',301);
			
				
		} else {
			$message = "The following errors occurred";
			$this->session->set_flashdata(array(
					'message'=>SiteHelpers::alert('error',$message),
					'errors'	=> validation_errors('<li>', '</li>')
			));
			redirect('contact-us',301);	
		}		
	}

	public function lang($lang)
	{

		$this->session->set_userdata('lang',$lang);	
		redirect($_SERVER['HTTP_REFERER']);  	
	}
        function  demo()
	{
             include 'BigBlueButton.php';
              $bbb = new BigBlueButton();
              
		$rules = array(
			array('field'   => 'name','label'   => ' Please Fill Name','rules'   => 'required'),
			array('field'   => 'Nghe','label'   => 'Người nghe'),
			array('field'   => 'Trinhbay','label'   => 'Người trình bày'),
		);	

                 
		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			
			$data = array(
				'name'=>$this->input->post('name',true),
				'Nghe'=>$this->input->post('email',true),
				'Trinhbay'=>$this->input->post('message',true)
			); 
			
                        $itsAllGood = true;
            try 
            {
                
               //$result = $bbb->getMeetingsWithXmlResponseArray();
               $result = $bbb->isMeetingRunningWithXmlResponseArray('1234');
                
//                $creationParams = array(
//                'meetingId' => '1234',			// REQUIRED
//                'meetingName' => 'Demo openmeeting',	// REQUIRED
//                'attendeePw' => 'ap',		// Match this value in getJoinMeetingURL() to join as attendee.
//                'moderatorPw' => 'mp',		// Match this value in getJoinMeetingURL() to join as moderator.
//                'welcomeMsg' => '',		// ''= use default. Change to customize.
//                'dialNumber' => '',		// The main number to call into. Optional.
//                'voiceBridge' => '12345',	// 5 digit PIN to join voice bridge.  Required.
//                'webVoice' => '',		// Alphanumeric to join voice. Optional.
//                'logoutUrl' => '',		// Default in bigbluebutton.properties. Optional.
//                'maxParticipants' => '-1',	// Optional. -1 = unlimitted. Not supported in BBB. [number]
//                'record' => 'false',		// New. 'true' will tell BBB to record the meeting.
//                'duration' => '0',		// Default = 0 which means no set duration in minutes. [number]
//                //'meta_category' => '',	// Use to pass additional info to BBB server. See API docs.
//        );
//                
            // $result = $bbb->createMeetingWithXmlResponseArray($creationParams);
                
                
            }
	catch (Exception $e) {
		echo 'Caught exception: ', $e->getMessage(), "\n";
                 $message = "Caught exception: ". $e->getMessage() ."\n";
			$this->session->set_flashdata('message',SiteHelpers::alert('error',$message));
			redirect('demo',301);
                        $itsAllGood = false;
	}

if ($itsAllGood == true) {
	// If it's all good, then we've interfaced with our BBB php api OK:
	if ($result == null) {
		// If we get a null response, then we're not getting any XML back from BBB.
		               
                        $message = "Failed to get any response. Maybe we can't contact the BBB server !";
			$this->session->set_flashdata('message',SiteHelpers::alert('error',$message));
			redirect('demo',301);
	}	
	else 
            { 
	// We got an XML response, so let's see what it says:
		if ($result['returncode'] == 'SUCCESS') {
			// Then do stuff ...
			
                         $message = "<p>We got some meeting info from BBB:</p>";
			$this->session->set_flashdata('message',SiteHelpers::alert('success',$message));
                        
                        print_r($result);
			//redirect('demo',301);
			
		}
		else {
			                       
                        $message = "<p>We didn't get a success response. Instead we got this:</p>";
			$this->session->set_flashdata('message',SiteHelpers::alert('error',$message));
                        //print_r($result);
			redirect('demo',301);
		}
	}
}
                        
			
			
				
		}
                else {
			$message = "The following errors occurred";
                        
			$this->session->set_flashdata(array(
					'message'=>SiteHelpers::alert('error',$message),
					'errors'	=> validation_errors('<li>', '</li>')
			));
			redirect('demo',301);	
		}		
	}
        

}

/* End of file welcome.php */
/* Location: ./application/controllers/page.php */ 