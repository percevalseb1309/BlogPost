<?php
namespace OC\BlogPost\Model;

use \OC\BlogPost\Framework\Manager;
use \OC\BlogPost\Entity\Post;

class PostManager extends Manager
{

    /**
     * @access public
     * @return Post
     */
    
    public function getPosts()
    {
        $sql = 'SELECT id, author, title, lead_paragraph as leadParagraph, created_date as createdDate  FROM post ORDER BY created_date DESC LIMIT 0, 5';
        $res = $this->executeRequest($sql);
        
        $posts = array();
        while ($data = $res->fetch(\PDO::FETCH_ASSOC)) {
            $posts[] = new Post($data);
        }
        return $posts;
    }


    /**
     * @access public
     * @param Post $postId 
     * @return PDOStatement
     */

    public function deletePost(Post $post)
    {
        $sql = 'DELETE FROM post WHERE id = ?';
        $params = array($post->getId());
        $delete = $this->executeRequest($sql, $params);

        if ($delete->rowCount() == 1) 
            return $delete;
        else
            throw new \Exception("Aucun post ne correspond à l'identifiant '" .$postId. "'");
    }


    /**
     * @access public
     * @param int $postId 
     * @return Post
     */

    public function getPost($postId)
    {
        $sql = 'SELECT id, author, title, lead_paragraph as leadParagraph, content, created_date as createdDate, last_update_date as lastUpdateDate FROM post WHERE id = ?';
        $params = array($postId);
        $res = $this->executeRequest($sql, $params);

        if ($res->rowCount() == 1) {
            $data = $res->fetch(\PDO::FETCH_ASSOC);
            return new Post($data);
        }
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

    public function updatePost(Post $post)
    {
        $sql = 'UPDATE post SET author = :author, title = :title, lead_paragraph = :lead_paragraph, content = :content, last_update_date = NOW() WHERE id = :id';
        $params = array(
            'id'             => $post->getId(),
            'author'         => $post->getAuthor(), 
            'title'          => $post->getTitle(), 
            'lead_paragraph' => $post->getLeadParagraph(), 
            'content'        => $post->getContent()
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

    public function addPost(Post $post)
    {
        $sql = 'INSERT INTO post (author, title, lead_paragraph, content) VALUES (:author, :title, :lead_paragraph, :content)';
        $params = array(
            'author'         => $post->getAuthor(), 
            'title'          => $post->getTitle(), 
            'lead_paragraph' => $post->getLeadParagraph(), 
            'content'        => $post->getContent()
        );
        $insert = $this->executeRequest($sql, $params);

        return $insert;
    }
}