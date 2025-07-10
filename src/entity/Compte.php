<?php
namespace Ciara\Sprint;
use Ciara\Sprint\Transaction;
use Ciara2\Sprint2\AbstractEntity;
class Compte extends AbstractEntity  {
    private int $idCompte;
    private string $numeroTel;
    private string $photoRecto;
    private string $photoVerso;
    private string $password;
    private string $numeroCNI;
    private int $montant;
    private TypeCompte $type;
    private array $listeTransaction = [];
    private Client $client;

    public function __construct(
        int $idCompte,
        string $numeroTel,
        string $photoRecto,
        string $photoVerso,
        string $password,
        string $numeroCNI,
        int $montant,
        TypeCompte $type,
        Client $client
    ) {
        $this->idCompte = $idCompte;
        $this->numeroTel = $numeroTel;
        $this->photoRecto = $photoRecto;
        $this->photoVerso = $photoVerso;
        $this->password = $password;
        $this->numeroCNI = $numeroCNI;
        $this->montant = $montant;
        $this->type = $type;
        $this->client = $client;
    }

    public function getIdCompte(): int {
        return $this->idCompte;
    }

    public function setIdCompte(int $idCompte): void {
        $this->idCompte = $idCompte;
    }

    public function getNumeroTel(): string {
        return $this->numeroTel;
    }

    public function setNumeroTel(string $numeroTel): void {
        $this->numeroTel = $numeroTel;
    }

    public function getPhotoRecto(): string {
        return $this->photoRecto;
    }

    public function setPhotoRecto(string $photoRecto): void {
        $this->photoRecto = $photoRecto;
    }

    public function getPhotoVerso(): string {
        return $this->photoVerso;
    }

    public function setPhotoVerso(string $photoVerso): void {
        $this->photoVerso = $photoVerso;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getNumeroCNI(): string {
        return $this->numeroCNI;
    }

    public function setNumeroCNI(string $numeroCNI): void {
        $this->numeroCNI = $numeroCNI;
    }

    public function getMontant(): int {
        return $this->montant;
    }

    public function setMontant(int $montant): void {
        $this->montant = $montant;
    }

    public function getType(): TypeCompte {
        return $this->type;
    }

    public function setType(TypeCompte $type): void {
        $this->type = $type;
    }

    public function getListeTransaction(): array {
        return $this->listeTransaction;
    }

    public function addListeTransaction(Transaction $transaction): void {
        $this->listeTransaction[] = $transaction;
    }

    public function getClient(): Client {
        return $this->client;
    }

    public function setClient(Client $client): void {
        $this->client = $client;
    }
    public function getSolde(): int {
    $solde = 0;
    foreach ($this->listeTransaction as $transaction) {
        if ($transaction->getTypeTransaction() === TypeTransaction::DEPOT) {
            $solde += $transaction->getMontantTransaction();
        } elseif (in_array($transaction->getTypeTransaction(), [TypeTransaction::RETRAIT, TypeTransaction::PAIEMENT])) {
            $solde -= $transaction->getMontantTransaction();
        }
    }
    return $solde;
}

    protected function toObject($data): static {
    return new static(
        $data['idCompte'] ?? 0,
        $data['numeroTel'] ?? '',
        $data['photoRecto'] ?? '',
        $data['photoVerso'] ?? '',
        $data['password'] ?? '',
        $data['numeroCNI'] ?? '',
        $data['montant'] ?? 0,
        $data['type'] ?? TypeCompte::PRINCIPAL,
        $data['client'] ?? new Client()
    );
}


    
    protected function toArray(): array {
    return [
        'idCompte' => $this->idCompte,
        'numeroTel' => $this->numeroTel,
        'photoRecto' => $this->photoRecto,
        'photoVerso' => $this->photoVerso,
        'password' => $this->password,
        'numeroCNI' => $this->numeroCNI,
        'montant' => $this->getSolde(),  
        'type' => $this->type->value,
        'client' => $this->client->toArray(),
        'transactions' => array_map(fn($t) => $t->toArray(), $this->listeTransaction)
    ];
}

}
