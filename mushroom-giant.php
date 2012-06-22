<?php
echo 'hi'.NL;
include('set-list.php');

$gigSheet = new GigSheet();
include('mushroom-giant-songs.php');

$songs = array(
	'graven',
	'woman',
	'poorTom',
	'drake',
	'coma',
	false,
	'400',
	'shadows',
	'scars',
	'aesong',
	'ignorance',
	'galapagos',

	'travesty',
	'majesticBlackness',
	'theAbyss',
	'autumn',
	'pigeons',
	'ironTang',

//	'reach',
//	'untitled',
//	'component',
//	'lola',
//	'jazz',

);

echo printHeader('mushroom-giant.css');
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