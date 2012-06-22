<?php
include('set-list.php');

$gigSheet = new GigSheet();
include('jed-rowe-songs.php');

$songs = array(
	'life',
	'goldfish',
	'boomTown',
	'soundOfRain',
	'alibi',
	'originalLanguage',
	'littleDevil',
	'trickOfTheLight',
	'inTheMorning'
);

echo printHeader();
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