<?php

namespace Models;

use PDO;

class OriginDAO extends BasePDODAO
{
    public function getAll(): array
    {
        $sql = 'SELECT * FROM origin ORDER BY name';
        $stmt = $this->execRequest($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $list = [];
        foreach ($rows as $row) {
            $o = new Origin();
            $o->hydrate($row);
            $list[] = $o;
        }
        return $list;
    }

    public function getById(int $id): ?Origin
    {
        $sql  = 'SELECT * FROM origin WHERE id = :id';
        $stmt = $this->execRequest($sql, ['id' => $id]);
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $o = new Origin();
        $o->hydrate($row);
        return $o;
    }

    public function create(Origin $origin): int
    {
        $sql = 'INSERT INTO origin (name, url_img) VALUES (:name, :url_img)';
        $stmt = $this->execRequest($sql, [
            'name'    => $origin->getName(),
            'url_img' => $origin->getUrlImg(),
        ]);
        return $stmt->rowCount();
    }
}
