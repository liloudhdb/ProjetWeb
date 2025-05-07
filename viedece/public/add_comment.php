<?php
session_start();
require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vde_id = $_POST['vde_id'] ?? null;
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $comment = htmlspecialchars(trim($_POST['comment']));

    if (is_numeric($vde_id) && !empty($pseudo) && !empty($comment)) {
        // pour l'inserer dans la base
        $stmt = $pdo->prepare("INSERT INTO comment (vde_id, pseudo, comment) VALUES (?, ?, ?)");
        $stmt->execute([$vde_id, $pseudo, $comment]);

        // permet de retenir le nom de l'utilisateur
        $_SESSION['pseudo'] = $pseudo;
    }

    if (empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        header("Location: show_vdece.php?id=$vde_id");
        exit;
    }
}
