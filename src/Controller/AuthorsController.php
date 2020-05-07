<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AuthorsController extends AbstractController
{
    /** @var AuthorRepository $authorRepository */
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @Route("/authors/search", name="author_search")
     */
    public function search(Request $request)
    {
        $query = $request->query->get('author');
        $authors = $this->authorRepository->searchByQuery($query);

        return $this->render('authors/query.html.twig', [
            'authors' => $authors
        ]);
    }

    /**
     * @Route("/authors/add", name="author_add")
     */
    public function addAuthor(Request $request, Slugify $slugify)
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $author->setSlug($slugify->slugify($author->getSecondName()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();

            return $this->redirectToRoute('authors');
        }
        return $this->render('authors/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/authors/{slug}/edit", name="author_edit")
     */
    public function edit(Author $author, Request $request, Slugify $slugify)
    {
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $author->setSlug($slugify->slugify($author->getSecondName()));
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('authors', [
                'slug' => $author->getSlug()
            ]);
        }

        return $this->render('authors/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/authors/{slug}/delete", name="author_delete")
     */
    public function delete(Author $author)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($author);
        $em->flush();

        return $this->redirectToRoute('authors');
    }

    /**
     * @Route("/authors/{slug}", name="author_show")
     */
    public function author(Author $author)
    {
        return $this->render('authors/show.html.twig', [
            'author' => $author
        ]);
    }

    /**
     * @Route("/authors", name="authors")
     */
    public function authors()
    {
        $authors = $this->authorRepository->findAll();

        return $this->render('authors/index.html.twig', [
            'authors' => $authors
        ]);
    }
}
