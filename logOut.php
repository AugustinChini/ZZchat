<?php

	$log = $_GET["log"];
	$fichier = 'SettingFiles/userSettings.txt';
	$i = 0;
	$bool = 0;
	$fp = fopen($fichier, 'r+');
	$ligne = fgets($fp,500);
	$ArrayFile = file('SettingFiles/userSettings.txt');
	while (!feof($fp) && $bool == 0){
		$liste = explode(';',$ligne);
		$ligne = fgets($fp,500);
		if($liste[0] == $log)
		{
			$bool = 1;
		}
		else
		{
			$i++;
			
		}
	}
	
	$deleteLigne = $i;
	$numFileLine = count($ArrayFile);
	for($i = 0; $i< $numFileLine; ++$i)
	{
	   if (($ArrayFile[$i]) == $ArrayFile[$deleteLigne])
	   {
	 		unset($ArrayFile[$i]);
	   }
	}
	$fileRecord = implode('', $ArrayFile);
	file_put_contents('SettingFiles/userSettings.txt', $fileRecord);
	header("location:index.php");
?> 