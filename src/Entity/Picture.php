<?php

declare(strict_types=1);

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
     * @var Document|null
     *
     * @ORM\ManyToOne(targetEntity="Document", inversedBy="pictures")
     * @ORM\JoinColumn(name="picture_id", referencedColumnName="id", onDelete="CASCADE") //ajout JoinColumn pour la supression
     */
    private $document;

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
     * @return Document|null
     */
    public function getDocument(): ?document
    {
        return $this->document;
    }

    /**
     * @param Document|null $document
     */
    public function setDocument(?Document $document): void
    {
        $this->document = $document;
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