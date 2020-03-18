<?php
class Product extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('product_model');
		 $this->load->library('form_validation'); 
	}
	function index(){
		$this->load->view('product_view');
	}

	function getuserlist(){
		$getuserdata=$this->product_model->getdata("users");
		$html='';
		$i=1;
		$data='';
		if($getuserdata){
		foreach($getuserdata as $data){

			
            $html .= '<tr>'.
                    '<td>'.$i.'</td>
                    <td>'.$data->first_name.'</td>
                    <td>'.$data->last_name.'</td>
                    <td>'.$data->email.'</td>
                    <td>'.$data->phone.'</td>
                    <td>'.$data->gender.'</td>
                    <td>'.$data->hobies.'</td>
                    <td><img src='.base_url('assets/upload/'.$data->image).' width="100px" hight="100px"></td>
                    <td>'.$data->created.'</td>
                   <td style="text-align:right;">'.
                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-first_name="'.$data->first_name.'" data-last_name="'.$data->last_name.'" data-email="'.$data->email.'"  data-phone="'.$data->phone.'"  data-gender="'.$data->gender.'"  data-hobies="'.$data->hobies.'"  data-image="'.$data->image.'"  data-id="'.$data->id.'">Edit</a>'.' '.
                        '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-deleteid="'.$data->id.'">Delete</a>'.
                    '</td>'.
                    '</tr>';
                    $i++;
                    }
                    $data=$html;
             }else{
             	$data='';
             }
		echo json_encode($data);
	}

	function save(){
		
            $this->form_validation->set_rules('first_name', 'First Name', 'required'); 
            $this->form_validation->set_rules('last_name', 'Last Name', 'required'); 
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required'); 
            $this->form_validation->set_rules('password', 'password', 'required'); 
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]'); 
 
  
            if($this->form_validation->run() == true){ 
                /*for image uploade*/
                $uploadPath = 'assets/upload/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png';
                
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                // Upload file to server
                if($this->upload->do_upload('image')){
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $uploadData['file_name'] = $fileData['file_name'];
                    $file_name=$fileData['file_name'];
                    $file_name=str_replace(' ', '-',$uploadData['file_name']); 

                }
                /*end image uploade*/
                $hobies=implode(',', $this->input->post('hobies'));
                $postData = array( 
                'first_name' => strip_tags($this->input->post('first_name')), 
                'last_name' => strip_tags($this->input->post('last_name')), 
                'email' => strip_tags($this->input->post('email')), 
                'password' => md5($this->input->post('password')), 
                'hobies' => strip_tags($hobies), 
                'gender' => strip_tags($this->input->post('gender')), 
                'image' => strip_tags($file_name),
                'phone' => strip_tags($this->input->post('phone')) 
            ); 

                $insert = $this->product_model->insert('users',$postData); 
                if($insert){ 
                   
                     $data['success'] = 'Your account created successfully'; 
                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                } 
            }else{ 
                $data['error_msg'] = validation_errors(); 
            } 
        

		//$data=$this->product_model->save_product();
		echo json_encode($data);
	}

	function update(){
		

		 $this->form_validation->set_rules('first_name', 'First Name', 'required'); 
            $this->form_validation->set_rules('last_name', 'Last Name', 'required'); 
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required'); 
           
 
  
            if($this->form_validation->run() == true){ 
                if($_FILES['image']!=''){
                /*for image uploade*/
                $uploadPath = 'assets/upload/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png';
                
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                // Upload file to server
                if($this->upload->do_upload('image')){
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $uploadData['file_name'] = $fileData['file_name'];
                    $file_name=$fileData['file_name'];
                    $file_name=str_replace(' ', '-',$uploadData['file_name']); 

                }
                /*end image uploade*/
                }else{
                    $file_name=strip_tags($this->input->post('imghidden'));
                }
                $hobies=implode(',', $this->input->post('hobies'));
                $postData = array( 
                'first_name' => strip_tags($this->input->post('first_name')), 
                'last_name' => strip_tags($this->input->post('last_name')), 
                'email' => strip_tags($this->input->post('email')), 
                'password' => md5($this->input->post('password')), 
                'hobies' => strip_tags($hobies), 
                'gender' => strip_tags($this->input->post('gender')), 
                'image' => strip_tags($file_name),
                'phone' => strip_tags($this->input->post('phone')) 
            ); 
                $cond= array('id'=>$this->input->post('id'));
                $update = $this->product_model->updatesingleconddata('users',$postData,$cond); 
                if($update){ 
                    //$this->session->set_userdata('success_msg', 'Your account data has been updated successful.'); 
                    //redirect('users/login'); 
                     $data['success'] = 'Your account data has been updated successfully'; 
                }else{ 
                    $data['error_msg'] = 'Some problems occured, please try again.'; 
                } 
            }else{ 
                $data['error_msg'] = validation_errors(); 
            } 
        

        //$data=$this->product_model->save_product();
        echo json_encode($data);
	}

	function delete(){
		 $cond= array('id'=>$this->input->post('id'));
         
         $delete = $this->product_model->delete_data('users',$cond); 
                if($delete){ 
                    $data['success'] = 'Your account data has been deleted successfully';
                }else{
                    $data['error_msg'] = 'Your account data has been deleted successfully';
                }
		echo json_encode($data);
	}

}