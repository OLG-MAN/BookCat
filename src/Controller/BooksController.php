<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    /** @var BookRepository $bookRepository */
    private $bookRepository;

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
