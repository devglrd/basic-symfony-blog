<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $title;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subtitle;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $intro;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fk_file_id;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $fk_user_id;
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    public function setTitle(string $title): self
    {
        $this->title = $title;
        
        return $this;
    }
    
    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }
    
    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;
        
        return $this;
    }
    
    public function getIntro(): ?string
    {
        return $this->intro;
    }
    
    public function setIntro(?string $intro): self
    {
        $this->intro = $intro;
        
        return $this;
    }
    
    public function getContent(): ?string
    {
        return $this->content;
    }
    
    public function setContent(?string $content): self
    {
        $this->content = $content;
        
        return $this;
    }
    
    public function getFkFileId(): ?int
    {
        return $this->fk_file_id;
    }
    
    public function setFkFileId(?int $fk_file_id): self
    {
        $this->fk_file_id = $fk_file_id;
        
        return $this;
    }
    
    public function getFkUserId(): ?int
    {
        return $this->fk_user_id;
    }
    
    public function setFkUserId(int $fk_user_id): self
    {
        $this->fk_user_id = $fk_user_id;
        
        return $this;
    }
}
