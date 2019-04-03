<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task {
    /**
     * @var int 
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @var int 
     * @ORM\Column(type="integer")
     */
    private $userId;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=256) 
     */
    private $name;
    
    /**
     * @var boolean
     * @ORM\Column(type="boolean") 
     */
    private $done;
    
    /**
     * @param int $userId
     * @param string $name
     */
    function __construct(int $userId, string $name) {
        $this->userId = $userId;
        $this->name = $name;
        $this->done = false;
    }
    
    public function updateName(string $newName) {
        $this->name = $newName;
    }
    
    public function updateDescription(string $newDescription) {
        $this->description = $newDescription;
    }
    
    public function markDone() {
        $this->done = true;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function isDone(): bool {
        return $this->done;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

}
