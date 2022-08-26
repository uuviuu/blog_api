<?php

namespace App\Model;

class PostCategoryListResponse
{
    /**
     * @var PostCategoryListItem[]
     */
    private array $items;

    /**
     * @param PostCategoryListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return PostCategoryListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
