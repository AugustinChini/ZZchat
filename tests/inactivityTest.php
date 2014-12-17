<?php
require_once('autoLogOut.php');

class userInnactivityTest extends PHPunit_Framework_Testcase {
	
	public function resetFiles()
	{
		echo (PHP_EOL.' Reset test file.....');
		$XMLfile = 'SettingFiles/chatRoom.xml';
		$XMLfileVierge = './tests/testFiles/xmlTestFileVierge.xml';
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfileVierge);
		$xml->formatOutput=true;
		$xml->save($XMLfile);
		
		echo (PHP_EOL.' Reset test file.....');
		$XMLfile = 'SettingFiles/userSettings.xml';
		$XMLfileVierge = './tests/testFiles/xmlTestFileVierge.xml';
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfileVierge);
		$xml->formatOutput=true;
		$xml->save($XMLfile);
	}

	public function testTimeLapse()
	{
		$min = date('i');
		
		if($min > 50)
		{
			$min = 60 - $min;
		}
		
		$val = $min + 11;

		$this->assertEquals(timeLapse($val), true);
		
	}

	public function testGetMinutes()
	{
		$this->resetFiles();
		$min = date('i');
		$XMLfile = 'SettingFiles/chatRoom.xml';
		$min10 = $min;
		$min5 = $min;
		if(($min - 10) < 0)
		{
			$min10 = (60 - ($min - 10));
		}
		if(($min - 5) < 0)
		{
			$min5 = (60 - ($min - 5));
		}
		addMsg("msg", "17-12-2014 ".date('H').":". $min10, "testUser", $XMLfile);
		addMsg("msg", "17-12-2014 ".date('H').":". $min5, "testUser", $XMLfile);
		addMsg("msg", "17-12-2014 ".date('H').":". $min, "testUser", $XMLfile);
		
		$res = getMin("testUser");
		
		echo($res);
		echo($min);
		
		
		$this->assertEquals($res, $min.' ');
		
		$this->resetFiles();
		
	}
	
	public function testUserAutoLogOut()
	{
		$min = date('i');
		$XMLfile = 'SettingFiles/chatRoom.xml';
		//---Check if the deleyed minute is not negative---//
		if(($min - 15) < 0)
		{
			$min = (60 - ($min - 15));
		}
		else
		{
			$min = ($min - 15);
		}
		
		//---Add the old msg---//
		addMsg("msg", "17-12-2014 ".date('H').":". $min, "testUser", $XMLfile);
		
		//---Add User who posted the old msg---//
		$log = "testUser";
		$fil = "f5";
		
		$XMLfile = 'SettingFiles/userSettings.xml';
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
		
		$xml->formatOutput=true;
		$xml->save($XMLfile);
		
		//---Add User end---//
		
		//---run the check inactivity function---//
		testInactivity();
		
		
		$XMLfile = 'SettingFiles/userSettings.xml';
		
		$xml = new DOMDocument("1.0");
		$xml -> load($XMLfile);
		
		//---Catch the empty node (because the user should be delected)---//
		$user = $xml->getElementsByTagName("user")->item(0);
		
		$size = getSize($xml);
		
		//---Check if the size is correct (not negative)---//
		$this->assertEquals($size, 0);
		
		//---Check if the node is empty (it mean that the user was well disconect)---//
		$this->assertEquals($user, null);
		
		$this->resetFiles();
	}
}
?>
