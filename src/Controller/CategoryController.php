<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/new', name: 'app_category_new')]
    public function createCategory(EntityManagerInterface $entityManager, Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('app_category', ['categorie' => $category->getId()]);//redirection
        }


        return $this->render('category/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/category/{categorie}', name: 'app_category')]
    public function index(Category  $categorie)
    {
        $posts = $categorie->getPosts();

        return $this->render('category/index.html.twig', [
            'categorie' => $categorie,
            'posts' => $posts
        ]);
    }



//    #[Route('/category2/{categorie}', name: 'app_category_2')]
//    public function index2(PostRepository $postRepository,  $category)
//    {
//        $posts = $postRepository->findBy(['category' => $category]);
//
//        return $this->render('category/index.html.twig', [
//            'category' => $category,
//            'posts' => $posts
//        ]);
//    }
}
