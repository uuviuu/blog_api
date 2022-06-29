<?php

namespace App\Controller;

use App\Service\PostCategoryService;
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
     * Выводит все категории из таблицы PostCategory.
     *
     * @Route("/api/vi/blog/categories", name="categories", methods={"GET"})
     */
    public function categories(): Response
    {
        return $this->json($this->postCategoryService->getCategories());
    }
}
