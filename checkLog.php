<?php
	function checkLog($log, $fil)
	{
		$result = 'err';
		if(!empty($log) && !empty($fil) && isset($log) && isset($fil) && strlen($log) > 2 && strlen($log)< 15)
		{
			$log = stripForbiddenCharacters($log);
			$result = $log;
		}
		return ($result);
	}
	
	function stripForbiddenCharacters($str)
	{
		$str = str_replace("'", " ", $str);
		$str = str_replace('"', "", $str);
    	$str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    	$str = preg_replace('#&[^;]+;#', '', $str); 
    	return $str;
	}
?>