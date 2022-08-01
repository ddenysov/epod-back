<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'datetime')]
    private $start_date;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $end_date;

    #[ORM\Column(type: 'json')]
    private $location;

    #[ORM\ManyToMany(targetEntity: Image::class, cascade: ['persist'])]
    private $images;

    public function __construct(array $params = [])
    {
        $this->images = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        //dd(debug_backtrace());
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return array
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param array $location
     * @return Event
     */
    public function setLocation($location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }
    public function addImage($image): self
    {
        if (is_array($image)) {
            $image = new Image($image);
        }

        if (!$this->images->contains($image)) {
            $this->images[] = $image;
        }
        return $this;
    }
    public function removeImage(Image $image): self
    {
        $this->images->removeElement($image);
        return $this;
    }
}
