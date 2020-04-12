<?php


class lexique
{

    // database connection and table name
    private $conn;
    private $tableName = "lexique";

    // object properties
    /**
     * @var string
     */

    public $genre;

    /**
     * @var string
     */
    public $nombre;


    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function numberRow()
    {
        $query = "SELECT COUNT(*) FROM " . $this->tableName;

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    //  get random Nom
    public function getNOM()
    {
        $query = "SELECT DISTINCT ortho, genre, nombre FROM " . $this->tableName . " WHERE cgram='NOM' AND nombre='" . $this->nombre . "'ORDER BY RAND() LIMIT 1";
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        $NOM = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->genre = $NOM['genre'];

        return $NOM['ortho'];
    }

    // get random Pronom personel
    public function getPRO()
    {
        if (isset($this->nombre)) {
            $query = "SELECT DISTINCT ortho, genre FROM " . $this->tableName . " WHERE cgram='PRO:per' AND nombre='" . $this->nombre . "' ORDER BY RAND() LIMIT 1";
        } else {
            $query = "SELECT DISTINCT ortho, genre, nombre FROM " . $this->tableName . " WHERE cgram='PRO:per' ORDER BY RAND() LIMIT 1";
        }

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        $PRO = $stmt->fetch(PDO::FETCH_ASSOC);

        return $PRO['ortho'];
    }

    // get random Verbe
    public function getVER($temps1, $temps2, $gn)
    {
        $temps = $temps1 . ':' . $temps2 . ':' . $gn;
        $query = "SELECT DISTINCT ortho, genre, nombre FROM " . $this->tableName . " WHERE cgram='VER' AND infover LIKE '" . $temps . "' ORDER BY RAND() LIMIT 1";

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        $VER = $stmt->fetch(PDO::FETCH_ASSOC);

        return $VER['ortho'];
    }

    public function getADV()
    {
        $query = "SELECT DISTINCT ortho, genre, nombre FROM " . $this->tableName . " WHERE cgram='ADV' ORDER BY RAND() LIMIT 1";

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        $ADV = $stmt->fetch(PDO::FETCH_ASSOC);

        return $ADV['ortho'];
    }

    //get random Adjectif
    public function getADJ()
    {
        $query = "SELECT DISTINCT ortho, genre, nombre FROM " . $this->tableName . " WHERE cgram='ADJ' ORDER BY RAND() LIMIT 1";

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        $ADJ = $stmt->fetch(PDO::FETCH_ASSOC);

        return $ADJ['ortho'];
    }

    //get randmom Article
    public function getART()
    {
        $query = "SELECT DISTINCT ortho, genre, nombre FROM " . $this->tableName . " WHERE (cgram='ART:ind' OR cgram='ART:def') AND genre='" . $this->genre . "' AND nombre='" . $this->nombre . "' ORDER BY RAND() LIMIT 1";

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        $ART = $stmt->fetch(PDO::FETCH_ASSOC);
        return $ART['ortho'];
    }

    public function getAll($temps1, $temps2, $gn)
    {
        $WORDS = array(
            "NOM" => $this->getNOM(),
            "PRO" => $this->getPRO(),
            "VER" => $this->getVER($temps1, $temps2, $gn),
            "ADV" => $this->getADV(),
            "ADJ" => $this->getADJ(),
            "ART" => $this->getART()
        );

        return $WORDS;
    }

}