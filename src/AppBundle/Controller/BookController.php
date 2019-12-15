<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Forms;


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

    /**
     * @Route("/book/new", name="new book")
     * Method({"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function addBook(Request $request)
    {
        $book = new Book();
        $form = $this->createFormBuilder($book)
            ->add('isbn', 'text', array(
                'required' => true,
                'attr' => array('class' => 'form-control')))
            ->add('title', 'text', array(
                'required' => true,
                'attr' => array('class' => 'form-control')))
            ->add('author', 'text', array(
                'required' => true,
                'attr' => array('class' => 'form-control')))
            ->add('release_year', 'number', array(
                'required' => true,
                'attr' => array('class' => 'form-control')))
            ->add('save', 'submit', array(
                'label' => 'Add new book',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $book = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirect('/');
        }

        return $this->render('books/add.html.twig', array(
            'form' => $form->createView()
        ));
    }


}






