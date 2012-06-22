<?php

$gigSheet->addSong('originalLanguage', 'Original Language', 'E', array(
		'DD-20 Delay' => '340ms,1.5,12,12,10.5'
));

$gigSheet->addSong('inTheMorning', 'In the Morning', 'E', array(
		'CE-3' => '9,10.5',
		'Nord' => 'C3',
		'DD-20 Delay' => '300ms,12,3,1.5,10.5'
));

$gigSheet->addSong('soundOfRain', 'Sound of Rain', 'E', array(
		'DD-20 Delay' => '445ms,12,3,12,10.5'
));

$gigSheet->addSong('trickOfTheLight', 'Trick of the Light', 'D', array(
		'DD-20 Delay' => '445ms,1.5,12,1.5,10.5',
		'OD-3' => '12,12,8'
));

$gigSheet->addSong('alibi', 'Alibi', 'E', array(
		'DD-20 Delay' => '440ms,1.5,12,1.5,10.5',
));

$others = array(
		'goldfish' => 'Goldfish in a Bowl',
		'boomtown' => 'Boomtown',
		'littleDevil' => 'Little Devil',
		'life' => 'Life'
);
foreach( $others as $song => $name) {
	$gigSheet->addSong($song, $name, false);
}
?>