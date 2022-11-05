<?php

require_once 'framework/htmlTemplate.php';
require_once 'framework/htmlTable.php';
require_once 'siteFunctions/commonFunctions.php';
require_once 'siteFunctions/masterPage.php';

		
		$pg = new masterpage();	
        $content = '';
        $content.= "<p>Welcome to the buyer page</p>";



		$pg->setTitle('Buyer Page');
		$pg->setContent($content);
		print $pg->getHtml();
        