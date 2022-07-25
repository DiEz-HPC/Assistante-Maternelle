<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[
        ORM\Column(length: 255),
        Assert\NotBlank(
            message: "Le nom est obligatoire"
        ),
        Assert\Length(
            min: 2,
            max: 255,
            minMessage: "Le nom doit faire au moins {{ limit }} caractères",
            maxMessage: "Le nom ne doit pas faire plus de {{ limit }} caractères"
        )
    ]
    private ?string $lastname = null;

    #[
        ORM\Column(length: 255),
        Assert\NotBlank(
            message: "Le prénom est obligatoire"
        ),
        Assert\Length(
            min: 2,
            max: 255,
            minMessage: "Le prénom doit faire au moins {{ limit }} caractères",
            maxMessage: "Le prénom ne doit pas faire plus de {{ limit }} caractères"
        )
    ]
    private ?string $firstname = null;

    #[
        ORM\Column(length: 255),
        Assert\NotBlank(
            message: "L'objet est obligatoire"
        ),
        Assert\Length(
            min: 5,
            max: 255,
            minMessage: "L'objet doit faire au moins {{ limit }} caractères",
            maxMessage: "L'objet ne doit pas faire plus de {{ limit }} caractères"
        )
    ]
    private ?string $object = null;

    #[
        ORM\Column(type: Types::TEXT),
        Assert\NotBlank(
            message: "Le message est obligatoire"
        ),
        Assert\Length(
            min: 5,
            max: 255,
            minMessage: "Le message doit faire au moins {{ limit }} caractères",
            maxMessage: "Le message ne doit pas faire plus de {{ limit }} caractères"
        )
    ]
    private ?string $message = null;

    #[
        ORM\Column(length: 255),
        Assert\NotBlank(
            message: "L'email est obligatoire"
        ),
        Assert\Email(
            message: "L'email n'est pas valide"
        )
    ]
    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getObject(): ?string
    {
        return $this->object;
    }

    public function setObject(string $object): self
    {
        $this->object = $object;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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
}
