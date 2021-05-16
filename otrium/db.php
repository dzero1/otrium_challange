<?php

namespace otrium;

interface DB_Interface
{
    public function connect();
    public function isConnected();
    public function execute($sql, $params);
}

class DB implements DB_Interface
{
    private $conn;

    public function connect(){
        global $CFG, $LOGGER;

        try {
            $LOGGER->debug("{$CFG['dbhost']} {$CFG['dbname']} {$CFG['dbuser']} {$CFG['dbpass']}");

            $conn = new \PDO("mysql:host={$CFG['dbhost']};dbname={$CFG['dbname']}", $CFG['dbuser'], $CFG['dbpass']);
            
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            $this->conn = $conn;
            return $conn;
        } catch(\PDOException $e) {
            die ("Connection failed: " . $e->getMessage());
        }
    }

    public function isConnected(){
        return $this->conn && true;
    }

    public function execute($sql, $params){

        global $LOGGER;

        // Prepare sql
        $q = $this->conn->prepare($sql);

        // Bind parameters
        foreach($params as $k => $p){

            $LOGGER->debug("[$k, $p]");

            $q->bindValue("$k", $p, is_int($p) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
        }

        // Executing query
        $q->execute();

        // Returning all fetched data
        $q->setFetchMode(\PDO::FETCH_ASSOC);
        return $q->fetchAll();
    }
}