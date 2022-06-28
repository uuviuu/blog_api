<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/posts", name="posts_")
 */
class PostController extends AbstractController
{
    private PostRepository $postRepository;
    private EntityManagerInterface $em;

    public function __construct(PostRepository $postRepository, EntityManagerInterface $em)
    {
        $this->postRepository = $postRepository;
        $this->em = $em;
    }

    /**
     * Выводит все посты из таблицы Post.
     *
     * @Route("", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        $posts = $this->postRepository->findAll();

        return $this->json($posts);
    }

    /**
     * Создает новый пост в таблице Post.
     *
     * @Route("/create", name="create", methods={"GET", "POST"})
     */
    public function create(): Response
    {
        $post = new Post();
        $post->setTitle('Create Post');

        $this->em->persist($post);
        $this->em->flush();

        return new Response();
    }

    //     return $this->renderForm('blog/create.html.twig', [
    //         'form' => $form,
    //     ]);
    // }

    // /**
    //  * @Route("/{slug}", name="show", methods={"GET"})
    //  */
    // public function show(Blog $post): Response
    // {
    //     return $this->render('blog/detail.html.twig', [
    //         'post' => $post,
    //     ]);
    // }

    // /**
    //  * @Route("/{slug}/edit", name="edit", methods={"GET", "POST"})
    //  */
    // public function edit(Request $request, Blog $post, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(BlogType::class, $post);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();
    //         $this->addFlash('success', 'post.updated_successfully');

    //         return $this->redirectToRoute('blog_edit', ['slug' => $post->getSlug()]);
    //     }
    //     return $this->render('blog/edit.html.twig', [
    //         'post' => $post,
    //         'form' => $form->createView(),
    //     ]);
    // }

    // /**
    //  * @Route("/{slug}/delete", name="delete", methods={"POST"})
    //  */
    // public function delete(Request $request, Blog $post, EntityManagerInterface $entityManager): Response
    // {
    //     if (!$this->isCsrfTokenValid('delete', $request->request->get('token'))) {
    //         return $this->redirectToRoute('blog_all');
    //     }

    //     $entityManager->remove($post);
    //     $entityManager->flush();
    //     $this->addFlash('success', 'post.deleted_successfully');

    //     return $this->redirectToRoute('blog_all');
    // }
}
