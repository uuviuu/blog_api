<?php

namespace App\DataFixtures;

use App\Entity\PostCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist((new PostCategory())->setTitle('Data')->setSlug('data'));
        $manager->persist((new PostCategory())->setTitle('Cat')->setSlug('cat'));
        $manager->persist((new PostCategory())->setTitle('Dog')->setSlug('dog'));

        $manager->flush();
    }
}
