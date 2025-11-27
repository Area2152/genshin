<?php

namespace Models;

class Personnage
{
    private string $id;
    private string $name;
    private ?Element $element = null;
    private ?Unitclass $unitclass = null;
    private ?Origin $origin = null;
    private int $rarity;
    private string $urlImg;

    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {

            if (in_array($key, ['element', 'unitclass', 'origin'], true)) {
                continue;
            }

            if ($key === 'url_img') {
                $key = 'urlImg';
            }

            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getElement(): ?Element
    {
        return $this->element;
    }

    public function setElement(?Element $element): void
    {
        $this->element = $element;
    }

    public function getUnitclass(): ?Unitclass
    {
        return $this->unitclass;
    }

    public function setUnitclass(?Unitclass $unitclass): void
    {
        $this->unitclass = $unitclass;
    }

    public function getOrigin(): ?Origin
    {
        return $this->origin;
    }

    public function setOrigin(?Origin $origin): void
    {
        $this->origin = $origin;
    }

    public function getRarity(): int
    {
        return $this->rarity;
    }

    public function setRarity(int $rarity): void
    {
        $this->rarity = $rarity;
    }

    public function getUrlImg(): string
    {
        return $this->urlImg;
    }

    public function setUrlImg(string $urlImg): void
    {
        $this->urlImg = $urlImg;
    }
}
