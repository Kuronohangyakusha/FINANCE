<?php
namespace Ciara\Sprint;

use DateTime;
use Ciara2\Sprint2\AbstractEntity;
class Transaction extends AbstractEntity {
    private int $id_transaction;
    private int $montantTransaction;
    private DateTime $date;
    private TypeTransaction $typeTransaction;
    private Compte $compte;

    public function __construct(
        int $id_transaction,
        int $montantTransaction,
        DateTime $date,
        TypeTransaction $typeTransaction,
        Compte $compte
    ) {
        $this->id_transaction = $id_transaction;
        $this->montantTransaction = $montantTransaction;
        $this->date = $date;
        $this->typeTransaction = $typeTransaction;
        $this->compte = $compte;
    }

    public function getId_transaction(): int {
        return $this->id_transaction;
    }

    public function setId_transaction(int $id_transaction): void {
        $this->id_transaction = $id_transaction;
    }

    public function getMontantTransaction(): int {
        return $this->montantTransaction;
    }

    public function setMontantTransaction(int $montantTransaction): void {
        $this->montantTransaction = $montantTransaction;
    }

    public function getDate(): DateTime {
        return $this->date;
    }

    public function setDate(DateTime $date): void {
        $this->date = $date;
    }

    public function getTypeTransaction(): TypeTransaction {
        return $this->typeTransaction;
    }

    public function setTypeTransaction(TypeTransaction $typeTransaction): void {
        $this->typeTransaction = $typeTransaction;
    }

    public function getCompte(): Compte {
        return $this->compte;
    }

    public function setCompte(Compte $compte): void {
        $this->compte = $compte;
    }
    protected function toObject($data): static {
    return new static(
        $data['id_transaction'] ?? 0,
        $data['montantTransaction'] ?? 0,
        isset($data['date']) ? new DateTime($data['date']) : new DateTime(),
        isset($data['typeTransaction']) ? TypeTransaction::from($data['typeTransaction']) : TypeTransaction::DEPOT,
        $data['compte'] ?? new Compte(0, '', '', '', '', '', 0, TypeCompte::PRINCIPAL, new Client())
    );
}


    
    protected function toArray(): array {
    return [
        'id_transaction' => $this->id_transaction,
        'montantTransaction' => $this->montantTransaction,
        'date' => $this->date->format('Y-m-d H:i:s'),
        'typeTransaction' => $this->typeTransaction->value,
        'compte' => $this->compte->$this->compte->toArray() // ou $this->compte->toArray() selon ton besoin
    ];
}
}
