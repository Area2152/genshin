<?php

namespace Models;

use Config\Config;
use PDO;
use PDOException;

class BasePDODAO
{
    private ?PDO $db = null;

    protected function getDB(): PDO
    {
        if ($this->db === null) {
            $dsn  = Config::get('dsn');
            $user = Config::get('user');
            $pass = Config::get('pass');

            try {
                $this->db = new PDO($dsn, $user, $pass);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }

        return $this->db;
    }

    protected function execRequest(string $sql, array $params = null)
    {
        $db = $this->getDB();

        if ($params === null) {
            return $db->query($sql);
        } else {
            $stmt = $db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        }
    }
}

