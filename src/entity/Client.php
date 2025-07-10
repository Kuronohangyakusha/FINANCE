<?php
namespace App\Entity;

use App\Core\AbstractEntity;

class Client extends AbstractEntity  {
    private string $numero;
    private array $compte = [];
    private int $id;
    private string $nom;
    private string $prenom;
    private string $address;
    public function __construct(
        int $id = 0,
        string $nom = '',
        string $prenom = '',
        string $address = '',
        string $numero = ''
        
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->address = $address;
         $this->numero = $numero;
    }

    public function getNumero(): string {
        return $this->numero;
    }

    public function setNumero(string $numero): void {
        $this->numero = $numero;
    }

    public function getCompte(): array {
        return $this->compte;
    }

    public function addCompte(Compte $compte): void {
        $this->compte[] = $compte;
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
    protected function toObject($data): static {
    return new static(
        $data['id'] ?? 0,
        $data['nom'] ?? '',
        $data['prenom'] ?? '',
        $data['address'] ?? '',
        $data['numero'] ?? ''
    );
}

    
    protected function toArray(): array {
        $data = parent::toArray();  
        $data['nom'] = $this->nom;
        $data['numero'] =  $this->numero;
        $data['id']= $this->id;
        $data['prenom'] = $this->prenom;
        $data['address'] = $this->address;
        $data['compte'] = array_map(function($cmt) {
            return $cmt->toArray();
        }, $this->compte);
        return $data;
    }
}
