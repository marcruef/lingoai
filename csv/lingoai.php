<?php

$personalpronomen	= readcsvtable('personalpronomen.csv', 0);
$possessivpronomen	= readcsvtable('possessivpronomen.csv', 0);
$verben			= readcsvtable('verben.csv', 1);
$adjektive		= readcsvtable('adjektive.csv', 1);

//echo $verben['sein']['aktiv_indikativ_perfekt_plural_1'];
//print_r($verben);
//print_r($personalpronomen);

echo $argv[0].' <1|2|3> <singular|plural> <nominativ|genitiv|dativ|akkusativ>'."\n\n";

echo personalpronomen($argv[2], $argv[1]).' '.
    verb('sein', 'aktiv', 'indikativ', 'praesens', $argv[2], $argv[1]).' '.
    adjektiv()."\n";

function readcsvtable($filename, $matrix=1, $del=';'){
    $fh = fopen($filename, 'r');

    // Read title line
    $title = fgetcsv($fh, 5000, $del);

    // Read verb line by line
    while (($line = fgetcsv($fh, 5000, $del)) !== FALSE){
	for($i=0; $i<count($title); ++$i){
	    if($matrix == 1){
		$arr[$line[0]][$title[$i]] = $line[$i];
	    }else{
		$arr[$title[$i]] = $line[$i];
	    }
	}
    }
    fclose($fh);
    return $arr;
}

function personalpronomen($numerus='singular', $person='1', $fall='nominativ'){
    global $personalpronomen;
    return $personalpronomen[$numerus.'_'.$person.'_'.$fall];
}

function verb($verb='sein', $aktiv='aktiv', $indikativ='indikativ', $zeitform='praesens', $numerus='singular', $person='1'){
    global $verben;
    return $verben[$verb][$aktiv.'_'.$indikativ.'_'.$zeitform.'_'.$numerus.'_'.$person];
}

function adjektiv($adjektiv='schön', $komparation='positiv'){
    global $adjektive;
    return $adjektive[$adjektiv][$komparation];
}

?>
