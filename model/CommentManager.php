<?php
namespace OC\BlogPost\Model;

use \OC\BlogPost\Framework\Manager;

class CommentManager extends Manager
{


    /**
     * @access public
     * @param int $postId 
     * @return array
     */
    
    public function getComments($postId)
    {
        $sql = 'SELECT author, title, content, created_date FROM comment WHERE post_id = ? ORDER BY created_date DESC';
        $params = array($postId);
        $res = $this->executeRequest($sql, $params);
        
        return $res->fetchAll();
    }


    /**
     * @access public
     * @param int $postId 
     * @param string $author 
     * @param string $title 
     * @param string $content 
     * @return PDOStatement
     */

    public function addComment($postId, $author, $title, $content)
    {
        $sql = 'INSERT INTO comment (post_id, author, title, content) VALUES (:post_id, :author, :title, :content)';
        $params = array(
            'post_id' => $postId, 
            'author'  => $author, 
            'title'   => $title, 
            'content' => $content
        );
        $insert = $this->executeRequest($sql, $params);

        return $insert;
    }
}