<?php
require('model/model.php');

function listPosts()
{
    /*$posts = getPosts();
    echo $GLOBALS['twig']->render('listPostsView.twig', ['base_url' => BASE_URL, 'posts' => $posts]);*/
    return getPosts();
}

function post()
{
    /*$post = getPost($_GET['id']);
    echo $GLOBALS['twig']->render('postView.twig', ['base_url' => BASE_URL, 'post' => $post]);*/
    return getPost($_GET['id']);
}

function newPost($author, $title, $lead_paragraph, $content)
{
    $affectedLines = addPost($author, $title, $lead_paragraph, $content);

    if ($affectedLines === false) {
    	throw new Exception('Impossible d\'ajouter un billet !');
    }
    else {
        header('Location: ' .BASE_URL. 'index.php');
    }
}

function postForm()
{
    /*$post = getPost($_GET['id']);
    echo $GLOBALS['twig']->render('postFormView.twig', ['base_url' => BASE_URL, 'post' => $post]);*/
    return getPost($_GET['id']);
}

function editPost($postId, $author, $title, $lead_paragraph, $content)
{
    $affectedLines = updatePost($postId, $author, $title, $lead_paragraph, $content);

    if ($affectedLines === false) {
    	throw new Exception('Impossible de modifier le billet !');
    }
    else {
        header('Location: ' .BASE_URL. 'index.php/post/' .$postId);
    }
}

/*function error($errorMessage) {
    require 'view/errorView.php';
}*/