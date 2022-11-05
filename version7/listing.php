<?php
require_once 'framework/htmlTemplate.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';

	$error = null;
	$pg=new masterPage();
	$db = $pg->getDB();
	$method = $_SERVER['REQUEST_METHOD'];//asking what the method
	if ($method == "POST"){
		// receive all input values from the form
		$productName = $_POST['productName'];
		$productDetails =$_POST['productDetails'];
		$price=$_POST['price'];


		if($productName != "" || $productDetails !="" || $price != ""){
			$sql =  "INSERT INTO products(productName, productDetails, price) 
			VALUES('$productName', '$productDetails','$price')";
			$db ->query($sql);
		}
		else {
			$error.= "Please enter all information!";
		}

	}
	$login=new HtmlTemplate('listing.html');
	$content=$login->getHtml(array());	
	if ($error!=null) {
		$content.='<br/><br/><p>'.$error.'<p><br/>';
	}

	$pg->setTitle('List a product');
	$pg->setContent($content);
	print $pg->getHtml();



