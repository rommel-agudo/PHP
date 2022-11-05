<?php

require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';
require_once 'models/business.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';
		
		$pg = new MasterPage();	
        $content = '';
		$db=$pg->getDB();	
        $business = $pg->getBusiness();
        $businessID = $business->getBusinessID();
        
        $findbusiness = "SELECT businessID, userName, businessName, emailAddress FROM business WHERE businessID = '$businessID'";
        $result = $db->query($findbusiness);


        if ($result->size()>0 ) {
            echo'hello';
            $businessDetails=new HtmlTable ($result);
            $content.=$businessDetails->getHtml( array (
                    'businessID'=>'Business ID', 
                    'userName'=>'User Name',
                    'businessName' => 'Business Name',
                    'emailAddress'=>'Email Address'));
                }
        $content.='<a href="addBuyerSeller.php">Edit your details here</a>';

        $buyers = $db-> query("select * from buyer ");
        $sellers = $db-> query("select * from seller ");

        $content.= "<br><br><h3>Below are your registered buyers and sellers</h3>";
      
        if ($buyers->size()>0 ) {
        $buyerTable=new HtmlTable ($buyers);
		$content.=$buyerTable->getHtml( array (
				'buyerID'=>'Buyer ID', 
				'givenName'=>'Given Name',
				'familyName'=>'Family Name'));
            }
        else
            $content.='<p>You have no buyers</p>';
        
        $content.= "<br>";
        if ($sellers->size()>0 ) {
        $sellerTable=new HtmlTable ($sellers);
		$content.=$sellerTable->getHtml( array (
				'sellerID'=>'Seller ID', 
				'givenName'=>'Given Name',
				'familyName'=>'Family Name'));
            }
        else
            $content.='<p>You have no sellers</p>';
            $content.='<a href="addBuyerSeller.php">Add Buyer/Seller Here</a>';

		$pg->setTitle('Welcome to the Business Page');
		$pg->setContent($content);
		print $pg->getHtml();
        