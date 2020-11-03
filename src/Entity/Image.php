<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;

    /**
     * @var UploadedFile
     *
     * @Assert\File(
     *     mimeTypes={"application/csv", "application/excel","application/vnd.ms-excel", "application/vnd.msexcel","text/csv", "text/anytext", "text/plain", "text/x-c", "text/comma-separated-values","inode/x-empty","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"},
     *     mimeTypesMessage="backoffice.article.image_extension"
     * )
     */
    private $file;

    /**
     * @var bool
     */
    private $deletedImage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    public function setFile(UploadedFile $file = null): self
    {
        $this->file = $file;

        return $this;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getAlt(): string
    {
        return $this->alt;
    }

    /**
     * @return bool
     */
    public function isDeletedImage(): ?bool
    {
        return $this->deletedImage;
    }

    public function setDeletedImage(bool $deletedImage): void
    {
        $this->deletedImage = $deletedImage;
    }
}
