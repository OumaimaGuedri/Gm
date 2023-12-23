<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_cmd = null;



    #[ORM\OneToMany(mappedBy: 'cmd', targetEntity: ListeCommande::class)]
    private Collection $listeCommandes;

    #[ORM\ManyToOne(inversedBy: 'user_cmd')]
    private ?User $user = null;

    public function __construct()
    {
        $this->listeCommandes = new ArrayCollection();
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

    public function getDateCmd(): ?\DateTimeInterface
    {
        return $this->date_cmd;
    }

    public function setDateCmd(\DateTimeInterface $date_cmd): static
    {
        $this->date_cmd = $date_cmd;

        return $this;
    }



    /**
     * @return Collection<int, ListeCommande>
     */
    public function getListeCommandes(): Collection
    {
        return $this->listeCommandes;
    }

    public function addListeCommande(ListeCommande $listeCommande): static
    {
        if (!$this->listeCommandes->contains($listeCommande)) {
            $this->listeCommandes->add($listeCommande);
            $listeCommande->setCmd($this);
        }

        return $this;
    }

    public function removeListeCommande(ListeCommande $listeCommande): static
    {
        if ($this->listeCommandes->removeElement($listeCommande)) {
            // set the owning side to null (unless already changed)
            if ($listeCommande->getCmd() === $this) {
                $listeCommande->setCmd(null);
            }
        }

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



}
