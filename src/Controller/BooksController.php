<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
// use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/books/search", name="book_search")
     */
    public function search(Request $request)
    {
        $query = $request->query->get('q');
        $books = $this->bookRepository->searchByQuery($query);

        return $this->render('books/query.html.twig', [
            'books' => $books
        ]);
    }

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
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugify->slugify($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $book->setImage($newFilename);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('books');
        }
        return $this->render('books/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/books/{slug}/edit", name="book_edit")
     */
    public function edit(Book $book, Request $request, Slugify $slugify)
    {
         $form = $this->createForm(BookType::class, $book);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            $book->setSlug($slugify->slugify($book->getTitle()));
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugify->slugify($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $book->setImage($newFilename);
            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('book_show', [
                'slug' => $book->getSlug()
            ]);
         }

         return $this->render('books/add.html.twig', [
             'form' => $form->createView()
         ]);
    }

    /**
     * @Route("/books/{slug}/delete", name="book_delete")
     */
    public function delete(Book $book)
    {     
        $em = $this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();

        return $this->redirectToRoute('books');
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
}
