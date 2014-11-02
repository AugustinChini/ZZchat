<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Bienvenu sur le ZZchat</title>
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <link rel="shortcut icon" type="image/jpg" href="pictures/favicon.jpg" />
        <script type="text/javascript" src="script/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="script/jquery-ui-1.10.0.custom.js"></script>
		<script type="text/javascript" src="script/script.js"></script>
		<script type="text/javascript" src="script/jquery.fittext.js"></script>
		<script type="text/javascript" src="script/language.js"></script>
    </head>
    <body>
    <div id="lang"><img alt="English language" onclick="langChange('index', 'EN')" src="pictures/en.jpg" /> <img alt="Langage Francais" onclick="langChange('index', 'FR')"  src="pictures/fr.jpg" /></div>
    <div id="loginBlock">
    	<img alt="logo ZZChat" src="pictures/logo.png" />
    	<form id="loginFrom" name="form" action="processing.php?lang=FR" method="post">
			<p>
            	<p><div id="logTxt">Pseudo  :</div>
                	<?php
						$cookie_name = "ZZchat";
						if(isset($_COOKIE[$cookie_name])) {
							$liste = explode(';',$_COOKIE[$cookie_name]);
							echo "<input id='logInput' size='20' type='text' name='login' value='" . $liste[0] . "'/></p>";
						} else {
							echo "<input id='logInput' size='20' type='text' name='login'/></p>";
						}
                    ?> 
                <input style="margin-left: 95px; margin-top: -36px;" type="checkbox" name="cookie" value="true" /><p id="cookieTxt" style="margin-top:7px; font-size:13px;"> Se souvenir de moi</p>
                
            </p>
            <p>
    		   <div id="filTxt">Représentez votre filière :</div><br />
    		   <input type="radio" name="fil" value="f1" <?php if(isset($liste) && $liste[1] == "f1"){echo 'checked="checked"';} ?> id="f1id" > <label for="f1"/><img alt="logo F1" src="pictures/f1.jpg"/></label>
    		   <input type="radio" name="fil" value="f2" <?php if(isset($liste) && $liste[1] == "f2"){echo 'checked="checked"';} ?> id="f2id" /> <label for="f2"><img alt="logo F1" src="pictures/f2.jpg"/></label>
               <input type="radio" name="fil" value="f3" <?php if(isset($liste) && $liste[1] == "f3"){echo 'checked="checked"';} ?> id="f3id" /> <label for="f3"><img alt="logo F1" src="pictures/f3.jpg"/></label><br />
               <input type="radio" name="fil" value="f4" <?php if(isset($liste) && $liste[1] == "f4"){echo 'checked="checked"';} ?> id="f4id" /> <label for="f4"><img alt="logo F1" src="pictures/f4.jpg"/></label>
               <input type="radio" name="fil" value="f5" <?php if(isset($liste) && $liste[1] == "f5"){echo 'checked="checked"';} ?> id="f5id" /> <label for="f5"><img alt="logo F1" src="pictures/f5.jpg"/></label>
               <input type="radio" name="fil" value="other" <?php if(isset($liste) && $liste[1] == "other"){echo 'checked="checked"';} ?> id="otherid" /> <label for="other"><img alt="logo F1" src="pictures/other.jpg"/></label>
               <center id="otherTxt" style="margin-top: 5px; font-size:9px;">(Other pour les invités)</center>
   			</p>
			<p>
				<input id="submitFrom" type="submit" value="Connexion"/>
				<input id="resetFrom" type='reset' value='Annuler'/>
			</p>
		</form>
    </div>
    <div id="verticalBlock"></div>
    </body>
</html>
