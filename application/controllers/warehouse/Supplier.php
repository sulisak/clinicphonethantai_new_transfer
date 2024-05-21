<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends MY_Controller {


 public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('warehouse/supplier_model');

     if(!isset($_SESSION['owner_id'])){
            header( "location: ".$this->base_url );
        }
        
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		

$data['tab'] = 'supplier';
$data['title'] = 'Supplier';
		$this->warehouselayout('warehouse/supplier',$data);
}





 function Add()
    {
 
if(!isset($_POST['supplier_code']) || $_POST['supplier_code']==''){
exit();
}  
if(isset($_FILES["supplier_image"]["name"]) && $_FILES["supplier_image"]["name"] != ''){

if(!file_exists("pic/supplier_image/".$_SESSION['owner_id'])){
	mkdir("pic/supplier_image/".$_SESSION['owner_id'],0777,true);
}

    $upload = move_uploaded_file($_FILES["supplier_image"]["tmp_name"],"pic/supplier_image/".$_SESSION['owner_id']."/".time().md5($_FILES["supplier_image"]["name"]).'.jpg');

    $data['supplier_image'] = 'pic/supplier_image/'.$_SESSION['owner_id'].'/'.time().md5($_FILES["supplier_image"]["name"]).'.jpg';

}else{
$data['supplier_image'] = '';
}

$data['supplier_code'] =  $_POST['supplier_code'];
$data['supplier_name'] = $_POST['supplier_name'];
$data['supplier_card_tax'] = $_POST['supplier_card_tax'];
$data['supplier_bd'] = $_POST['supplier_bd'];
$data['supplier_address'] = $_POST['supplier_address'];
$data['supplier_tel'] = $_POST['supplier_tel'];



		$success = $this->supplier_model->Add($data);
      
}



 function Update()
    {
 
if(!isset($_POST['supplier_code']) || $_POST['supplier_code']==''){
exit();
}  
if(isset($_FILES["supplier_image"]["name"]) && $_FILES["supplier_image"]["name"] != ''){

if(!file_exists("pic/supplier_image/".$_SESSION['owner_id'])){
	mkdir("pic/supplier_image/".$_SESSION['owner_id'],0777,true);
}

    $upload = move_uploaded_file($_FILES["supplier_image"]["tmp_name"],"pic/supplier_image/".$_SESSION['owner_id']."/".time().md5($_FILES["supplier_image"]["name"]).'.jpg');

    $data['supplier_image'] = 'pic/supplier_image/'.$_SESSION['owner_id'].'/'.time().md5($_FILES["supplier_image"]["name"]).'.jpg';

}else{
 $data['supplier_image']  = $_POST['supplier_image2'];
}

$data['supplier_id'] =  $_POST['supplier_id'];
$data['supplier_code'] =  $_POST['supplier_code'];
$data['supplier_name'] = $_POST['supplier_name'];
$data['supplier_card_tax'] = $_POST['supplier_card_tax'];
$data['supplier_bd'] = $_POST['supplier_bd'];
$data['supplier_address'] = $_POST['supplier_address'];
$data['supplier_tel'] = $_POST['supplier_tel'];
	

		$success = $this->supplier_model->Update($data);
      
}



    function Get()
    {


$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}
echo  $this->supplier_model->Get($data);

}


 function Getlist()
    {


echo  $this->supplier_model->Getlist();

}



	

   function Updaterank()
    {
 
$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}

$this->supplier_model->Updaterank($data);


}




    function Delete()
    {
 
$data = json_decode(file_get_contents("php://input"),true);
if(!isset($data)){
exit();
}

$success = $this->supplier_model->Delete($data);
      if($success){
      	return true;
      }else{
      	return false;
      }

}





	}

