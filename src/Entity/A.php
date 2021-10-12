<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table
 * @ORM\Entity
 */
class A
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
     * @var B[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\B", mappedBy="a", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $bs;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tesxt", type="string", nullable=true)
     */
    private $text;

    public function __construct()
    {
        $this->bs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Collection<int, B>
     */
    public function getBs(): Collection
    {
        return $this->bs;
    }

    public function addB(B $b): self
    {
        $this->bs[] = $b;

        return $this;
    }

    public function removeB(B $b): self
    {
        $this->bs->removeElement($b);

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }
}