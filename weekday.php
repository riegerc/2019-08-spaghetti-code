<?php

/**
 * Wochentagsberechnung nach https://de.wikipedia.org/wiki/Wochentagsberechnung
 */

setlocale(LC_TIME, 'de_AT.utf-8');
    //TODO: find something to do
$day = $argv[1];
$month = $argv[2];
$year = $argv[3]; /* muss vierstellig sein */

if($argc<4 || $argc>5) {
    echo "Wrong number of arguments.";
    exit(1);
}

$m = (($month - 2 - 1 ) + 12 ) % 12 + 1 ; // this is because of the modulo
$c = substr($year, 0, 2);
if($m>=11) {
    $c = substr($year-1, 0, 2);
}
$y = substr($year, 2, 2);
if($m>=11) {
    $y = substr($year-1, 2, 2);
}

$weekdayNumber = ($day + intval (2.6 * $m - 0.2) + $y  + intval ($y/4) + intval ($c/4) - 2*$c ) % 7;

$weekday = getWeekdayForWeekdayNumber($weekdayNumber);


printEingabe($day, $month, $year);
printPhpFunction($year, $month, $day);
printAlgorythmus($weekday);
printDebug($m, $y, $c);

/**
 * @param int $m
 * @param $y
 * @param $c
 */
function printDebug(int $m, $y, $c): void {
    global $argc;
    global $argv;
    if ($argc > 4 && ($argv[4] == '-d' || $argv[4] == '--debug')) {
        echo "DEBUG: m={$m} y={$y} c={$c}\n";
    }
}
/**
 * @param $weekday
 */
function printAlgorythmus($weekday): void {
    echo "Berechnung Algorithmus: Wochentag='{$weekday}'\n";
}
/**
 * @param $year
 * @param $month
 * @param $day
 */
function printPhpFunction($year, $month, $day): void {
    echo strftime("Berechnung PHP: Wochentag='%A'\n", strtotime("$year-$month-$day"));
}
/**
 * @param $day
 * @param $month
 * @param $year
 */
function printEingabe($day, $month, $year): void {
    echo "Eingabe: {$day}.{$month}.{$year}\n";
}
/**
 * @param int $w
 * @return mixed
 */
function getWeekdayForWeekdayNumber(int $w) {
    $weekdayNames = ["Sonntag", "Montag", "Dienstag", "Mitwoch", "Donnerstag", "Freitag", "Samstag"];
    $weekday = $weekdayNames[$w];
    return $weekday;
}


