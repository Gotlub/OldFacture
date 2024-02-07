<?php

namespace App\Entity;

use App\Repository\EngagementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EngagementRepository::class)]
class Engagement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotNull()]
    #[ORM\Column(length: 500)]
    private ?string $description = null;

    #[Assert\NotNull()]
    #[ORM\Column(length: 500)]
    private ?string $identifiant_PES = null;

    #[Assert\NotNull()]
    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[Assert\NotNull()]
    #[ORM\Column(length: 65535)]
    private ?string $code_entite = null;

    #[Assert\NotNull()]
    #[ORM\Column(length: 65535)]
    private ?string $libelle_entite = null;

    #[Assert\NotNull()]
    #[ORM\Column(length: 65535)]
    private ?string $element_rattache = null;

    #[Assert\NotNull()]
    #[ORM\Column]
    private ?int $exercice = null;

    #[Assert\NotNull()]
    #[ORM\Column(length: 65535)]
    private ?string $sens_et_numero;

    #[Assert\NotNull()]
    #[ORM\Column(length: 500)]
    private ?string $objet = null;

    #[ORM\Column]
    private ?int $dossierpj = null;

    #[Assert\NotNull()]
    #[ORM\Column(length: 100)]
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

    /**
     * Get the value of identifiant_PES
     *
     * @return ?string
     */
    public function getIdentifiantPES(): ?string
    {
        return $this->identifiant_PES;
    }

    /**
     * Set the value of identifiant_PES
     *
     * @param ?string $identifiant_PES
     *
     * @return self
     */
    public function setIdentifiantPES(?string $identifiant_PES): self
    {
        $this->identifiant_PES = $identifiant_PES;

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

    /**
     * Get the value of code_entite
     *
     * @return ?string
     */
    public function getCodeEntite(): ?string
    {
        return $this->code_entite;
    }

    /**
     * Set the value of code_entite
     *
     * @param ?string $code_entite
     *
     * @return self
     */
    public function setCodeEntite(?string $code_entite): self
    {
        $this->code_entite = $code_entite;

        return $this;
    }

    /**
     * Get the value of libelle_entite
     *
     * @return ?string
     */
    public function getLibelleEntite(): ?string
    {
        return $this->libelle_entite;
    }

    /**
     * Set the value of libelle_entite
     *
     * @param ?string $libelle_entite
     *
     * @return self
     */
    public function setLibelleEntite(?string $libelle_entite): self
    {
        $this->libelle_entite = $libelle_entite;

        return $this;
    }

    /**
     * Get the value of element_rattache
     *
     * @return ?string
     */
    public function getElementRattache(): ?string
    {
        return $this->element_rattache;
    }

    /**
     * Set the value of element_rattache
     *
     * @param ?string $element_rattache
     *
     * @return self
     */
    public function setElementRattache(?string $element_rattache): self
    {
        $this->element_rattache = $element_rattache;

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

    /**
     * Get the value of sens_et_numero
     *
     * @return ?string
     */
    public function getSensEtNumero(): ?string
    {
        return $this->sens_et_numero;
    }

    /**
     * Set the value of sens_et_numero
     *
     * @param ?string $sens_et_numero
     *
     * @return self
     */
    public function setSensEtNumero(?string $sens_et_numero): self
    {
        $this->sens_et_numero = $sens_et_numero;

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
