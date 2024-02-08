<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotNull()]
    #[ORM\Column(length: 500)]
    private ?string $description = null;

    #[Assert\NotNull()]
    #[ORM\Column(name : "identifiant_PES", length: 100)]
    private ?string $identifiantPes = null;

    #[Assert\NotNull()]
    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[Assert\NotNull()]
    #[ORM\Column(name: "code_entite", length: 65535)]
    private ?string $codeEntite = null;

    #[Assert\NotNull()]
    #[ORM\Column(name: "libelle_entite", length: 65535)]
    private ?string $libelleEntite = null;

    #[Assert\NotNull()]
    #[ORM\Column(name: "element_rattache", length: 65535)]
    private ?string $elementRattache = null;

    #[Assert\NotNull()]
    #[ORM\Column()]
    private ?int $exercice = null;

    #[Assert\NotNull()]
    #[ORM\Column()]
    private ?int $numero = null;

    #[Assert\NotNull()]
    #[ORM\Column(length: 500)]
    private ?string $objet = null;

    #[ORM\Column()]
    private ?int $dossierpj = null;

    #[Assert\NotNull()]
    #[ORM\Column(name : "fichierpj", length: 100)]
    private ?string $fichierpj = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIdentifiantPes(): ?string
    {
        return $this->identifiantPes;
    }

    public function setIdentifiantPes(string $identifiantPes): self
    {
        $this->identifiantPes = $identifiantPes;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCodeEntite(): ?string
    {
        return $this->codeEntite;
    }

    public function setCodeEntite(string $codeEntite): self
    {
        $this->codeEntite = $codeEntite;

        return $this;
    }

    public function getLibelleEntite(): ?string
    {
        return $this->libelleEntite;
    }

    public function setLibelleEntite(string $libelleEntite): self
    {
        $this->libelleEntite = $libelleEntite;

        return $this;
    }

    public function getElementRattache(): ?string
    {
        return $this->elementRattache;
    }

    public function setElementRattache(string $elementRattache): self
    {
        $this->elementRattache = $elementRattache;

        return $this;
    }

    public function getExercice(): ?int
    {
        return $this->exercice;
    }

    public function setExercice(int $exercice): self
    {
        $this->exercice = $exercice;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getDossierpj(): ?int
    {
        return $this->dossierpj;
    }

    public function setDossierpj(?int $dossierpj): self
    {
        $this->dossierpj = $dossierpj;

        return $this;
    }

     /**
     * Get the value of fichierpj
     *
     * @return ?string
     */
    public function getFichierpj(): ?string
    {
        return $this->fichierpj;
    }

    /**
     * Set the value of fichierpj
     *
     * @param ?string $fichierpj
     *
     * @return self
     */
    public function setFichierpj(?string $fichierpj): self
    {
        $this->fichierpj = $fichierpj;

        return $this;
    }
}
