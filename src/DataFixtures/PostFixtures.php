<?php

namespace App\DataFixtures;

use App\Entity\Post;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $androidCategory = $this -> getReference(PostCategoryFixtures::ANDROID_CATEGORY);
        $devicesCategory = $this -> getReference(PostCategoryFixtures::DEVICES_CATEGORY);

        $post = (new Post())
                ->setTitle('Android Title')
                ->setSlug('android-title')
                ->setAuthors(['Niko Logviny', 'Timoty'])
                ->setImage('https://upload.wikimedia.org/wikipedia/commons/thumb/3/31/Android_robot_head.svg/182px-Android_robot_head.svg.png')
                ->setPublicationDate(new DateTime('2022-07-27'))
                ->setMeap(false)
                ->setCategories(new ArrayCollection([$androidCategory, $devicesCategory]));

        $manager->persist($post);
        $manager->flush();
    }
    
    public function getDependencies(): array
    {
        return[ 
            PostCategoryFixtures::class
        ];
    }
}
