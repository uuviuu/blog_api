<?php

namespace App\Service;

use App\Entity\PostCategory;
use App\Model\PostCategoryListItem;
use App\Model\PostCategoryListResponse;
use App\Repository\PostCategoryRepository;

class PostCategoryService
{
    private PostCategoryRepository $postCategoryRepository;

    public function __construct(PostCategoryRepository $postCategoryRepository) {
        $this->postCategoryRepository = $postCategoryRepository;
    }

    public function getCategories(): PostCategoryListResponse 
    {
        $categories = $this->postCategoryRepository->findAllSortedByTitle();
        $items = array_map(
            fn (PostCategory $postCategory) => new PostCategoryListItem(
                $postCategory->getId(), 
                $postCategory->getTitle(), 
                $postCategory->getSlug()
            ),
            $categories
        );

        return new PostCategoryListResponse($items);
    }
}