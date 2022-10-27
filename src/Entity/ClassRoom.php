<?php

namespace App\Entity;

use App\Repository\ClassRoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassRoomRepository::class)]
class ClassRoom
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $NbrStudent = null;

    #[ORM\OneToMany(mappedBy: 'classRoom', targetEntity: Student::class)]
    private Collection $Student;

    public function __construct()
    {
        $this->Student = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNbrStudent(): ?int
    {
        return $this->NbrStudent;
    }

    public function setNbrStudent(int $NbrStudent): self
    {
        $this->NbrStudent = $NbrStudent;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudent(): Collection
    {
        return $this->Student;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->Student->contains($student)) {
            $this->Student->add($student);
            $student->setClassRoom($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->Student->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getClassRoom() === $this) {
                $student->setClassRoom(null);
            }
        }

        return $this;
    }

    /*public function __toString()
    {
        return (string)$this->getName(); //sinon fel twig nforciw naamlou f.classroom.name
    }*/
}
