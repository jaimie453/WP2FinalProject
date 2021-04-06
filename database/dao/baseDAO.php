<?php

@include_once __DIR__ . '/../login.php';

abstract class baseDAO
{
    private $__connection;

    // will be overridden by concrete classes
    protected $_tableName;      // can be a single table name or a join
    protected $_primaryKey;

    public function __construct()
    {
        $this->__connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    }

    // set $page and $resultsPerPage if pagination is needed
    // $page starts at 0
    public function getAll($page = null, $resultsPerPage = null)
    {
        $query = "select * from {$this->_tableName}";

        if (!is_null($page) && !is_null(($resultsPerPage))) {
            $rowsToSkip = $page * $resultsPerPage;
            $query .= " limit {$resultsPerPage} offset {$rowsToSkip}";
        }

        $query .= ";";

        $rows = array();
        if ($result = $this->__connection->query($query)) {
            if($result->num_rows > 0)
                $rows = $result->fetch_all();
            
            $result->close();
        }

        return $rows;
    }

    // gets rows for primary key if no column is specified
    // $column is a string for the column name to search $value
    public function fetch($value, $column = null)
    {
        if (is_null($column))
            $column = $this->_primaryKey;

        $query = $this->__connection->prepare("select * from {$this->_tableName} where {$column} = ?");

        if (is_int($value))
            $query->bind_param("i", $value);
        else if (is_string($value))
            $query->bind_param("s", $value);
        else if (is_float($value))
            $query->bind_param("d", $value);

        $query->execute();

        $result = $query->get_result();
        $rows = array();
        if($result->num_rows > 0)
            $rows = $result->fetch_all();
        
        $query->close();

        return $rows;
    }
}
