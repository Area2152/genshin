<?php

namespace Controllers;

use League\Plates\Engine;
use Services\PersonnageService;
use Models\Personnage;

class PersoController
{
    private Engine $templates;
    private MainController $mainController;
    private PersonnageService $service;

    public function __construct(
        Engine $templates,
        MainController $mainController,
        PersonnageService $service
    ) {
        $this->templates      = $templates;
        $this->mainController = $mainController;
        $this->service        = $service;
    }

    private function getFormDataForView(?Personnage $perso = null): array
    {
        return [
            'perso'       => $perso,
            'elements'    => $this->service->getAllElements(),
            'origins'     => $this->service->getAllOrigins(),
            'unitclasses' => $this->service->getAllUnitclasses(),
        ];
    }

    public function displayAddPerso(
        ?string $message = null,
        ?Personnage $perso = null,
        bool $isEdit = false
    ): void {
        $dataForm = $this->getFormDataForView($perso);

        echo $this->templates->render('add-perso', array_merge($dataForm, [
            'title'   => $isEdit ? 'Modifier un personnage' : 'Ajouter un personnage',
            'message' => $message,
            'isEdit'  => $isEdit,
        ]));
    }

    public function displayEditPerso(string $idPerso): void
    {
        $perso = $this->service->getPersoById($idPerso);

        if (!$perso) {
            $this->mainController->index("Personnage introuvable.");
            return;
        }

        $this->displayAddPerso(null, $perso, true);
    }

    public function displayAddElement(?string $message = null): void
    {
        echo $this->templates->render('add-element', [
            'title'   => 'Ajouter un élément',
            'message' => $message,
        ]);
    }

    public function addAttributeAndIndex(array $data): void
    {
        $name = trim($data['attr-name'] ?? '');
        $url  = trim($data['attr-img'] ?? '');
        $type = trim($data['attr-type'] ?? '');

        if ($name === '' || $url === '' || $type === '') {
            $this->displayAddElement("Tous les champs sont obligatoires.");
            return;
        }

        $rowCount = $this->service->createAttribute($type, $name, $url);

        $message = $rowCount > 0
            ? "Nouvel attribut créé avec succès."
            : "Erreur lors de la création de l'attribut.";

        $this->mainController->index($message);
    }

    public function addPerso(array $dataPerso): void
    {
        $rowCount = $this->service->createFromForm($dataPerso);

        $message = $rowCount > 0
            ? "Personnage créé avec succès."
            : "Erreur lors de la création du personnage.";

        $this->mainController->index($message);
    }

    public function deletePersoAndIndex(?string $idPerso = null): void
    {
        if ($idPerso === null || $idPerso === '') {
            $this->mainController->index("Aucun identifiant de personnage fourni.");
            return;
        }

        $rowCount = $this->service->deletePerso($idPerso);

        $message = $rowCount > 0
            ? "Personnage supprimé avec succès."
            : "Personnage introuvable ou déjà supprimé.";

        $this->mainController->index($message);
    }

    public function editPersoAndIndex(array $dataPerso): void
    {
        $rowCount = $this->service->updateFromForm($dataPerso);

        $message = $rowCount > 0
            ? "Personnage mis à jour avec succès."
            : "Aucune modification effectuée ou personnage introuvable.";

        $this->mainController->index($message);
    }
}
