<?php

namespace App\DataFixtures;

use App\Entity\PostCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostCategoryFixtures extends Fixture
{
    public const ANDROID_CATEGORY = 'android';
    public const DEVICES_CATEGORY = 'devices';
    // public const DATA_CATEGORY = 'data';

    public function load(ObjectManager $manager): void
    {
        $categories = [
            self::DEVICES_CATEGORY => (new PostCategory())
                                        ->setTitle('Devices')
                                        ->setSlug('devices'),
            self::ANDROID_CATEGORY => (new PostCategory())
                                        ->setTitle('Android')
                                        ->setSlug('android'),     
            // self::DATA_CATEGORY => (new PostCategory())
            //                             ->setTitle('Data')
            //                             ->setSlug('data'),
        ];

        foreach ($categories as $category){
            $manager->persist($category);
        }

        $manager->persist((new PostCategory())
            ->setTitle('Data')
            ->setSlug('data'));
        $manager->flush();

        foreach ($categories as $code => $category){
            $this->addReference($code, $category);
        }
    }
}
