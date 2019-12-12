<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class BookController extends Controller
{

    /**
     * @return Response
     * @Route("/")
     * @Method({"GET"})
     */
    public function index()
    {
        return $this->render('books/index.html.twig', array('name' => 'Test book'));
    }
}

