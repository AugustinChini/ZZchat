<?php
require_once('autoLogOut.php');

class userLogTest extends PHPunit_Framework_Testcase {

	public function testAddUser()
	{
		$log = "user";
		$fil = "f5";
		$XMLfile = './tests/testFiles/xmlTestFile.xml';
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		$root = $xml->getElementsByTagName("root")->item(0);
		
		$currentSize = getSize($xml);
	
		$user = cElement($xml, "user", $root);
		AddValue($xml, $log, $user);
		
		$XMLfil = cElement($xml, "fil", $root);
		AddValue($xml, "$fil", $XMLfil);
		
		$size = $xml->getElementsByTagName("size")->item(0);
		$currentSize++;
		$size->firstChild->nodeValue = $currentSize;
		
		$this->assertEquals($size->firstChild->nodeValue, 1);
		
		$user = $xml->getElementsByTagName("user")->item(0);
		$this->assertEquals($user->firstChild->nodeValue, "user");
		
		$xml->formatOutput=true;
		$xml->save($XMLfile);
		
	}
	
	public function testDeleteUser()
	{
		$XMLfile = './tests/testFiles/xmlTestFile.xml';
		
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		
		logOut("user", $XMLfile);
		
		$user = $xml->getElementsByTagName("user")->item(0);
		
		$resBool = true;
		if($user->firstChild->nodeValue == "user")
			$resBool = false;
		
		$this->assertEquals($resBool, false);
		
	}
	
    public function testDeleteUserInEmptyXmlFile()
	{
		$XMLfile = './tests/testFiles/xmlTestFile.xml';
		
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		
		logOut("user", $XMLfile);
		
		$user = $xml->getElementsByTagName("user")->item(0);
		
		$size = getSize($xml);
		
		$this->assertEquals($size, 0);
		
		$this->assertEquals($user, null);
		
		
		
    }
	
	
}
?>
