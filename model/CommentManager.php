<?php
namespace OC\BlogPost\Model;

use \OC\BlogPost\Framework\Manager;
use \OC\BlogPost\Entity\Comment;

class CommentManager extends Manager
{


    /**
     * @access public
     * @param int $postId 
     * @return Comment
     */
    
    public function getComments($postId)
    {
        $sql = 'SELECT author, title, content, created_date as createdDate FROM comment WHERE post_id = ? ORDER BY created_date DESC';
        $params = array($postId);
        $res = $this->executeRequest($sql, $params);
        
        $comments = array();
        while ($data = $res->fetch(\PDO::FETCH_ASSOC)) {
            $comments[] = new Comment($data);
        }
        return $comments;
    }


    /**
     * @access public
     * @param int $postId 
     * @param string $author 
     * @param string $title 
     * @param string $content 
     * @return PDOStatement
     */

    public function addComment(Comment $comment)
    {
        $sql = 'INSERT INTO comment (post_id, author, title, content) VALUES (:post_id, :author, :title, :content)';
        $params = array(
            'post_id' => $comment->getPostId(), 
            'author'  => $comment->getAuthor(), 
            'title'   => $comment->getTitle(), 
            'content' => $comment->getContent()
        );
        $insert = $this->executeRequest($sql, $params);

        return $insert;
    }
}