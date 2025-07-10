<?php
namespace App\Entity;

enum TypeTransaction: string {
    case DEPOT = 'depot';
    case RETRAIT = 'retrait';
    case PAIEMENT = 'paiement';
}
