<?php

namespace App\Model;

class PostListResponse
{
    /**
     * @var PostListItem[]
     */
    private array $items;

    /**
     * @param PostListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return PostListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
