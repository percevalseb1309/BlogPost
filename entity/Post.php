<?php
namespace OC\BlogPost\Entity;

use OC\BlogPost\Framework\Entity;

class Post extends Entity
{

    /**
     * @var integer
     * @access private
     */
    private $id;

    /**
     * @var string
     * @access private
     */
    private $author;

    /**
     * @var string
     * @access private
     */
    private $title;

    /**
     * @var string
     * @access private
     */
    private $leadParagraph;

    /**
     * @var string
     * @access private
     */
    private $content;

    /**
     * @var \DateTime
     * @access private
     */
    private $createdDate;

    /**
     * @var \DateTime
     * @access private
     */
    private $lastUpdateDate;


    /**
     * @access public
     * @param integer $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = (int) $id;
    }

    /**
     * @access public
     * @return integer
     * @return void
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @access public
     * @param string $author
     * @return void
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @access public
     * @return string
     * @return void
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @access public
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @access public
     * @return string
     * @return void
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @access public
     * @param string $leadParagraph
     * @return void
     */
    public function setLeadParagraph($leadParagraph)
    {
        $this->leadParagraph = $leadParagraph;
    }

    /**
     * @access public
     * @return string
     * @return void
     */
    public function getLeadParagraph()
    {
        return $this->leadParagraph;
    }

    /**
     * @access public
     * @param string $content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @access public
     * @return string
     * @return void
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @access public
     * @param \DateTime $createdDate
     * @return void
     */
    public function setCreatedDate(\DateTime $createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @access public
     * @return \DateTime
     * @return void
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @access public
     * @param \DateTime $lastUpdateDate
     * @return void
     */
    public function setLastUpdateDate(\DateTime $lastUpdateDate)
    {
        $this->lastUpdateDate = $lastUpdateDate;
    }

    /**
     * @access public
     * @return \DateTime
     * @return void
     */
    public function getLastUpdateDate()
    {
        return $this->lastUpdateDate;
    }

}

