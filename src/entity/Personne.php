<?php
namespace App\Entity;

class Personne {
    private int $id;
    private string $nom;
    private string $prenom;
    private string $address;
    private TypePersonne $type;

    public function __construct(
        int $id = 0,
        string $nom = '',
        string $prenom = '',
        string $address = '',
        TypePersonne $type
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->address = $address;
        $this->type = $type;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }

    public function getTypePersonne(): TypePersonne {
        return $this->type;
    }

    public function setTypePersonne(TypePersonne $type): void {
        $this->type = $type;
    }
}
