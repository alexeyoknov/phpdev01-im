<?php

namespace App\Entity;

use App\Repository\ImSettingsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImSettingsRepository::class)
 */
class ImSettings
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $useNestedTable = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUseNestedTable(): ?bool
    {
        return $this->useNestedTable;
    }

    public function setUseNestedTable(bool $useNestedTable): self
    {
        $this->useNestedTable = $useNestedTable;

        return $this;
    }
}
