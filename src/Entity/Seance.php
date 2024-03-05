<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SeanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;



use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Symfony\Component\Serializer\Annotation\Groups;


#[ApiResource( 
    operations:[new Get(normalizationContext:['groups'=>'seance:item']),
            new GetCollection(normalizationContext:['groups'=>'seance:list']),
            new Post(),
    ])]

    

#[ORM\Entity(repositoryClass: SeanceRepository::class)]
class Seance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['detailSeance:list', 'detailSeance:item','seance:list','seance:item','user:list','user:item'])]
    
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['detailSeance:list', 'detailSeance:item','seance:list','seance:item','user:list','user:item'])]
    private ?int $duree = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['detailSeance:list', 'detailSeance:item','seance:list','seance:item','user:list','user:item'])]
    private ?string $commentaire = null;

    #[ORM\OneToMany(targetEntity: DetailSeance::class, mappedBy: 'seance')]
    #[ApiSubresource]
    #[Groups(['seance:list','seance:item','user:list','user:item'])]
    private Collection $detailSeances;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: false)]
    #[Groups(['detailSeance:list', 'detailSeance:item','seance:list','seance:item','user:list','user:item'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'seances')]
    #[Groups(['user:list','user:item'])]
    private ?Type $type = null;


    public function __construct()
    {
        $this->detailSeances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

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
            $detailSeance->setSeance($this);
        }

        return $this;
    }

    public function removeDetailSeance(DetailSeance $detailSeance): static
    {
        if ($this->detailSeances->removeElement($detailSeance)) {
            // set the owning side to null (unless already changed)
            if ($detailSeance->getSeance() === $this) {
                $detailSeance->setSeance(null);
            }
        }

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }

   
}
