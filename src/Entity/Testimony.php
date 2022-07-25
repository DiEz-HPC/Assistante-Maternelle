<?php

namespace App\Entity;

use App\Repository\TestimonyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TestimonyRepository::class)]
class Testimony
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255),
        Assert\NotBlank,
        Assert\Length(
            min: 2,
            max: 255,
            minMessage: "Le nom doit faire au moins {{ limit }} caractères",
            maxMessage: "Le nom ne doit pas faire plus de {{ limit }} caractères"
        )
    ]
    private ?string $name = null;

    #[ORM\Column(length: 255),
    Assert\Email(
        message: "L'email {{ value }} n'est pas valide"
    ),
    Assert\NotBlank]
    private ?string $email = null;

    #[ORM\Column,
    Assert\Range(
        min: 0,
        max: 5,
        notInRangeMessage: "Votre note doit être comprise entre {{ min }} et {{ max }}. Vous avez noté {{ value }}.",
    ),
    Assert\NotBlank,
    ]
    private ?int $rate = null;

    #[ORM\Column(type: Types::TEXT),
    Assert\NotBlank,
    ]
    private ?string $comment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
