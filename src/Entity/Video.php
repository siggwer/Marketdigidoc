<?php

declare(strict_types=1);

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Video.
 *
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video
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
     * @ORM\ManyToOne(targetEntity="Document", inversedBy="videos")
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id", onDelete="CASCADE") //ajout JoinColumn pour la suppression
     */
    private $document;

    /**
     * @var string|null
     *
     * @Assert\NotBlank
     * @Assert\Url
     *
     * @ORM\Column(type="string")
     */
    private $url;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Document|null
     */
    public function getdocument(): ?document
    {
        return $this->document;
    }

    /**
     * @param Document|null $document
     */
    public function setdocument(?document $document): void
    {
        $this->document = $document;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }
}