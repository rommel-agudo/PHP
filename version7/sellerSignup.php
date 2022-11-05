<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';
require_once 'siteFunctions/sellerPage.php';
require_once 'models/seller.php';
	
	$error = null;
	$pg=new SellerPage();
	$db = $pg->getDB();
	$method = $_SERVER['REQUEST_METHOD'];//asking what the method

	if ($method == "POST"){
		// receive all input values from the form
		$username = $_POST['userName'];
		$password =$_POST['passwordHash'];

		$find = "SELECT userName FROM seller WHERE userName = '$username'";
		
		$result = $db ->query($find);

		if ($result->size()> 0) {
			$error.='Please enter a different username.';
		} else {
			$sql =  "INSERT INTO seller(userName, passwordHash) 
			VALUES('$username', '$password')";
			$db ->query($sql);
			
		}


	}
	$login=new HtmlTemplate('sellerSignup.html');
	$content=$login->getHtml(array());	
	if ($error!=null) {
		$content.='<br/><br/><p>'.$error.'<p><br/>';
	}

	$pg->setTitle('Seller Sign up');
	$pg->setContent($content);
	print $pg->getHtml();



