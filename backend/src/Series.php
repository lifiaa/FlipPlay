<?php
namespace App;
class Series extends Media
{
    private int $episodes;

    public function __construct(
        string $title,
        string $creator,
        string $description,
        int $episodes
    ) {
        parent::__construct($title, $creator, $description);
        $this->episodes = $episodes;
    }

    // polymorphism: method getDetails() memiliki nama yang sama, tetapi implementasinya berbeda pada setiap class turunan aka Movie
    public function getDetails(): string
    {
        return "{$this->title} by {$this->creator} - {$this->episodes} episodes";
    }
}