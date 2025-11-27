<?php

namespace Services;

use Models\ElementDAO;
use Models\OriginDAO;
use Models\UnitclassDAO;
use Models\PersonnageDAO;
use Models\Personnage;
use Models\Element;
use Models\Origin;
use Models\Unitclass;

class PersonnageService
{
    private PersonnageDAO $persoDao;
    private ElementDAO $elementDao;
    private OriginDAO $originDao;
    private UnitclassDAO $unitclassDao;
    private LogService $logger;

    public function __construct()
    {
        $this->persoDao     = new PersonnageDAO();
        $this->elementDao   = new ElementDAO();
        $this->originDao    = new OriginDAO();
        $this->unitclassDao = new UnitclassDAO();
        $this->logger       = new LogService(__DIR__ . '/../logs');
    }

    private function buildPersonnage(array $row): Personnage
    {
        $perso = new Personnage();
        $perso->hydrate($row);

        $elementId   = (int)$row['element'];
        $unitclassId = (int)$row['unitclass'];
        $originId    = $row['origin'] !== null ? (int)$row['origin'] : null;

        $perso->setElement($this->elementDao->getById($elementId));
        $perso->setUnitclass($this->unitclassDao->getById($unitclassId));
        $perso->setOrigin($originId !== null ? $this->originDao->getById($originId) : null);

        return $perso;
    }

    public function getAllPerso(): array
    {
        $rows = $this->persoDao->getAllRaw();
        $list = [];

        foreach ($rows as $row) {
            $list[] = $this->buildPersonnage($row);
        }

        return $list;
    }

    public function getPersoById(string $id): ?Personnage
    {
        $row = $this->persoDao->getByIdRaw($id);
        return $row ? $this->buildPersonnage($row) : null;
    }

    public function createFromForm(array $data): int
    {
        $p = new Personnage();
        $p->setId(uniqid());
        $p->setName($data['name']);
        $p->setRarity((int)$data['rarity']);
        $p->setUrlImg($data['url_img']);
        $p->setElement($this->elementDao->getById((int)$data['element']));
        $p->setUnitclass($this->unitclassDao->getById((int)$data['unitclass']));
        $p->setOrigin($data['origin'] !== '' ? $this->originDao->getById((int)$data['origin']) : null);

        $rowCount = $this->persoDao->create($p);

        if ($rowCount > 0) $this->logger->write('INFO', "CREATE perso {$p->getName()} ({$p->getId()}) OK");
        else $this->logger->write('ERROR', "CREATE perso {$p->getName()} ({$p->getId()}) FAILED");

        return $rowCount;
    }

    public function updateFromForm(array $data): int
    {
        $p = $this->getPersoById($data['id']);
        if (!$p) {
            $this->logger->write('ERROR', "UPDATE perso id={$data['id']} introuvable");
            return 0;
        }

        $p->setName($data['name']);
        $p->setRarity((int)$data['rarity']);
        $p->setUrlImg($data['url_img']);
        $p->setElement($this->elementDao->getById((int)$data['element']));
        $p->setUnitclass($this->unitclassDao->getById((int)$data['unitclass']));
        $p->setOrigin($data['origin'] !== '' ? $this->originDao->getById((int)$data['origin']) : null);

        $rowCount = $this->persoDao->update($p);

        if ($rowCount > 0) $this->logger->write('INFO', "UPDATE perso {$p->getName()} ({$p->getId()}) OK");
        else $this->logger->write('ERROR', "UPDATE perso {$p->getName()} ({$p->getId()}) FAILED");

        return $rowCount;
    }

    public function deletePerso(string $id): int
    {
        $rowCount = $this->persoDao->delete($id);

        if ($rowCount > 0) $this->logger->write('INFO', "DELETE perso id={$id} OK");
        else $this->logger->write('ERROR', "DELETE perso id={$id} FAILED");

        return $rowCount;
    }

    public function createAttribute(string $type, string $name, string $urlImg): int
    {
        $type = strtolower($type);
        $rowCount = 0;

        switch ($type) {
            case 'element':
                $obj = new Element();
                $obj->setName($name);
                $obj->setUrlImg($urlImg);
                $rowCount = $this->elementDao->create($obj);
                break;

            case 'origin':
                $obj = new Origin();
                $obj->setName($name);
                $obj->setUrlImg($urlImg);
                $rowCount = $this->originDao->create($obj);
                break;

            case 'unitclass':
                $obj = new Unitclass();
                $obj->setName($name);
                $obj->setUrlImg($urlImg);
                $rowCount = $this->unitclassDao->create($obj);
                break;

            default:
                $this->logger->write('ERROR', "CREATE attribute type={$type} inconnu");
                return 0;
        }

        if ($rowCount > 0) $this->logger->write('INFO', "CREATE {$type} {$name} OK");
        else $this->logger->write('ERROR', "CREATE {$type} {$name} FAILED");

        return $rowCount;
    }

    public function getAllElements(): array
    {
        return $this->elementDao->getAll();
    }

    public function getAllOrigins(): array
    {
        return $this->originDao->getAll();
    }

    public function getAllUnitclasses(): array
    {
        return $this->unitclassDao->getAll();
    }
}
