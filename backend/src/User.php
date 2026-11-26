<?php
namespace App;

class User
{
    private string $name;
    private array $collection = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addToCollection(Media $media): void
    {
        $this->collection[] = $media;
    }

    public function showCollection(): void
    {
        echo "Collection of {$this->name}" . PHP_EOL;

        foreach ($this->collection as $media) {
            echo "- " . $media->getTitle() . PHP_EOL;
        }
    }
}
