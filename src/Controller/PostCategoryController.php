<?php

namespace App\Controller;

use OpenApi\Annotations as OA;
use App\Service\PostCategoryService;
use App\Model\PostCategoryListResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class PostCategoryController extends AbstractController
{
    private PostCategoryService $postCategoryService;

    public function __construct(PostCategoryService $postCategoryService)
    {
        $this->postCategoryService = $postCategoryService;
    }

    /**
     * @OA\Response(
     *    response=200, 
     *    description="Return post categories",
     *    @Model(type=PostCategoryListResponse::class)
     * )
     *
     * @Route("/api/v1/blog/categories", name="categories", methods={"GET"})
     */
    public function categories(): Response
    {
        return $this->json($this->postCategoryService->getCategories());
    }
}
