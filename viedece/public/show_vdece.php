<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
date_default_timezone_set('Europe/Paris');
require_once __DIR__ . '/../config/config.php';

// Récupération de l'ID en GET
$id = $_GET['id'] ?? null;
if (!is_numeric($id)) {
    http_response_code(404);
    exit("404 - VdECE introuvable.");
}

// Récupération de la VdECE
$stmt = $pdo->prepare("SELECT * FROM vdece WHERE id = ?");
$stmt->execute([$id]);
$vdece = $stmt->fetch();

if (!$vdece) {
    http_response_code(404);
    exit("404 - VdECE non trouvée.");
}

// Récupération des commentaires
$stmt = $pdo->prepare("SELECT * FROM comment WHERE vde_id = ? ORDER BY created_at ASC");
$stmt->execute([$id]);
$comments = $stmt->fetchAll();
?>

<?php include 'includes/header.php'; ?>

<div class="container my-4">
    <h1 class="mb-4">Vie d’ECE n°<?php echo $id; ?></h1>

    <div class="vdece-item border p-3 mb-3 bg-light rounded">
        <p><strong><?php echo htmlspecialchars($vdece['pseudo']); ?></strong> (<?php echo $vdece['created_at']; ?>)</p>
        <p><?php echo nl2br(htmlspecialchars($vdece['content'])); ?></p>
    </div>

    <hr>
    <h3>Commentaires</h3>
    <div id="comment-section" class="mb-4">
        <?php foreach ($comments as $c): ?>
            <p><strong><?php echo htmlspecialchars($c['pseudo']); ?> :</strong> <?php echo htmlspecialchars($c['comment']); ?></p>
        <?php endforeach; ?>
    </div>

    <h4>Ajouter un commentaire</h4>
    <form id="comment-form" method="POST" action="add_comment.php" class="mb-5">
        <input type="hidden" name="vde_id" value="<?php echo $id; ?>">

        <div class="mb-2">
            <input type="text" name="pseudo" maxlength="50" required class="form-control"
                   placeholder="Ton pseudo"
                   value="<?php echo $_SESSION['pseudo'] ?? ''; ?>">
        </div>

        <div class="mb-2">
            <textarea name="comment" required class="form-control" placeholder="Écris ton commentaire..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">💬 Commenter</button>
    </form>
</div>

<!-- Script AJAX -->
<script>
document.getElementById('comment-form')?.addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch('add_comment.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(() => {
        const pseudo = form.pseudo.value;
        const comment = form.comment.value;

        const p = document.createElement('p');
        p.innerHTML = `<strong>${pseudo} :</strong> ${comment}`;
        document.getElementById('comment-section').appendChild(p);

        form.comment.value = '';
    })
    .catch(error => console.error('Erreur AJAX :', error));
});
</script>

<?php include 'includes/footer.php'; ?>
