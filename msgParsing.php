<?php
function parseText($texte)
	{
		//Smileys
		$texte = str_replace(':)', '<img src="pictures/smily.png" title="smiley" alt="smiley" />', $texte);
		$texte = str_replace(':p', '<img src="pictures/tongue.png" title="smiley" alt="smiley" />', $texte);
		$texte = str_replace(';)', '<img src="pictures/wink.png" title="smiley" alt="smiley" />', $texte);
		$texte = str_replace(':(', '<img src="pictures/sad.png" title="smiley" alt="smiley" />', $texte);
		$texte = str_replace('<3', '<img src="pictures/heart.png" title="smiley" alt="smiley" />', $texte);
		$texte = str_replace('ZZ', '<img src="pictures/ZZ.png" title="smiley" alt="smiley" />', $texte);
		
		//bold
		$texte = preg_replace('`\[g\](.+)\[/g\]`isU', '<b>$1</b>', $texte); 
		//italic
		$texte = preg_replace('`\[i\](.+)\[/i\]`isU', '<i>$1</i>', $texte);
		//underline
		$texte = preg_replace('`\[s\](.+)\[/s\]`isU', '<u>$1</u>', $texte);
		//color
		$texte = preg_replace('`\[black\](.+)\[/black\]`isU', '<font color = "black">$1</font>', $texte);
		$texte = preg_replace('`\[blue\](.+)\[/blue\]`isU', '<font color = "blue">$1</font>', $texte);
		$texte = preg_replace('`\[green\](.+)\[/green\]`isU', '<font color = "green">$1</font>', $texte);
		$texte = preg_replace('`\[red\](.+)\[/red\]`isU', '<font color = "red">$1</font>', $texte);
		$texte = preg_replace('`\[pink\](.+)\[/pink\]`isU', '<font color = "pink">$1</font>', $texte);

		return $texte;
	}
?>