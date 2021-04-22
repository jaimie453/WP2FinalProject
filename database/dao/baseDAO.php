<?php

@include_once __DIR__ . '/../login.php';

abstract class baseDAO
{
    protected $_connection;

    // will be overridden by concrete classes
    protected $_tableName;      // can be a single table name or a join
    protected $_primaryKey;


    public function __construct()
    {
        $this->_connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
        if (!$this->_connection->set_charset("utf8mb4")) {
            printf("Error loading character set utf8mb4: %s\n", $mysqli->error);
            exit();
        }
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
        if ($result = $this->_connection->query($query)) {
            foreach($result as $row)
                $rows[] = $this->convertToObject($row);

            $result->close();
        }

        return $rows;
    }

    // return single object with primary key (id), or null if none found
    public function getById($value) {
        $result = $this->fetch($value, $this->_primaryKey);
        if(!is_null($result))
            return $result[0];

        return null;
    }

    // return rows for search criteria
    // can only be accessed by other DAOs
    protected function fetch($value, $searchColumn)
    {
        $query = $this->_connection->prepare("select * from {$this->_tableName} where {$searchColumn} = ?");

        if (is_int($value))
            $query->bind_param("i", $value);
        else if (is_string($value))
            $query->bind_param("s", $value);
        else if (is_float($value))
            $query->bind_param("d", $value);

        $query->execute();

        $result = $query->get_result();

        // if query failed, generally due to null value
        if($result == false){
            $query->close();
            return null;
        }

        $rows = array();
        foreach($result as $row)
            $rows[] = $this->convertToObject($row);

        $query->close();

        if(count($rows) == 0)
            return null;

        return $rows;
    }
}
