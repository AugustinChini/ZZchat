<?php
include('AjaxAddMsg.php');
class XMLHandlingTest extends PHPunit_Framework_Testcase {

	public function resetFiles()
	{
		echo (PHP_EOL.' Reset test file.....');
		$XMLfile = './tests/testFiles/xmlTestFile.xml';
		$XMLfileVierge = './tests/testFiles/xmlTestFileVierge.xml';
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfileVierge);
		$xml->formatOutput=true;
		$xml->save($XMLfile);
	}
	
    public function testCreateChild(){
		$XMLfile = './tests/testFiles/xmlTestFile.xml';
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		
		$root = $xml->getElementsByTagName("root")->item(0);
		
		$info = cElement($xml, "info", $root);
		
		$xpath = new DOMXpath($xml);

		$NodeList = $xpath->query('/root/info');
		
		$nb = $NodeList->length;
		
		
		$xml->formatOutput=true;
		$xml->save($XMLfile);
		
		
		
		$this->assertEquals($nb, 1);
		
		$this->resetFiles();
		
    }
	
	public function testAddValue(){
		$XMLfile = './tests/testFiles/xmlTestFile.xml';
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		
		$root = $xml->getElementsByTagName("root")->item(0);
		
		
		$data = "test";
		
		$info = cElement($xml, "info", $root);
		AddValue($xml, $data, $info);
		
		$info = $xml->getElementsByTagName("info")->item(0);
		$value = $info->firstChild->nodeValue;
		
		$xml->formatOutput=true;
		$xml->save($XMLfile);
		
		
		
		$this->assertEquals($value, "test");
		
    }
	
	public function testRemoveValue(){
		$XMLfile = './tests/testFiles/xmlTestFile.xml';
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		
		$root = $xml->getElementsByTagName("root")->item(0);
		
		$info = $xml->getElementsByTagName("info")->item(0);
		removeValue($info, $root);
		
		$xml->formatOutput=true;
		$xml->save($XMLfile);
		
		$xpath = new DOMXpath($xml);

		$NodeList = $xpath->query('/root/info');
		
		$nb = $NodeList->length;
		
		$this->assertEquals($nb, 0);
	
    }
	
	public function testGetSize(){
		$XMLfile = './tests/testFiles/xmlTestFile.xml';
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		
		$size = getSize($xml);
		
		$this->assertEquals($size, 0);
		
		//---test the getSize function after a modification of the nodeValue---//
		$sizeValue = 10;
		
		$size = $xml->getElementsByTagName("size")->item(0);
		$size->firstChild->nodeValue = $sizeValue;
		
		$getSize = getSize($xml);
		
		$this->assertEquals($sizeValue, $getSize);
		
		$this->resetFiles();
    }
	
	public function testAddMsg(){
		$XMLfile = './tests/testFiles/xmlTestFile.xml';
		$msgPost = "test";
		$date = date("l F d, Y");
		$user = "test";
	
		addMsg($msgPost, $date, $user, $XMLfile);
		
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		
		$size = getSize($xml);
		
		$this->assertEquals($size, 1);

		$msg = $xml->getElementsByTagName("msg")->item(0);
		$value = $msg->firstChild->nodeValue;
		
		$this->assertEquals($value, "<![CDATA[".$msgPost."]]>");
		
		$info = $xml->getElementsByTagName("info")->item(0);
		$value = $info->firstChild->nodeValue;
		

		
		$this->assertEquals($value, "- ".$msgPost." ".$date." :");
		
		$this->resetFiles();
    }
	
	
}
?>
