<?php
namespace OC\BlogPost\Model;

use \OC\BlogPost\Framework\Manager;

class PostManager extends Manager
{

    /**
     * @access public
     * @return array
     */
    
    public function getPosts()
    {
        $sql = 'SELECT id, author, title, lead_paragraph, content, created_date FROM post ORDER BY created_date DESC LIMIT 0, 5';
        $res = $this->executeRequest($sql);
        
        return $res->fetchAll();
    }


    /**
     * @access public
     * @param int $postId 
     * @return PDOStatement
     */

    public function deletePost($postId)
    {
        $sql = 'DELETE FROM post WHERE id = ?';
        $params = array($postId);
        $delete = $this->executeRequest($sql, $params);

        if ($delete->rowCount() == 1) 
            return $delete;
        else
            throw new \Exception("Aucun post ne correspond à l'identifiant '" .$postId. "'");
    }


    /**
     * @access public
     * @param int $postId 
     * @return array
     */

    public function getPost($postId)
    {
        $sql = 'SELECT id, author, title, lead_paragraph, content, created_date, last_update_date FROM post WHERE id = ?';
        $params = array($postId);
        $res = $this->executeRequest($sql, $params);

        if ($res->rowCount() == 1) 
            return $res->fetch();
        else
            throw new \Exception("Aucun post ne correspond à l'identifiant '" .$postId. "'");
    }


    /**
     * @access public
     * @param int $postId 
     * @param string $author 
     * @param string $title 
     * @param string $leadParagraph 
     * @param string $content 
     * @return PDOStatement
     */

    public function updatePost($postId, $author, $title, $leadParagraph, $content)
    {
        $sql = 'UPDATE post SET author = :author, title = :title, lead_paragraph = :lead_paragraph, content = :content, last_update_date = NOW() WHERE id = :id';
        $params = array(
            'id'             => $postId,
            'author'         => $author, 
            'title'          => $title, 
            'lead_paragraph' => $leadParagraph, 
            'content'        => $content
        );
        $update = $this->executeRequest($sql, $params);

        if ($update->rowCount() == 1) 
            return $update;
        else
            throw new \Exception("Aucun post ne correspond à l'identifiant '" .$postId. "'");
    }


    /**
     * @access public
     * @param string $author 
     * @param string $title 
     * @param string $leadParagraph 
     * @param string $content 
     * @return PDOStatement
     */

    public function addPost($author, $title, $leadParagraph, $content)
    {
        $sql = 'INSERT INTO post (author, title, lead_paragraph, content) VALUES (:author, :title, :lead_paragraph, :content)';
        $params = array(
            'author'         => $author, 
            'title'          => $title, 
            'lead_paragraph' => $leadParagraph, 
            'content'        => $content
        );
        $insert = $this->executeRequest($sql, $params);

        return $insert;
    }
}