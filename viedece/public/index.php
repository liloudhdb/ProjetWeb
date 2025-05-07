<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
date_default_timezone_set('Europe/Paris');
require_once __DIR__ . '/../config/config.php';

$stmt = $pdo->query("SELECT * FROM vdece ORDER BY created_at DESC");
$vdeces = $stmt->fetchAll();
?>

<?php include 'includes/header.php'; ?>

<div class="container">
    <h1>Vie d’ECE</h1>

    <a href="add_vdece.php" class="btn-ajouter">➕ Ajouter une VdECE</a>
    <hr>

    <?php if (empty($vdeces)): ?>
        <p>Aucune VdECE pour le moment !</p>
    <?php else: ?>
        <?php foreach ($vdeces as $vde): ?>
            <div class="vdece-item">
                <strong><?php echo htmlspecialchars($vde['pseudo']); ?></strong>
                (<?php echo date('d/m/Y H:i', strtotime($vde['created_at'])); ?>)
                <p><?php echo nl2br(htmlspecialchars($vde['content'])); ?></p>
                <a href="show_vdece.php?id=<?php echo $vde['id']; ?>">
                    Voir les commentaires
                </a>

                <!-- Boutons pour voter sous le VDece -->
                <div class="reaction-buttons" data-id="<?php echo $vde['id']; ?>">
                    <button class="btn-vdm" onclick="vote(this, 'vdm')">Je valide, c'est une VdECE</button>
                    <button class="btn-merite" onclick="vote(this, 'merite')">C'est comme ça partout</button>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>

<!-- Script JavaS pour activer les boutons -->
<script>
function vote(button, type) {
    const container = button.parentElement;
    container.querySelectorAll('button').forEach(btn => btn.classList.remove('clicked'));
    button.classList.add('clicked');

    console.log("Vote envoyé pour VdECE ID " + container.dataset.id + " : " + type);
}
</script>
