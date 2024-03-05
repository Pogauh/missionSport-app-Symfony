<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

    #[ApiResource( 
    operations:[new Get(normalizationContext:['groups'=>'exercice:item']),
            new GetCollection(normalizationContext:['groups'=>'exercice:list']),
    ])]

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['exercice:list','exercice:item','detailSeance:list','detailSeance:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    #[Groups(['exercice:list','exercice:item','detailSeance:list','detailSeance:item','user:list','user:item'])]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['exercice:list','exercice:item','detailSeance:list','detailSeance:item','user:list','user:item'])]
    private ?string $description = null;

    #[ORM\OneToMany(targetEntity: DetailSeance::class, mappedBy: 'exercice')]
    private Collection $detailSeances;

    public function __construct()
    {
        $this->detailSeances = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, DetailSeance>
     */
    public function getDetailSeances(): Collection
    {
        return $this->detailSeances;
    }

    public function addDetailSeance(DetailSeance $detailSeance): static
    {
        if (!$this->detailSeances->contains($detailSeance)) {
            $this->detailSeances->add($detailSeance);
            $detailSeance->setExercice($this);
        }

        return $this;
    }

    public function removeDetailSeance(DetailSeance $detailSeance): static
    {
        if ($this->detailSeances->removeElement($detailSeance)) {
            // set the owning side to null (unless already changed)
            if ($detailSeance->getExercice() === $this) {
                $detailSeance->setExercice(null);
            }
        }

        return $this;
    }
}
