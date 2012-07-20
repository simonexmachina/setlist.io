<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include('gig-sheet.php');

$gigSheet = new GigSheet();
//* dev */ GigSheet::generateDegrees();

include('mushroom-giant-songs.php');

$songs = array(
	'400',
	'drake',
	'woman',
	'spheres',
	'poorTom',
	'scars',
	'aesong',
	'untitled',

	'ignorance',
	'galapagos',
	'theAbyss',
	'majesticBlackness',

	'graven',
	'shadows',
	'travesty',
	'autumn',
	'pigeons',
	'ironTang',

//	'reach',
//	'untitled',
//	'component',
//	'lola',
//	'jazz',

);

echo printHeader('mushroom-giant.css', '');
foreach( $songs as $identifier ) {
	if( $identifier and !$gigSheet->hasSong($identifier) ) {
		echo "Couldn't find song for identifier '$identifier'".NL;
	}
}
foreach( $gigSheet->getSongIdentifiers() as $identifier ) {
	if( !in_array($identifier, $songs) and $gigSheet->getDevices($identifier) ) {
		echo "Song '$identifier' is not in songs list".NL;
	}
}
$gigSheet->printRig();
$gigSheet->printSongs($songs);
echo printFooter();
?>