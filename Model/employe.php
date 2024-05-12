<?php

class Employe {
    private ?string $id_employe;
    private string $diplome;
    private string $id_user;

    public function __construct(?string $id_employe, string $diplome, string $id_user) {
        $this->id_employe = $id_employe;
        $this->diplome = $diplome;
        $this->id_user = $id_user;
    }

    public function getId_employe(): ?string {
        return $this->id_employe;
    }


    public function getDiplome(): string {
        return $this->diplome;
    }

    public function setDiplome(string $diplome): void {
        $this->diplome = $diplome;
    }

    public function getId_user(): ?string {
        return $this->id_user;
    }
}

?>
