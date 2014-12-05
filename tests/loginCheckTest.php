<?php
include('../checkLog.php');
class ProceduralTest extends PHPunit_Framework_Testcase {
    public function testEmptylog(){
        $result = checkLog('','f1');
        $this->assertEquals('err', $result);
    }
	public function testEmptyFil(){
        $result = checkLog('user1','');
        $this->assertEquals('err', $result);
    }
	public function testShortLog(){
        $result = checkLog('us','f5');
        $this->assertEquals('err', $result);
    }
	public function testLongLog(){
        $result = checkLog('user who have a too long longin','f5');
        $this->assertEquals('err', $result);
    }
	public function testquotes(){
		$log = '"user1"';
        $result = checkLog($log,'f5');
		$findme   = '"';
        $this->assertEquals(strpos($log, $findme), false);
		$log = "'user1'";
        $result = checkLog($log,'f5');
		$findme   = "'";
        $this->assertEquals(strpos($log, $findme), false);
    }
	public function testAllRight(){
		$log = 'user1';
        $result = checkLog($log,'f5');
        $this->assertEquals(stripForbiddenCharacters($log), $result);
    }
}
?>