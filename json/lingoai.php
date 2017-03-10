<?php

$verb_file = file_get_contents('verb_sein.json');
$verb_json = json_decode($verb_file, TRUE);

$pers_file = file_get_contents('personalpronomen.json');
$pers_json = json_decode($pers_file, TRUE);

echo verb()."\n";
echo personalpronomen()."\n";
echo array_search('bin', $verb_json)."\n\n";

//echo $json["aktiv"]["indikativ"]["praesens"]["ich"];
//var_dump($json);

function verb($genus='aktiv', $verbform='indikativ', $zeitform='praesens', $numerus='singular', $person='1'){
    global $verb_json;
    return $verb_json[$genus][$verbform][$zeitform][$numerus][$person];
}

function personalpronomen($numerus='singular', $person='1', $fall='nominativ'){
    global $pers_json;
    return $pers_json[$numerus][$person][$fall];
}

?>
