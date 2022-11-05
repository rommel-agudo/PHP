<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';
require_once 'siteFunctions/sellerPage.php';
require_once 'models/seller.php';
	
	$error = null;
	$pg=new MasterPage();
	$db = $pg->getDB();
	$method = $_SERVER['REQUEST_METHOD'];//asking what the method

	if ($method == "POST"){
		// receive all input values from the form
		$username = $_POST['userName'];
		$role =$_POST['role'];

        $find = "SELECT userName FROM $role WHERE userName = '$username'";
        $result = $db->query($find);

        if ($result->size()>= 1) {
            if ($role == 'buyer') {
                $sql = "DELETE FROM buyer WHERE userName = '$username'";
                $db ->query($sql);
            }
    
            else{
                $sql = "DELETE FROM seller WHERE userName = '$username'";
                $db ->query($sql);
            }
		} 
        
        else {
            $error='Please enter a different username.';
        }
    
    } 
           
	$login=new HtmlTemplate('deleteBuyerSeller.html');
	$content=$login->getHtml(array());	
	if ($error!=null) {
		$content.='<br/><br/><p>'.$error.'<p><br/>';
	}

	$pg->setTitle('Delete Buyer/Seller');
	$pg->setContent($content);
	print $pg->getHtml();



