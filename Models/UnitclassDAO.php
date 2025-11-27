<?php

namespace Models;

use PDO;

class UnitclassDAO extends BasePDODAO
{
    public function getAll(): array
    {
        $sql = 'SELECT * FROM unitclass ORDER BY name';
        $stmt = $this->execRequest($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $list = [];
        foreach ($rows as $row) {
            $u = new Unitclass();
            $u->hydrate($row);
            $list[] = $u;
        }
        return $list;
    }

    public function getById(int $id): ?Unitclass
    {
        $sql  = 'SELECT * FROM unitclass WHERE id = :id';
        $stmt = $this->execRequest($sql, ['id' => $id]);
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $u = new Unitclass();
        $u->hydrate($row);
        return $u;
    }

    public function create(Unitclass $unitclass): int
    {
        $sql = 'INSERT INTO unitclass (name, url_img) VALUES (:name, :url_img)';
        $stmt = $this->execRequest($sql, [
            'name'    => $unitclass->getName(),
            'url_img' => $unitclass->getUrlImg(),
        ]);
        return $stmt->rowCount();
    }
}
