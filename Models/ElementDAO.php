<?php

namespace Models;

use PDO;

class ElementDAO extends BasePDODAO
{
    public function getAll(): array
    {
        $sql = 'SELECT * FROM element ORDER BY name';
        $stmt = $this->execRequest($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $list = [];
        foreach ($rows as $row) {
            $e = new Element();
            $e->hydrate($row);
            $list[] = $e;
        }
        return $list;
    }

    public function getById(int $id): ?Element
    {
        $sql  = 'SELECT * FROM element WHERE id = :id';
        $stmt = $this->execRequest($sql, ['id' => $id]);
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $e = new Element();
        $e->hydrate($row);
        return $e;
    }

    public function create(Element $element): int
    {
        $sql = 'INSERT INTO element (name, url_img) VALUES (:name, :url_img)';
        $stmt = $this->execRequest($sql, [
            'name'    => $element->getName(),
            'url_img' => $element->getUrlImg(),
        ]);
        return $stmt->rowCount();
    }
}
