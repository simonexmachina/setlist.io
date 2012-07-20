<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

include('gig-sheet.php');
$gigSheet = new GigSheet();
include('mushroom-giant-songs.php');

$songs = '
untitled
drake
woman
kuru
spheres
scars
';

echo printHeader('mushroom-giant.css', '');
$gigSheet->printRig();
$gigSheet->printSongs($songs);
echo printFooter();
?>