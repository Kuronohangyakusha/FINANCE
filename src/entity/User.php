<?php
namespace App\Entity;

use App\Core\AbstractEntity;

class User extends AbstractEntity {
    private int $id;
    private string $nom;
    private string $prenom;
    private string $adresse;
    private string $numeroTel;
    private string $numeroCni;
    private string $password;
    private ?string $photoRecto;
    private ?string $photoVerso;
    private string $createdAt;
    
    public function __construct(
        int $id = 0,
        string $nom = '',
        string $prenom = '',
        string $adresse = '',
        string $numeroTel = '',
        string $numeroCni = '',
        string $password = '',
        ?string $photoRecto = null,
        ?string $photoVerso = null,
        string $createdAt = ''
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->numeroTel = $numeroTel;
        $this->numeroCni = $numeroCni;
        $this->password = $password;
        $this->photoRecto = $photoRecto;
        $this->photoVerso = $photoVerso;
        $this->createdAt = $createdAt;
    }
    
    // Getters
    public function getId(): int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    public function getAdresse(): string { return $this->adresse; }
    public function getNumeroTel(): string { return $this->numeroTel; }
    public function getNumeroCni(): string { return $this->numeroCni; }
    public function getPassword(): string { return $this->password; }
    public function getPhotoRecto(): ?string { return $this->photoRecto; }
    public function getPhotoVerso(): ?string { return $this->photoVerso; }
    public function getCreatedAt(): string { return $this->createdAt; }
    
    // Setters
    public function setId(int $id): void { $this->id = $id; }
    public function setNom(string $nom): void { $this->nom = $nom; }
    public function setPrenom(string $prenom): void { $this->prenom = $prenom; }
    public function setAdresse(string $adresse): void { $this->adresse = $adresse; }
    public function setNumeroTel(string $numeroTel): void { $this->numeroTel = $numeroTel; }
    public function setNumeroCni(string $numeroCni): void { $this->numeroCni = $numeroCni; }
    public function setPassword(string $password): void { $this->password = password_hash($password, PASSWORD_DEFAULT); }
    public function setPhotoRecto(?string $photoRecto): void { $this->photoRecto = $photoRecto; }
    public function setPhotoVerso(?string $photoVerso): void { $this->photoVerso = $photoVerso; }
    
    public function verifyPassword(string $password): bool {
        return password_verify($password, $this->password);
    }
    
    public static function fromArray(array $data): self {
        return new self(
            $data['id'] ?? 0,
            $data['nom'] ?? '',
            $data['prenom'] ?? '',
            $data['adresse'] ?? '',
            $data['numero_tel'] ?? '',
            $data['numero_cni'] ?? '',
            $data['password'] ?? '',
            $data['photo_recto'] ?? null,
            $data['photo_verso'] ?? null,
            $data['created_at'] ?? ''
        );
    }
    
    protected function toObject($data): static {
        return self::fromArray($data);
    }
    
    protected function toArray(): array {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'adresse' => $this->adresse,
            'numero_tel' => $this->numeroTel,
            'numero_cni' => $this->numeroCni,
            'photo_recto' => $this->photoRecto,
            'photo_verso' => $this->photoVerso,
            'created_at' => $this->createdAt
        ];
    }
}