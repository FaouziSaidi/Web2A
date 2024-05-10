<?php

class Employeur {
    private ?string $id_employeur;
    private string $nom_entreprise;
    private string $adresse_entreprise;
    private string $id_user;

    public function __construct(?string $id_employeur,string $nom_entreprise ,string $adresse_entreprise, string $id_user) {
        $this->id_employeur = $id_employeur;
        $this->nom_entreprise = $nom_entreprise;
        $this->adresse_entreprise = $adresse_entreprise;
        $this->id_user = $id_user;
    }

    public function getId_employeur(): ?string {
        return $this->id_employeur;
    }

    public function getNom_entreprise(): string {
        return $this->nom_entreprise;
    }

    public function setNom_entreprise(string $nom_entreprise): void {
        $this->nom_entreprise = $nom_entreprise;
    }

    public function getAdresse_entreprise(): string {
        return $this->adresse_entreprise;
    }

    public function setAdresse_entreprise(string $nom_entreprise): void {
        $this->adresse_entreprise = $adresse_entreprise;
    }

    public function getId_user(): ?string {
        return $this->id_user;
    }
}

?>
