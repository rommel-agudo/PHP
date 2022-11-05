<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';
require_once 'siteFunctions/sellerPage.php';

	
	$error = null;
	$pg=new MasterPage();
	$db = $pg->getDB();
	$method = $_SERVER['REQUEST_METHOD'];//asking what the method

	if ($method == "POST")
    {
		// receive all input values from the form
		$username = $_POST['userName'];
		$role =$_POST['role'];
        $business = $pg->getBusiness();
        $businessID = $business->getBusinessID();
     
        if($role == 'buyer'){
            $sql = "UPDATE buyer SET businessID = '$businessID' WHERE userName = '$username'";
            $db ->query($sql);
        
        }

        else if($role == 'seller'){
            $sql = "UPDATE seller SET businessID = '$businessID' WHERE userName = '$username'";
            $db ->query($sql);
        
        }

        else{
            $error.='Cannot find username';
        }

 
    }
	$login=new HtmlTemplate('addBuyerSeller.html');
	$content=$login->getHtml(array());	
	if ($error!=null) {
		$content.='<br/><br/><p>'.$error.'<p><br/>';
	
    }
	$pg->setTitle('Add Buyer/Seller');
	$pg->setContent($content);
	print $pg->getHtml();



