<?php
namespace App;

class Movie extends Media
{
    private int $duration;

    public function __construct(
        string $title,
        string $creator,
        string $description,
        int $duration
    ) {
        // SCOPE parent merujuk pada class induk, yaitu Media. _constuct manggil constructor pnya Media
        parent::__construct($title, $creator, $description);
        $this->duration = $duration;
    }

    public function getDetails(): string
    {
        // string interpolation: masukin nilai variabel ke string
        return "{$this->title} by {$this->creator} - {$this->duration} minutes";
    }
}