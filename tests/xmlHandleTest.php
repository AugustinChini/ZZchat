<?php
include('XMLHandling.php');
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
		
		$this->resetFiles();
		
    }
}
?>
