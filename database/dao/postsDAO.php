<?php

@include_once dirname(__FILE__) . '/baseDAO.php';
@include_once __DIR__ . '/../models/post.php';

class postsDAO extends baseDAO
{
    protected $_tableName = 'travelpost';
    protected $_primaryKey = 'PostID';

    protected function convertToObject($row) {
        return new Post($row['PostID'], $row['UID'], $row['ParentPost'], $row['Title'], $row['Message'], $row['PostTime']);
    }

    // get posts for user id
    public function getPostsForUser($uId) {
        return $this->fetch($uId, 'uId');
    }

    // search keyword in post titles
    // $sortAsc is bool, if true asc, else desc
    public function searchPostTitles($keyword, $sortAsc) {
        if ($sortAsc == "true")
          $sort = "asc";
        else
          $sort = "desc";

        // select all from table where title matches keyword, sort
        $query = $this->_connection->prepare("
          select *
          from {$this->_tableName}
          where Title like '%{$keyword}%'
          order by Title {$sort}
        ");

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

?>
