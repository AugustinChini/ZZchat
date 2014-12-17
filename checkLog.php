<?php
	
	//---Check if the login is correct---//
	function checkLog($log, $fil)
	{
		$result = 'err';
		//---if login isn't empty AND 'filière' is OK AND login size is between 2 and 15 character---//
		if(!empty($log) && !empty($fil) && isset($log) && isset($fil) && strlen($log) > 2 && strlen($log)< 15)
		{
			//---strip Forbidden Characters---//
			$log = stripForbiddenCharacters($log);
			$result = $log;
		}
		return ($result);
	}
	
	function stripForbiddenCharacters($str)
	{
		//---the forbidden characters are : [ ] ' " < > and other symobl which can be remplace by HTML symbols---//
		$str = str_replace("'", " ", $str);
		$str = str_replace('"', "", $str);
		$str = str_replace('[', "*", $str);
		$str = str_replace(']', "*", $str);
		$str = str_replace('<', "*", $str);
		$str = str_replace('>', "*", $str);
    	$str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    	$str = preg_replace('#&[^;]+;#', '', $str); 
    	return $str;
	}
?>