<?php

namespace App\Entity;

use App\Repository\CategoriasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriasRepository::class)]
class Categorias
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'Habitacion', targetEntity: Reservaciones::class)]
    private Collection $reservaciones;

    public function __construct()
    {
        $this->reservaciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Reservaciones>
     */
    public function getReservaciones(): Collection
    {
        return $this->reservaciones;
    }

    public function addReservacione(Reservaciones $reservacione): self
    {
        if (!$this->reservaciones->contains($reservacione)) {
            $this->reservaciones->add($reservacione);
            $reservacione->setHabitacion($this);
        }

        return $this;
    }

    public function removeReservacione(Reservaciones $reservacione): self
    {
        if ($this->reservaciones->removeElement($reservacione)) {
            // set the owning side to null (unless already changed)
            if ($reservacione->getHabitacion() === $this) {
                $reservacione->setHabitacion(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this-> type;
    
    }
}
