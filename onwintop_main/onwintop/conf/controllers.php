<?php

/***
 * @author Utpalendu Barman
 * @name Database
 * @params none
 * @description returns all database related datas
 */
//Database Class

/***
 * 
 * Manual
 * @name : Query(string)         -> Execute a query, returns true on successful execution, false on error
 * @name : CountRows(string)     -> Retuns number of rows
 * @name : RetriveSingle(string) -> Retuns data object of single row
 * @name : RetriveArray(string)  -> Retuns data object of multiple rows
 * @name : CheckUnique(value,column,table_name) -> check if value is unique in a column of a table
 * @name : FilterString(string)  -> Returns Filtered String escaping special characters
 * 
 */

class Database
{

    public $connection; //Connection Object

    public $query; //Query String

    public $query_count = 0; //Query Count

    public $error;

    //Default Constructor 

    public function __consrtuct()
    {
    }

    //Database Connection

    public function Connect()
    {
        
        /*$host="localhost";
        $db="easy_tellselling";
        $user="easy_tellselling";
        $password="wwjaAIGg-zHBAD-J";
        */
        
        require("db.php");
        $this->connection = new mysqli($host, $user, $password, $db);
    }

    //Query Handling

    public function Query($query)
    {

        $this->Connect();

        if ($this->connection->query($query)) {
            return true; //Returns TRUE on successful execution
        } else {
            return false; //Returns FALSE on unsuccessful execution
        }
    }
    //Retrive Data
    public function RetriveSingle($query)
    {

        $this->Connect();

        //Executing query
        $res = $this->connection->query($query);

        //Fetching data
        $data = $res->fetch_assoc();

        //Return data
        return $data;
    }
    //Retrive Array
    public function RetriveArray($query)
    {

        $this->Connect();

        //Executing query
        $res = $this->connection->query($query);

        //Response
        $response = array();

        //Fetching data
        while ($data = $res->fetch_array()) {
            array_push($response, $data);
        }

        //Return data
        return $response;
    }
    //Count Rows
    public function CountRows($query)
    {
        $this->Connect();
        //Executing query
        $res = $this->connection->query($query);
        //Fetching data
        $data = $res->num_rows;
        //Return data
        return $data;
    }
    //Count Rows
    public function CheckUnique($value, $column, $table)
    {
        $this->Connect();
        //query
        $query = "SELECT * FROM `" . $table . "` WHERE `" . $column . "`='" . $value . "' ";
        //Executing query
        $res = $this->connection->query($query);
        //Fetching data
        if (!$res->num_rows) {
            return true;
        } else {
            return false;
        }
    }
    //Filter String
    public function FilterString($string)
    {
        $this->Connect();
        //Executing query
        $res = $this->connection->real_escape_string($string);
        return $res;
    }
}
