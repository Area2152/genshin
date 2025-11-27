<?php

namespace Models;

use PDO;

class PersonnageDAO extends BasePDODAO
{
    public function getAllRaw(): array
    {
        $sql = 'SELECT * FROM personnage ORDER BY name';
        $stmt = $this->execRequest($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByIdRaw(string $id): ?array
    {
        $sql  = 'SELECT * FROM personnage WHERE id = :id';
        $stmt = $this->execRequest($sql, ['id' => $id]);
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }

    public function create(Personnage $perso): int
    {
        $sql = 'INSERT INTO personnage (id, name, element, unitclass, origin, rarity, url_img)
                VALUES (:id, :name, :element, :unitclass, :origin, :rarity, :url_img)';

        $params = [
            'id'        => $perso->getId(),
            'name'      => $perso->getName(),
            'element'   => $perso->getElement()?->getId(),
            'unitclass' => $perso->getUnitclass()?->getId(),
            'origin'    => $perso->getOrigin()?->getId(),
            'rarity'    => $perso->getRarity(),
            'url_img'   => $perso->getUrlImg(),
        ];

        $stmt = $this->execRequest($sql, $params);
        return $stmt->rowCount();
    }

    public function update(Personnage $perso): int
    {
        $sql = 'UPDATE personnage
                SET name = :name,
                    element = :element,
                    unitclass = :unitclass,
                    origin = :origin,
                    rarity = :rarity,
                    url_img = :url_img
                WHERE id = :id';

        $params = [
            'id'        => $perso->getId(),
            'name'      => $perso->getName(),
            'element'   => $perso->getElement()?->getId(),
            'unitclass' => $perso->getUnitclass()?->getId(),
            'origin'    => $perso->getOrigin()?->getId(),
            'rarity'    => $perso->getRarity(),
            'url_img'   => $perso->getUrlImg(),
        ];

        $stmt = $this->execRequest($sql, $params);
        return $stmt->rowCount();
    }

    public function delete(string $id): int
    {
        $sql  = 'DELETE FROM personnage WHERE id = :id';
        $stmt = $this->execRequest($sql, ['id' => $id]);
        return $stmt->rowCount();
    }
}
