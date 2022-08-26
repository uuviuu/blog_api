<?php

namespace App\Service;

use App\Entity\Post;
use App\Model\PostListItem;
use App\Model\PostListResponse;
use App\Repository\PostRepository;
use App\Repository\PostCategoryRepository;
use App\Exeption\PostCategoryNotFoundExeption;

class PostService
{
    private PostRepository $postRepository;
    private PostCategoryRepository $postCategoryRepository;

    public function __construct(PostRepository $postRepository, PostCategoryRepository $postCategoryRepository) {
        $this->postRepository = $postRepository;
        $this->postCategoryRepository = $postCategoryRepository;
    }

    public function getPostsByCategories(int $categoryId): PostListResponse 
    {
        $category = $this->postCategoryRepository->find($categoryId);
        if ($category ==  null){
            throw new PostCategoryNotFoundExeption();
        }

        return new PostListResponse(\array_map(
            [$this, 'map'],
            $this->postRepository->findPostsByCategoryId($categoryId)
        ));
    }

    private function map(Post $post): PostListItem
    {
        return (new PostListItem())
                ->setId($post->getId())
                ->setTitle($post->getTitle())
                ->setSlug($post->getSlug())
                ->setImage($post->getImage())
                ->setAuthors($post->getAuthors())
                ->setPublicationDate($post->getPublicationDate()->getTimestamp())
                ->setMeap($post->getMeap());     
    }
}