<?php

namespace App\Entity;

use DateTimeInterface;
use App\Entity\PostCategory;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    #[ORM\Column(type: 'string', length: 255)]
    private string $slug;

    #[ORM\Column(type: 'string', length: 255)]
    private string $image;

    #[ORM\Column(type: 'simple_array')]
    private array $authors;

    #[ORM\Column(type: 'date')]
    private DateTimeInterface $publicationDate;

    #[ORM\Column(type: 'boolean', options: ['default'=>false] )]
    private bool $meap;

    /**
     * @var Collection<PostCategory>
     */
    #[ORM\ManyToMany(targetEntity: PostCategory::class)]
    private Collection $categories;

    public function __construct()
    {
        return $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug($slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function setAuthors($authors): self
    {
        $this->authors = $authors;

        return $this;
    }

    public function getPublicationDate(): DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate($publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getMeap(): bool
    {
        return $this->meap;
    }

    public function setMeap($meap): self
    {
        $this->meap = $meap;

        return $this;
    }

    /**
     * @var Collection<PostCategory>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @var Collection<PostCategory>
     */
    public function setCategories(Collection $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
}
