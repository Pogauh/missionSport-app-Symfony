<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MuscleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource( 
    operations:[new Get(normalizationContext:['groups'=>'muscle:item']),
            new GetCollection(normalizationContext:['groups'=>'muscle:list']),
    ])]

    
#[ORM\Entity(repositoryClass: MuscleRepository::class)]
class Muscle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[groups(['muscle:list','muscle:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    #[groups(['muscle:list','muscle:item'])]
    private ?string $nom = null;


    public function __construct()
    {
        $this->exercices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
}
