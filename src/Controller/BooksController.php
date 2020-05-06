<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class BooksController extends AbstractController
{
    /** @var BookRepository $bookRepository */
    private $bookRepository;

    /**
     * @Route("/books/add", name="book_add")
     */
    public function addBook(Request $request, Slugify $slugify)
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $book->setSlug($slugify->slugify($book->getTitle()));
            $book->setCreatedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('book_add');
        }
        return $this->render('books/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @Route("/books", name="books")
     */
    public function books()
    {
        $books = $this->bookRepository->findAll();

        return $this->render('books/index.html.twig', [
           'books' => $books
        ]);
    }

    /**
     * @Route("/books/{slug}", name="book_show")
     */
    public function book(Book $book)
    {
        return $this->render('books/show.html.twig', [
            'book' => $book
        ]);
    }
    
    
}
