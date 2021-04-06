<?php

@include_once __DIR__ . '/../login.php';

abstract class baseDAO
{
    protected $__connection;

    // will be overridden by concrete classes
    protected $_tableName;      // can be a single table name or a join
    protected $_primaryKey;


    public function __construct()
    {
        $this->__connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    }


    // converts a row array from the db to an object
    // will be defined in each DAO
    abstract protected function convertToObject($row);


    // set $page and $resultsPerPage if pagination is needed
    // $page starts at 0
    // $orderBy would contain the column to order and desc/asc
    //      eg: $orderBy = "avg DESC"
    public function getAll($page = null, $resultsPerPage = null, $orderBy = null)
    {
        $query = "select * from {$this->_tableName}";

        if (!is_null($orderBy))
            $query .= " order by {$orderBy}";

        if (!is_null($page) && !is_null(($resultsPerPage))) {
            $rowsToSkip = $page * $resultsPerPage;
            $query .= " limit {$resultsPerPage} offset {$rowsToSkip}";
        }

        $rows = array();
        if ($result = $this->__connection->query($query)) {
            foreach($result as $row)
                $rows[] = $this->convertToObject($row);
            
            $result->close();
        }

        return $rows;
    }


    // gets rows for primary key if no column is specified
    // $column is a string containing the column name to search $value
    public function fetch($value, $searchColumn = null)
    {
        if (is_null($searchColumn))
            $searchColumn = $this->_primaryKey;

        $query = $this->__connection->prepare("select * from {$this->_tableName} where {$searchColumn} = ?");

        if (is_int($value))
            $query->bind_param("i", $value);
        else if (is_string($value))
            $query->bind_param("s", $value);
        else if (is_float($value))
            $query->bind_param("d", $value);

        $query->execute();

        $result = $query->get_result();
        $rows = array();
        foreach($result as $row)
            $rows[] = $this->convertToObject($row);
        
        $query->close();

        return $rows;
    }
}
