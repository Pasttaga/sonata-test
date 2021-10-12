<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table
 * @ORM\Entity
 */
class B
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
     * @var A
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\A", inversedBy="bs")
     */
    private $a;

    /**
     * @var C[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\C", mappedBy="b", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $cs;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tesxt", type="string", nullable=true)
     */
    private $text;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function __construct()
    {
        $this->cs = new ArrayCollection();
    }

    public function getA(): A
    {
        return $this->a;
    }

    public function setA(A $a): self
    {
        $this->a = $a;

        return $this;
    }

    /**
     * @return Collection<int, C>
     */
    public function getCs(): Collection
    {
        return $this->cs;
    }

    public function addC(C $c): self
    {
        $this->cs[] = $c;

        return $this;
    }

    public function removeC(C $c): self
    {
        $this->cs->removeElement($c);

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