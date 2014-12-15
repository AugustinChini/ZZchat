<?php

class msgParsingTest extends PHPunit_Framework_Testcase {
	
    public function testSmiley(){
		$string = "some text :) end of text";
		$stringParsed = 'some text <img src="pictures/smily.png" title="smiley" alt="smiley" /> end of text';
		$string = parseText($string);
		$this->assertEquals($string, $stringParsed);
		
    }
	
    public function testTextUnderline(){
		$string = "[s]some text end of text[/s]";
		$stringParsed = "<u>some text end of text</u>";
		$string = parseText($string);
		$this->assertEquals($string, $stringParsed);
    }
	
	
    public function testTextColor(){
		$string = "[black]some text end of text[/black]";
		$stringParsed = '<font color = "black">some text end of text</font>';
		$string = parseText($string);
		$this->assertEquals($string, $stringParsed);
		
    }
	
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
	
}
?>
