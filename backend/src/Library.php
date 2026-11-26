<?php
// Class ini bertanggung jawab mengelola semua media di FlipPlay.
namespace App;
class Library
{
    private array $mediaList = [];

    // menambahkan film atau series ke library
    public function addMedia(Media $media): void
    {
        $this->mediaList[] = $media;
    }

    // menampilkan semua media
    public function showAllMedia(): void
    {
        echo "=== FLIPPLAY MEDIA LIBRARY ===" . PHP_EOL;

        foreach ($this->mediaList as $media) {
            echo $media->getDetails() . PHP_EOL;
        }
    }

    // mencari berdasarkan judul
    // ?Media berarti method bisa mengembalikan objek Media atau null
    // stripos() mencari teks tanpa membedakan huruf besar dan kecil.
    public function searchMedia(string $keyword): ?Media
    {
        foreach ($this->mediaList as $media) {
            if (stripos($media->getTitle(), $keyword) !== false) {
                return $media;
            }
        }

        return null;
    }

    public function showMediaDetail(string $title): void
    {
        $media = $this->searchMedia($title);

        if ($media !== null) {
            echo "Media Detail" . PHP_EOL;
            echo $media->getDetails() . PHP_EOL;
            echo $media->getDescription() . PHP_EOL;
        } else {
            echo "Media not found." . PHP_EOL;
        }
    }
}