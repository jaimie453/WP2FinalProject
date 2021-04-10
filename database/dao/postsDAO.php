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

    public function getPostsForUser($uId) {
        return $this->fetch($uId, 'uId');
    }
}

?>
