<?php
/*
    Идея этого Entity взята у X-CART (в админке настройка модуля)
    там такая таблица заполняется при установке модуля, инфа берется из его конфига,
    но также можно задать классы полей как стандартные (Text, Input, Select, Checkbox),
    так и свои. Получалось очень удобно и красиво. Здесь, как я понял, можно подсунуть 
    twig и обработчики в Sonata Admin, а также реализовать подгрузку этой настройки
    (с выбором типа таблицы), но мозг взорван, поэтому реализовал через ImSettings
*/
namespace App\Entity;

use App\Repository\ImConfigRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImConfigRepository::class)
 */
class ImConfig
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $type;

    /**
     * @ORM\Column(type="text")
     */
    private $value;

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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
