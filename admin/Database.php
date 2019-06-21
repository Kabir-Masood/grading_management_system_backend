<?php
/**
 * Created by PhpStorm.
 * Database connecting and disconnecting codes are here.
 * Fetching data from database codes also included here.
 * Query from anywhere code also here.
 */


include_once 'db_config.php';

class Database
{
    private $link;

    private function connect()
    {
        $this->link = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    }

    private function disconnect()
    {
        mysqli_close($this->link);
    }

    public function query($query_string)
    {
        $this->connect();
        $q = mysqli_query($this->link, $query_string);
        $this->disconnect();
        return $q;
    }

    public function fetch($q)
    {
        return mysqli_fetch_all($q, MYSQLI_ASSOC);
    }

    public function fetch_assoc($q)
    {
        return mysqli_fetch_assoc($q);
    }

}