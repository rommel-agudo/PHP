<?php

require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/sellerPage.php';
require_once 'models/seller.php';
		
		$pg = new sellerpage();	
        $content = '';
        $content.= "<p>Welcome to the seller page</p>";


        $content.='<a href="listing.php">List Products Here</a>';

		$pg->setTitle('Seller Page');
		$pg->setContent($content);
		print $pg->getHtml();
        