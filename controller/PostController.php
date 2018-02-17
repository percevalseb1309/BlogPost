<?php
namespace OC\BlogPost\Controller;

use \OC\BlogPost\Framework\Controller;
use \OC\BlogPost\Framework\Loader;

class PostController extends Controller
{
    private $_token;
    private $_postManager;
    private $_commentManager;

    public function __construct(Loader $loader)
    {
        $this->_token          = $loader->service('token');
        $this->_postManager    = $loader->model('post');
        $this->_commentManager = $loader->model('comment');
    }

    public function index()
    {
        $data['posts'] = $this->_postManager->getPosts();
        $this->generateView('blog/listPosts', $data);
    }

    public function deletePost()
    {
        $postId = $this->_request->getParameter("id");
        $affectedLines = $this->_postManager->deletePost($postId);

        if ($affectedLines === false) {
            throw new \Exception('Impossible de supprimer le post !');
        }
        else {
            header('Location: ' .BASE_URL. 'index.php/post');
        }
    }

    public function post()
    {
        $postId = $this->_request->getParameter("id"); 
        $data['post']     = $this->_postManager->getPost($postId);
        $data['comments'] = $this->_commentManager->getComments($postId);
        $data['token']    = $this->_token->createToken();
        $this->generateView('blog/post', $data);
    }

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
            header('Location: ' .BASE_URL. 'index.php/post/post/' .$postId);
        }
    }

    public function postForm()
    {
        $postId = $this->_request->getParameter("id");
        $data['post']  = $this->_postManager->getPost($postId);
        $data['token'] = $this->_token->createToken();
        $this->generateView('blog/editPostForm', $data);
    }

    public function editPost()
    {
        $this->_token->checkToken();

        $postId         = $this->_request->getParameter("id");
        $author         = $this->_request->getParameter("author");
        $title          = $this->_request->getParameter("title");
        $lead_paragraph = $this->_request->getParameter("lead_paragraph");
        $content        = $this->_request->getParameter("content");
        $affectedLines  = $this->_postManager->updatePost($postId, $author, $title, $lead_paragraph, $content);

        if ($affectedLines === false) {
            throw new \Exception('Impossible de modifier le post !');
        }
        else {
            header('Location: ' .BASE_URL. 'index.php/post/post/' .$postId);
        }
    }    

    public function newPostForm()
    {
        $data['token'] = $this->_token->createToken();
        $this->generateView('blog/addPostForm', $data);
    }

    public function newPost()
    {
        $this->_token->checkToken();

        $author         = $this->_request->getParameter("author");
        $title          = $this->_request->getParameter("title");
        $lead_paragraph = $this->_request->getParameter("lead_paragraph");
        $content        = $this->_request->getParameter("content");

        $affectedLines = $this->_postManager->addPost($author, $title, $lead_paragraph, $content);
        if ($affectedLines === false) {
            throw new \Exception("Impossible d'ajouter un post !");
        }
        else {
            header('Location: ' .BASE_URL. 'index.php/post');
        }
    }
}