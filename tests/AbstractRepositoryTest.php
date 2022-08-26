<?php

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class AbstractRepositoryTest extends KernelTestCase
{
    protected ?EntityManagerInterface $em;
   
    protected function setUp(): void
    {
        parent::setUp();

        $this->em = self::getContainer()->get('doctrine.orm.entity_manager');
    }

   !!!!!!! 32:38 Больше тестов и настройка IDE !!!!!

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->em->close;
        $this->em = null;
    }
}
