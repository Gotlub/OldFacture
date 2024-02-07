<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture")
 * @ORM\Entity
 */
class Facture
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="identifiant_PES", type="string", length=100, nullable=false)
     */
    private $identifiantPes;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="code_entite", type="text", length=65535, nullable=false)
     */
    private $codeEntite;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_entite", type="text", length=65535, nullable=false)
     */
    private $libelleEntite;

    /**
     * @var string
     *
     * @ORM\Column(name="element_rattache", type="text", length=65535, nullable=false)
     */
    private $elementRattache;

    /**
     * @var int
     *
     * @ORM\Column(name="exercice", type="integer", nullable=false)
     */
    private $exercice;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=500, nullable=false)
     */
    private $objet;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dossierpj", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $dossierpj = NULL;

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


}
