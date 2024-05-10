<?php

class User {
    private ?string $id;
    private string $first_name;
    private string $last_name;
    private string $dob;
    private string $email;
    private string $password;
    private string $telephone;

    public function __construct(?string $id, string $first_name, string $last_name, string $dob, string $email, string $password, string $telephone) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->dob = $dob;
        $this->email = $email;
        $this->password = $password;
        $this->telephone = $telephone;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function getFirstName(): string {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void {
        $this->first_name = $first_name;
    }

    public function getLastName(): string {
        return $this->last_name;
    }

    public function setLastName(string $last_name): void {
        $this->last_name = $last_name;
    }

    public function getdob(): string {
        return $this->dob;
    }

    public function setdob(string $dob): void {
        $this->dob = $dob;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void {
        $this->telephone = $telephone;
    }
}

?>
