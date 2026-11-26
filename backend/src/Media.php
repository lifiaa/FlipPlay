<?php
namespace App;
abstract class Media //class induk yang menjadi dasar film dan series.
{
    protected string $title; // bisa diakses oleh class turunan.
    protected string $creator;
    protected string $description;

    public function __construct( //mengisi data ketika objek dibuat.
        string $title,
        string $creator,
        string $description
    ) {
        $this->title = $title; //mengambil judul media.
        $this->creator = $creator;
        $this->description = $description;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCreator(): string
    {
        return $this->creator;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
    // wajib diimplementasikan oleh class turunannya.
    abstract public function getDetails(): string;
}