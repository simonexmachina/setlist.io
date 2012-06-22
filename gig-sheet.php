<?php
define('NL', "<br/>\n");

class GigSheet {

	function printRig() {
		return;
		echo "<div id=\"rig\" class=\"group\">\n";
		echo $this->getDevice('Fender Bassman', '5,7.5,4,,8,7,5,4.5,,8', true, false, true);
		echo $this->getDevice('Rat', 'Switch right,10.5,10.5,12');
		echo $this->getDevice('OD-3', '10.5,1.5,12');
		echo $this->getDevice('OD-3 (low-gain)', '12,1.5,7');
		echo $this->getDevice('OD-3 (high-gain)', '12,1.5,1.5');
		// echo $this->getDevice('Rat G&L', 'Switch left,12,10.5,12');
		// echo $this->getDevice('OD-3 G&L', '9,1.5,12');
		echo "</div>\n";
	}

	function getDevice( $name, $set-list, $clearing = true, $spacer = true, $numbers = false ) {
		if( !is_array($set-list) ) {
			$set-list = explode(',', $set-list);
		}
		$id = string_toCamelCase($name);
		$rv = "\t<div id=\"$id\" class=\"device";
		$numSettings = sizeof($set-list);
		if( !is_numeric($set-list[0]) ) {
			$numSettings--;
		}
		if( $numSettings <= 4 ) {
			$rv .= " narrow";
		}
		$rv .= "\"><span>".htmlentities($name)."</span>\n"
				."\t\t<div class=\"set-list\">\n";
		$first = true;
		foreach( $set-list as $setting ) {
			$content = '&nbsp;';
			$class = false;
			if( is_numeric($setting) or ($setting == 'off') ) {
				if( $numbers ) {
					$class = 'number';
					$number = $setting;
					$image = 'off.gif';
				}
				else {
					$image = "$setting.bmp";
				}
				$content .= "<img src=\"images/$image\" />";
				if( $numbers ) {
					$content .= "<div>$number</div>";
				}
			}
			else if( $setting ) {
				$class = ($first ? 'label' : 'text');
				$content = $setting;
				$content = preg_replace('/([0-9]+ms)/', '<span class="delayTime">\1</span>', $content);
				$first = false;
			}
			else {
				$class = 'spacer';
			}
			if( $first and $spacer ) {
				$rv .= "\t\t<div class=\"label\">&nbsp;</div>\n";
				$first = false;
			}
			$rv .= "\t\t<div".($class ? " class=\"$class\"" : '').">$content</div>\n";
		}
		$rv .= "\t\t</div>\n"
				."\t</div>\n";
		return $rv;
	}

	function addSong( $identifier, $title, $tuning, $devices = array() ) {
		if( $identifier === true ) {
			$identifier = string_toCamelCase($title);
		}
		$this->songs[$identifier] = array($title, $tuning, $devices);
	}

	function hasSong( $identifier ) {
		return isset($this->songs[$identifier]);
	}

	function getSongIdentifiers() {
		return array_keys($this->songs);
	}

	function printSongs( $identifiers ) {
		if( !is_array($identifiers) ) {
			$identifiers = explode("\n", trim($identifiers));
		}
		foreach( $identifiers as $identifier ) {
			if( preg_match('/ *- *(.*)/', $identifier, $matches) ) {
				$markup .= $this->getNote($matches[1]);
			}
			else {
				$markup .= $this->getSong($identifier);
			}
		}
		echo $markup;
	}

	function getNote( $note ) {
		return "<div class=\"note\">$note</div>\n";
	}

	function getSong( $identifier ) {
		if( !$identifier ) {
			return $this->getPageBreak();
		}
		else if( $identifier === true ) {
			return "<hr />\n";
		}
		if( isset($this->songs[$identifier]) ) {
			list($title, $tuning, $devices) = $this->songs[$identifier];
			if( !$tuning ) {
				$tuning = '-';
			}
		}
		else {
			echo "Couldn't find song '$identifier'".NL;
			$title = $identifier;
			$tuning = '-';
			$devices = array();
		}
		$id = string_toCamelCase($title);
		$rv = '';
		if( isset($devices[0]) ) {
			if( !is_array($devices[0]) ) {
				$devices[0] = array($devices[0]);
			}
			foreach( $devices[0] as $note ) {
				$rv .= $this->getNote($note);
			}
		}
		$rv .= "<div id=\"$id\" class=\"song\">\n"
				."\t<span class=\"tuning\">$tuning</span>\n"
				."\t<div class=\"title\">$title</div>\n";
		foreach( $devices as $device => $set-list ) {
			if( $device === 0 or $device === 1 ) {
				continue;
			}
			$rv .= $this->getDevice($device, $set-list, false);
		}
		$rv .= "\t<div class=\"clearing\"></div>\n"
				."</div>\n\n";
		if( isset($devices[1]) ) {
			if( !is_array($devices[1]) ) {
				$devices[1] = array($devices[1]);
			}
			foreach( $devices[1] as $note ) {
				$rv .= $this->getNote($note);
			}
		}
		return $rv;
	}

	function getDevices( $identifier ) {
		if( isset($this->songs[$identifier][2]) ) {
			return $this->songs[$identifier][2];
		}
	}

	function getPageBreak() {
		return "<div class=\"pageBreak\">&nbsp;</div>\n";
	}

}

function string_toCamelCase( $string ) {
	$string = strtolower($string);
	$string = preg_replace('/[\/\-_]/', ' ', $string);
	$string = preg_replace('/[^a-z0-9 ]/', '', $string);
	$words = explode(' ', $string);
	$string = '';
	foreach( $words as $word ) {
		$string .= ($string ? ucfirst($word) : $word);
	}
	return $string;
}

function printHeader( $cssFile = false, $title = 'Set List' ) {
	?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="ie ie6 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]>  <html class="ie gte-ie9" lang="en"> <![endif]-->
<!--[if !IE]>-->   <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="http://use.typekit.com/ryn4tie.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<script type="text/javascript" src="js/app.js"></script>
	<link rel="stylesheet" href="set-list.css" type="text/css" media="all" />
<?= ($cssFile ? '<link rel="stylesheet" href="'.$cssFile.'" type="text/css" media="all" />' : '') ?>
	<title>$title</title>
</head>
<body>
<div id="container">
<?php
}

function printFooter() {
	?>
</div>
</body>
</html>
<?php
}
