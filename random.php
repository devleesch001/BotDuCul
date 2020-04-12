<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');


//header('Content-Type: text/html; charset=utf-8');
function getPhrasing()
{
    include('config/dbConfig.php');
    include 'config/botConfig.php';
    /** Set access tokens here - see: https://apps.twitter.com/ **/


// Connect to applications DB
    try {
        $database = new Database($dbConfig);
        $db = $database->getConnection();
    } catch (PDOException $e) {
        echo 'Echec de la connexion : ' . $e->getMessage();
        exit;
    }

    $consonant = array(
        'a', 'à', 'â', 'ä', 'æ',
        'e', 'è', 'é', 'ê', 'ë',
        'i', 'î', 'ï',
        'o', 'ô', 'œ',
        'u', 'ù', 'û', 'ü',
        'y', 'ÿ'
    );

    $lexique = new lexique($db);
    $lexique->nombre = 's';

//$wordIs = $misc->actualWord();
//
//$stmt = $lexique->numberRow();
//$numberRow = $stmt->fetch();
//echo $numberRow['COUNT(*)'];

    $WORDS = $lexique->getAll('%', '%', '3s');

    if (in_array($WORDS['NOM'][0], $consonant)) {
        $WORDS['ART'] = "l'";
    }

    $NMP = "Sardoche";

    $template = array(
        $botName,
        $WORDS['VER'],
        $WORDS['ART'],
        $WORDS['NOM']
    );

//echo "Phrase 1 : ";
    $tweet = "";
    foreach ($template as &$result) {
        $tweet .= $result;
        if (!($result == "l'")) {
            $tweet .= " ";
        }
    }
    echo $tweet;
    return $tweet;
}
