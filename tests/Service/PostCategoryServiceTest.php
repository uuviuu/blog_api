<?php

namespace App\Tests\Service;

use App\Entity\PostCategory;
use App\Tests\AbstractTestCase;
use App\Model\PostCategoryListItem;
use App\Service\PostCategoryService;
use App\Model\PostCategoryListResponse;
use App\Repository\PostCategoryRepository;

class PostCategoryServiceTest extends AbstractTestCase
{
    public function testGetCategories(): void
    {
        $category = (new PostCategory())->setTitle('Test')->setSlug('test');
        $this->setEntityId($category, 7);

        $repository = $this->createMock(PostCategoryRepository::class);
        $repository->expects($this->once())
            ->method('findAllSortedByTitle')
            ->willReturn([$category]);

        $service = new PostCategoryService($repository);
        $expected = new PostCategoryListResponse([new PostCategoryListItem(7, 'Test', 'test')]);

        $this->assertEquals($expected, $service->getCategories());
    }
}
