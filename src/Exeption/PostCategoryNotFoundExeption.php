<?php

namespace App\Exeption;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class PostCategoryNotFoundExeption extends RuntimeException
{
    public function __construct() {
        parent::__construct('post category not found', Response::HTTP_NOT_FOUND);
    }
}