<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table
 * @ORM\Entity
 */
class C
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
     * @var B
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\B", inversedBy="cs")
     */
    private $b;

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

    public function getB(): B
    {
        return $this->b;
    }

    public function setB(B $b): self
    {
        $this->b = $b;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}