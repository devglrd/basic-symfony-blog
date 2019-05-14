<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends Controller
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('static/index.html.twig', [
            'controller_name' => 'StaticController',
            'posts'           => $this->getDoctrine()->getRepository(Post::class)->findAll()
        ]);
    }
}
