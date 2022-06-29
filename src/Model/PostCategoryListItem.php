<?php

namespace App\Model;

class PostCategoryListItem
{
    private int $id;
    private string $title;
    private string $slug;

    public function __construct(int $id, string $title, string $slug) {
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }


}