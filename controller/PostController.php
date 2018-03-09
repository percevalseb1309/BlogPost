<?php
namespace OC\BlogPost\Controller;

use \OC\BlogPost\Framework\Controller;
use \OC\BlogPost\Framework\Loader;

class PostController extends Controller
{
    /**
     * 
     * @var Token
     * @access private
     */
    private $_token;

    /**
     * 
     * @var PostManager
     * @access private
     */
    private $_postManager;

    /**
     * 
     * @var CommentManager
     * @access private
     */
    private $_commentManager;


    /**
     * @access public
     * @param Loader $loader 
     * @return void
     */
    
    public function __construct(Loader $loader)
    {
        $this->_token          = $loader->service('token');
        $this->_postManager    = $loader->model('post');
        $this->_commentManager = $loader->model('comment');
    }


    /**
     * @access public
     * @return void
     */

    public function index()
    {
        $data['posts'] = $this->_postManager->getPosts();
        $this->generateView('blog/listPosts', $data);
    }


    /**
     * @access public
     * @return void
     */

    public function deletePost()
    {
        $postId = $this->_request->getParameter("id");
        $affectedLines = $this->_postManager->deletePost($postId);

        if ($affectedLines === false) {
            throw new \Exception('Impossible de supprimer le post !');
        }
        else {
            header('Location: ' .BASE_URL. 'post');
        }
    }


    /**
     * @access public
     * @return void
     */

    public function post()
    {
        $postId = $this->_request->getParameter("id"); 
        $data['post']     = $this->_postManager->getPost($postId);
        $data['comments'] = $this->_commentManager->getComments($postId);
        $data['token']    = $this->_token->createToken();
        $this->generateView('blog/post', $data);
    }


    /**
     * @access public
     * @return void
     */

    public function newComment()
    {
        $this->_token->checkToken();

        $postId         = $this->_request->getParameter("id");
        $author         = $this->_request->getParameter("author");
        $title          = $this->_request->getParameter("title");
        $content        = $this->_request->getParameter("content");
        $affectedLines  = $this->_commentManager->addComment($postId, $author, $title, $content);

        if ($affectedLines === false) {
            throw new \Exception("Impossible d'ajouter un commentaire !");
        }
        else {
            header('Location: ' .BASE_URL. 'post/post/' .$postId);
        }
    }


    /**
     * @access public
     * @return void
     */

    public function postForm()
    {
        $postId = $this->_request->getParameter("id");
        $data['post']  = $this->_postManager->getPost($postId);
        $data['token'] = $this->_token->createToken();
        $this->generateView('blog/editPostForm', $data);
    }


    /**
     * @access public
     * @return void
     */

    public function editPost()
    {
        $this->_token->checkToken();

        $postId        = $this->_request->getParameter("id");
        $author        = $this->_request->getParameter("author");
        $title         = $this->_request->getParameter("title");
        $leadParagraph = $this->_request->getParameter("lead_paragraph");
        $content       = $this->_request->getParameter("content");
        $affectedLines = $this->_postManager->updatePost($postId, $author, $title, $leadParagraph, $content);

        if ($affectedLines === false) {
            throw new \Exception('Impossible de modifier le post !');
        }
        else {
            header('Location: ' .BASE_URL. 'post/post/' .$postId);
        }
    } 


    /**
     * @access public
     * @return void
     */   

    public function newPostForm()
    {
        $data['token'] = $this->_token->createToken();
        $this->generateView('blog/addPostForm', $data);
    }


    /**
     * @access public
     * @return void
     */

    public function newPost()
    {
        $this->_token->checkToken();

        $author        = $this->_request->getParameter("author");
        $title         = $this->_request->getParameter("title");
        $leadParagraph = $this->_request->getParameter("lead_paragraph");
        $content       = $this->_request->getParameter("content");

        $affectedLines = $this->_postManager->addPost($author, $title, $leadParagraph, $content);
        if ($affectedLines === false) {
            throw new \Exception("Impossible d'ajouter un post !");
        }
        else {
            header('Location: ' .BASE_URL. 'post');
        }
    }
}