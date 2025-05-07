<?php
require_once __DIR__ . '/../config/config.php';

$id = $_GET['id'] ?? null;

if (is_numeric($id)) {
    // Supprimer les commentaires liés
    $stmt = $pdo->prepare("DELETE FROM comment WHERE vde_id = ?");
    $stmt->execute([$id]);

    // Supprimer la VdECE
    $stmt = $pdo->prepare("DELETE FROM vdece WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
