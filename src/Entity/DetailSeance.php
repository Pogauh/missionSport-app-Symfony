<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DetailSeanceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource( 
    operations:[new Get(normalizationContext:['groups'=>'detailSeance:item']),
            new GetCollection(normalizationContext:['groups'=>'detailSeance:list']),
            new Post(),
    ])]


#[ORM\Entity(repositoryClass: DetailSeanceRepository::class)]
class DetailSeance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['detailSeance:list', 'detailSeance:item','user:list','user:item'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['detailSeance:list', 'detailSeance:item','seance:list','seance:item','user:list','user:item'])]
    private ?string $commentaire = null;

    #[ORM\Column]
    #[Groups(['detailSeance:list', 'detailSeance:item','seance:list','seance:item','user:list','user:item'])]
    private ?int $sets = null;

    #[ORM\Column]
    #[Groups(['detailSeance:list', 'detailSeance:item','seance:list','seance:item','user:list','user:item'])]
    private ?int $repetition = null;

    #[ORM\ManyToOne(inversedBy: 'detailSeances')]
    #[Groups(['detailSeance:list', 'detailSeance:item'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Seance $seance = null;

    #[ORM\ManyToOne(inversedBy: 'detailSeances')]
    #[Groups(['detailSeance:list', 'detailSeance:item','user:list','user:item'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Exercice $exercice = null;

   


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getSets(): ?int
    {
        return $this->sets;
    }

    public function setSets(int $sets): static
    {
        $this->sets = $sets;

        return $this;
    }

    public function getRepetition(): ?int
    {
        return $this->repetition;
    }

    public function setRepetition(int $repetition): static
    {
        $this->repetition = $repetition;

        return $this;
    }

    public function getSeance(): ?Seance
    {
        return $this->seance;
    }

    public function setSeance(?Seance $seance): static
    {
        $this->seance = $seance;

        return $this;
    }

    public function getExercice(): ?Exercice
    {
        return $this->exercice;
    }

    public function setExercice(?Exercice $exercice): static
    {
        $this->exercice = $exercice;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

}
