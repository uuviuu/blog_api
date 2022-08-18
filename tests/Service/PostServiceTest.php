<?php

namespace App\Tests\Service;

use DateTime;
use App\Entity\Post;
use App\Model\PostListItem;
use App\Entity\PostCategory;
use App\Service\PostService;
use App\Model\PostListResponse;
use PHPUnit\Framework\TestCase;
use App\Repository\PostRepository;
use App\Repository\PostCategoryRepository;
use App\Exeption\PostCategoryNotFoundExeption;
use Doctrine\Common\Collections\ArrayCollection;

class PostServiceTest extends TestCase
{
    public function testGetPostByCategoryNotFound(): void
    {
        $postRepository = $this->createMock(PostRepository::class);
        $postCategoryRepository = $this->createMock(PostCategoryRepository::class);

        $postCategoryRepository->expects($this->once())
            ->method('find')
            ->with(130)
            ->willThrowException(new PostCategoryNotFoundExeption());

        $this->expectException(PostCategoryNotFoundExeption::class);

        (new PostService($postRepository, $postCategoryRepository))->getPostsByCategories(130);
    }

    public function testGetPostByCategory(): void
    {
        $postRepository = $this->createMock(PostRepository::class);
        $postRepository->expects($this->once())
            ->method('findPostsByCategoryId')
            ->with(130)
            ->willReturn([$this->createPostEntity()]);

        $postCategoryRepository = $this->createMock(PostCategoryRepository::class);
        $postCategoryRepository->expects($this->once())
            ->method('find')
            ->with(130)
            ->willReturn(new PostCategory);

        $service = new PostService($postRepository, $postCategoryRepository);
        $expected = new PostListResponse([$this->createPostItemModel()]);

        $this->assertEquals($expected, $service->getPostsByCategories(130));
        
    }

    private function createPostEntity(): Post
    {
        return (new Post)
            ->setId(123)
            ->setTitle('SetPost')
            ->setSlug('set-post')
            ->setImage('https://d5nunyagcicgy.cloudfront.net/external_assets/hero_examples/hair_beach_v391182663/original.jpeg')
            ->setAuthors(['N.'])
            ->setPublicationDate(new DateTime('2022-07-29'))
            ->setMeap(false)
            ->setCategories(new ArrayCollection());
    }

    private function createPostItemModel(): PostListItem
    {
        return (new PostListItem)
            ->setId(123)
            ->setTitle('SetPost')
            ->setSlug('set-post')
            ->setImage('https://d5nunyagcicgy.cloudfront.net/external_assets/hero_examples/hair_beach_v391182663/original.jpeg')
            ->setAuthors(['N.'])
            ->setPublicationDate(1659052800)
            ->setMeap(false);
    }
}
