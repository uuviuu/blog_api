<?php

namespace App\Tests\Service;

use App\Entity\PostCategory;
use App\Model\PostCategoryListItem;
use App\Model\PostCategoryListResponse;
use PHPUnit\Framework\TestCase;
use App\Repository\PostCategoryRepository;
use App\Service\PostCategoryService;
use Doctrine\Common\Collections\Criteria;

class PostCategoryServiceTest extends TestCase
{
    public function testGetCategories(): void
    {
        $repository = $this->createMock(PostCategoryRepository::class);
        $repository->expects($this->once())
            ->method('findBy')
            ->with([], ['title' => Criteria::ASC])
            ->willReturn([(new PostCategory())->setId(7)->setTitle('Test')->setSlug('test')]);

        $service = new PostCategoryService($repository);
        $expected = new PostCategoryListResponse([new PostCategoryListItem(7, 'Test', 'test')]);

        $this->assertEquals($expected, $service->getCategories());
    }
}
