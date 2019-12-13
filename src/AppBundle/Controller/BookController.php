<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
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
    public function index(): Response
    {
        $books = $this->getDoctrine()->getRepository(Book::class)->findAll();
        return $this->render('books/index.html.twig', array('books' => $books));
    }

//    /**
//     * @Route("/book/save")
//     */
//    public function save()
//    {
//        $entityManager = $this->getDoctrine()->getManager();
//
//        $book = new Book();
//        $book->setIsbn("adfds3455234234test");
//        $book->setAuthor("Testv2 Testv2");
//        $book->setReleaseYear(2007);
//        $book->setTitle("Testv2");
//
//        $entityManager->persist($book);
//
//        $entityManager->flush();
//
//        return new Response('Saved a book with the id: ' . $book->getId());
//    }
}

