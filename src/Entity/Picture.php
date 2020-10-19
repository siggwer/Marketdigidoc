<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
* class Picture.
*
* @ORM\Entity(repositoryClass="App\Repository\PictureRepository")
* @ORM\EntityListeners({"App\EntityListener\PictureListener"})
*/
class Picture
{
    /**
     * @var int|null
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var article|null
     *
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="pictures")
     * @ORM\JoinColumn(name="picture_id", referencedColumnName="id", onDelete="CASCADE") //ajout JoinColumn pour la supression
     */
    private $article;

    /**
     * @var string|null
     *
     * @Assert\NotBlank
     *
     * @ORM\Column(type="string")
     */
    private $alt;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private $path;

    /**
     * @var UploadedFile|null
     *
     * @Assert\NotNull(groups={"add"})
     */
    private $uploadedFile;

    /**
     * @return int|null
     *
     * @codeCoverageIgnore
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return article|null
     */
    public function getArticle(): ?article
    {
        return $this->article;
    }

    /**
     * @param article|null $article
     */
    public function setArticle(?article $article): void
    {
        $this->article = $article;
    }

    /**
     * @return string|null
     */
    public function getAlt(): ?string
    {
        return $this->alt;
    }

    /**
     * @param string|null $alt
     */
    public function setAlt(?string $alt): void
    {
        $this->alt = $alt;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param string|null $path
     */
    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return UploadedFile|null
     */
    public function getUploadedFile(): ?UploadedFile
    {
        return $this->uploadedFile;
    }

    /**
     * @param UploadedFile|null $uploadedFile
     */
    public function setUploadedFile(?UploadedFile $uploadedFile): void
    {
        $this->uploadedFile = $uploadedFile;
    }
}