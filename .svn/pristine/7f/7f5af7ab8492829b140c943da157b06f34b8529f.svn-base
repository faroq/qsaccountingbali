<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    var $params;
	
    public function __construct() {
        
		parent::__construct();
								
        if (!$this->my_auth->logged_in() AND $this->uri->uri_string() != 'auth/login') {
        	// user not logged in
			if( ! $this->input->is_ajax_request()){
				// if not ajax request
				// send back to login page
				redirect(site_url('auth/login'));			
			}else{
				// if ajax request
				// return json message
				echo '{"success":false,"errMsg":"Session Expired"}';
				exit;				
			}
        }else{
        	// user logged in			
			// get menu
        }
    }

		
}
