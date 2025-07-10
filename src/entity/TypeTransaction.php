<?php
namespace Ciara\Sprint;

enum TypeTransaction: string {
    case DEPOT = 'depot';
    case RETRAIT = 'retrait';
    case PAIEMENT = 'paiement';
}
