<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post", methods={"GET"})
     */
    public function index()
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'posts'           => $this->getDoctrine()->getRepository(Post::class)->findAll()]);
    }
    
    
    /**
     * @Route("/post/{id}", name="post_show", requirements={"id"="\d+"})
     */
    public function show($id)
    {
        return $this->render('post/show.html.twig', [
            'controller_name' => 'PostController',
            'post'            => $this->getDoctrine()->getRepository(Post::class)->find($id)]);
    }
    
    /**
     * @Route("/post/create", name="post_create_form", methods={"GET"})
     */
    public function create()
    {
        return $this->render('post/create.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }
    
    
    /**
     * @Route("/post", name="post_create_store", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function store(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $post = new Post();
        $post->setTitle($request->get('title'));
        $post->setSubtitle($request->get('subtitle'));
        $post->setIntro($request->get('intro'));
        $post->setContent($request->get('content'));
        $post->setFkUserId(0);
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $manager->persist($post);
        
        // actually executes the queries (i.e. the INSERT query)
        $manager->flush();
        
        return $this->redirectToRoute('home');
    }
}
