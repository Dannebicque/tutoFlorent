<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Post;
use App\Form\CategoryType;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post/new', name: 'app_category_new')]
    public function createCategory(EntityManagerInterface $entityManager, Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_category', ['categorie' => $post->getCategory()->getId()]);//redirection
        }


        return $this->render('post/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/post/show', name: 'post_show')]
    public function show(Request $request, PostRepository $postRepository)
    {
        $post = $postRepository->find($request->query->get('id'));

        return $this->json([
            'id' => $post->getId(),
            'titre' => $post->getTitre(),
            'date' => $post->getDatepublication()->format('d/m/Y'),
            'category' => $post->getCategory()->getLibelle()
        ]);
    }


}
