<?php

namespace App\Controller;

use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Service\PostService;
use App\Model\PostListResponse;
use App\Exeption\PostCategoryNotFoundExeption;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// /**
//  * @Route("/posts", name="posts_")
//  */
class PostController extends AbstractController
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @OA\Response(
     *    response=200, 
     *    description="Return posts inside a category",
     *    @Model(type=PostListResponse::class)
     * )
     *
     * @Route("/api/v1/category/{id}/posts", name="index", methods={"GET"})
     */
    public function index(int $id): Response
    {
        try{
            $posts = $this->postService->getPostsByCategories($id);
            return $this->json($posts);
        }catch (PostCategoryNotFoundExeption $exeption){
            throw new HttpException($exeption->getCode(), $exeption->getMessage());
        }
        
    }

    // /**
    //  * Создает новый пост в таблице Post.
    //  *
    //  * @Route("/create", name="create", methods={"GET", "POST"})
    //  */
    // public function create(): Response
    // {
    //     $post = new Post();
    //     $post->setTitle('Create Post');

    //     $this->em->persist($post);
    //     $this->em->flush();

    //     return new Response();
    // }

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
