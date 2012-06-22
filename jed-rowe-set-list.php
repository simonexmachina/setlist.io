<?php
include('set-list.php');

$gigSheet = new GigSheet();
include('jed-rowe-songs.php');

echo printHeader();

$gigSheet->printRig();

$gigSheet->printSongs(array(
'goldfish',
'boomtown',
'trickOfTheLight',
'alibi',
'inTheMorning',
'littleDevil',
'soundOfRain',
'originalLanguage',
'life'
));
echo printFooter();
?>