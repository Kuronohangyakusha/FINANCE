<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Transactions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Menu burger sans JS */
        .menu-toggle {
            display: none;
        }
        
        .menu-toggle:checked + .sidebar {
            transform: translateX(0);
        }
        
        .menu-toggle:checked ~ .overlay {
            opacity: 1;
            visibility: visible;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .overlay {
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.3s ease, visibility 0.3s ease;
            }
        }
    </style>
</head>
<?php
   require_once '../template/layout/partial/header.partial.php';
    echo $contentForLayout;
?>
</html>