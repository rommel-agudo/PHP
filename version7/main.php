<?php
require_once 'siteFunctions/masterPage.php';

	$pg=new MasterPage();
	if ($pg->getMember()!=null) {
		header("location: memberPage.php");
	} else {
			
		$content='<p>Welcome to <strong>Agora</strong>.</p>';
		$content.='<p>Start by creating an account.</p>';
		$content.='<p>Login using <strong>username</strong> and <strong>password</strong>';


				   
		$pg->setTitle('Welcome and Instructions');
		$pg->setContent($content);
		print $pg->getHtml();
	}


