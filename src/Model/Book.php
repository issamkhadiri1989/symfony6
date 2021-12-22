<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Book
{
    /**
     * The book's name must not be null neither blank.
     *
     * @Assert\NotBlank(message="You must provide a name to the book", normalizer="trim")
     * @Assert\NotNull(message="The book's name is mandatory")
     */
    private ?string $name;

    /**
     * The book's description must not blank and its length should be between 30 and 300 characters.
     *
     * @Assert\NotBlank
     * @Assert\Length(min=30, max=300)
     */
    private ?string $description;

    /**
     * The number of pages must be a n integer and of course greater than 0.
     *
     * @Assert\Type(type="integer")
     * @Assert\GreaterThan(0)
     */
    private int $numberOfPages;

    /**
     * Assuming that the edition date is older by 5 weeks and a dummy test with the current date.
     *
     * @Assert\LessThan("-5 weeks")
     * @Assert\LessThan("today")
     */
    private \DateTimeInterface $editionDate;

    /**
     * The publish date must be greater than the publish date.
     *
     * @Assert\GreaterThan(propertyPath="editionDate")
     */
    private \DateTimeInterface $publishDate;

    /**
     * The ISBN should be a valid ISBN13.
     *
     * @Assert\Isbn(type="isbn13", isbn13Message="This ISBN is not valid")
     */
    private ?string $isbn;

    /**
     * We need to check that the store state is either `InStore` or `OutStore` constants only.
     *
     * @Assert\Choice(choices={"OutStore", "InStore"}, message="State not valide.")
     */
    private ?string $state;

    /**
     * Assume that the store manage only those 3 types of books.
     *
     * @Assert\Choice({"fiction", "drama", "adventure"})
     */
    private ?string $type;

    /**
     * Because the store could contain no book, let's assume that we could had >= 0 examples.
     *
     * @Assert\GreaterThanOrEqual(0)
     */
    private int $quantityInStore;

    /**
     * Example of how to parse a valid float number using regex.
     *
     * @Assert\Regex(
     *     pattern="/^\d{0,8}(\.\d{1,4})?$/",
     *     message="The price you provided is not valid"
     * )
     */
    private mixed $sellPrice;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getNumberOfPages(): int
    {
        return $this->numberOfPages;
    }

    public function setNumberOfPages(int $numberOfPages): void
    {
        $this->numberOfPages = $numberOfPages;
    }

    public function getEditionDate(): \DateTimeInterface
    {
        return $this->editionDate;
    }

    public function setEditionDate(\DateTimeInterface $editionDate): void
    {
        $this->editionDate = $editionDate;
    }

    public function getPublishDate(): \DateTimeInterface
    {
        return $this->publishDate;
    }

    public function setPublishDate(\DateTimeInterface $publishDate): void
    {
        $this->publishDate = $publishDate;
    }

    public function setSellPrice(mixed $sellPrice): void
    {
        $this->sellPrice = $sellPrice;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getQuantityInStore(): int
    {
        return $this->quantityInStore;
    }

    public function setQuantityInStore(int $quantityInStore): void
    {
        $this->quantityInStore = $quantityInStore;
    }
}
