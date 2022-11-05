<?php
include_once ("framework/MySQLDB.php");

function getConnection() {
	$host = 'localhost' ;
	$dbUser ='root';
	$dbPass ='';
	$dbName ='agora';

    // create a new database object and connect to server
	$db = new MySQL($host, $dbUser, $dbPass, $dbName);
	return $db; 	
}

function getNewDatabase() {
  
    // create a new database object and connect to server
	$db = getConnection();
	
	//  drop the database and then create it again
	try {
		$db->dropDatabase();
	} catch (exception $ex) {
	}
	
	$db->createDatabase();

	// select the database
	$db->selectDatabase();
	return $db;
}

function getDatabase() {
  
	$db = getConnection();
	$db->selectDatabase();
	return $db;
}

// gets a parameter from the URL, or null if not specified
function getFromURL ($key) {
	if (isset($_GET[$key])) {
		return $_GET[$key];
	}
	return null;
}

function sqlSafe ($input) {
	$link = mysqli_connect('localhost', 'root', '', 'agora');
	return mysqli_real_escape_string($link, stripslashes($input));
}

function getBuyerID ($userName, $password) {
	$s='muchsaltiness';
	$u = sqlSafe($userName);
	$p = sqlSafe($password);
	//$h = hash('sha256',$p.$s);
	$db=getDatabase();
	$sql="select buyerID, passwordHash from buyer where userName='$u'";
	$result=$db->query($sql);
	if ($result->size()==1) {
		$row=$result->fetch();
		//$hash=$row['passwordHash'];
		$id=$row['buyerID'];
		//if ($h==$hash){
			return $id;
		//}
		//if ($hash==null||$hash=="") {
			//$result=$db->query("UPDATE members SET passwordHash='$h' WHERE memberID=$id");
			//return $id;
	//	}
	}
	return null;
}


function getBusinessID ($userName, $password) {
	$s='muchsaltiness';
	$u = sqlSafe($userName);
	$p = sqlSafe($password);
	//$h = hash('sha256',$p.$s);
	$db=getDatabase();
	$sql="select businessID, passwordHash from business where userName='$u'";
	$result=$db->query($sql);
	if ($result->size()==1) {
		$row=$result->fetch();
		$hash=$row['passwordHash'];
		$id=$row['businessID'];
		if ($p==$hash){
			return $id;
		}
		//if ($hash==null||$hash=="") {
			//$result=$db->query("UPDATE members SET passwordHash='$h' WHERE memberID=$id");
			//return $id;
	//	}
	}
	return null;
}


function getSellerID ($userName, $password) {
	$s='muchsaltiness';
	$u = sqlSafe($userName);
	$p = sqlSafe($password);
	//$h = hash('sha256',$p.$s);
	$db=getDatabase();
	$sql="select sellerID, passwordHash from seller where userName='$u'";
	$result=$db->query($sql);
	if ($result->size()==1) {
		$row=$result->fetch();
		//$hash=$row['passwordHash'];
		$id=$row['sellerID'];
		//if ($h==$hash){
			return $id;
		//}
		//if ($hash==null||$hash=="") {
			//$result=$db->query("UPDATE members SET passwordHash='$h' WHERE memberID=$id");
			//return $id;
	//	}
	}
	return null;
}

