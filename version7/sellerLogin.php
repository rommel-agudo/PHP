<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';

	$pg=new masterPage();
	$method=$_SERVER['REQUEST_METHOD'] ;
	$error=null;

	
	if ($method=='POST') {
		$userName=$_POST['userName'];
		$password=$_POST['password'];
	
		$sellerID=getSellerID($userName,$password);
		if ($sellerID==null) {
			$error='Your login credentials were rejected, please try again.';
		} else {
			$_SESSION['sellerID']=$sellerID;
			header('Location: sellerPage.php');//."?member=$memberID");
			exit;
		}
	}

	$login=new HtmlTemplate('sellerLogin.html');
	$content=$login->getHtml(array());	
	if ($error!=null) {
		$content.='<br/><br/><p>'.$error.'<p><br/>';
	}

	$pg->setTitle('Log in for sellers');
	$pg->setContent($content);
	print $pg->getHtml();


