<?php
class Db{
    private $con;   // ühendus salvestatakse siia

    function __construct() {
        $this->con = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if($this->con->connect_errno) {
            echo "<strong>Viga Andmebaasiga:</strong> ".$this->con->connect_errno;
        } else {
            mysqli_set_charset($this->con, "utf8");
        }
    }


    #update, insert või delete
    function dbQuery($sql) {
        if($this->con) {
            $res = mysqli_query($this->con, $sql);
            if($res == false) {
                echo "<div>Vigane päring: " .htmlspecialchars($sql). "</div>";
                return false;
            }
            return $res; // tagastab objekti
        }
    }


    #Select sql lause jaoks
    function dbGetArray($sql) {
        $res = $this->dbQuery($sql);
        if($res !== false) {
            $data = array(); //Tühja massiivi loomine
            while($row = mysqli_fetch_assoc($res)) {
                $data[] = $row;
            }
            return(!empty($data)) ? $data : false;
        }
        return false;
    }

    # $_POST / $_GET    väärtuse tagastamine, POST on vormi andmed, get on (URL)
    # ?string saab olla post, get või null (vaikimisi)
    function getVar(string $name, ?string $method = null) {
        if($method === 'post') {
            return $_POST[$name] ?? null;
        } elseif($method === 'get') {
            return $_GET[$name] ?? null;
        } else {
            return $_POST[$name] == $_GET[$name] ?? null;
        }
    }

    #Sisendi turvalisemaks muutmine
    function dbFix($var) {
        if(!$this->con || !($this->con instanceof mysqli)) {        // || ehk või(or)
            return 'NULL';
        }

        if(is_null($var)) {
            return 'NULL';
        } elseif(is_bool($var)) {
            return $var ? '1' : '0';    // ? kui on tõene ja : kui on väär
        } elseif(is_numeric($var)) {
            return $var;
        } else {
            return $this->con->real_escape_string($var);        //varjestab ära imelikud tähemärgid, sümbolid jne (sobib register accounti panna)
        }
    }

    # inimlikul kujul massiivi sisu vaatamine

    function show($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    /**
     * tagastab valmis html value atribuudi, ntks value="Andres"
     * @param string $name - massiivi võti (vormi välja nimi) heading või context
     * @param array $source  massiiv kust väärtust võtta
     * @return string       - valmis value="..." või tühi string
     */

    function htmlValue(string $name, array $source): string {
        if(isset($source[$name])) {
            return 'value="' . htmlspecialchars($source[$name], ENT_QUOTES) . '"';
        }
        return '';
    }

    function htmlTextContent(string $name, array $source): string {
        return isset($source[$name]) ? htmlspecialchars($source[$name], ENT_QUOTES) : "";
    }








}   //class Db lõpp