<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
    $content = htmlspecialchars(trim($_POST['content']));

    if (!empty($pseudo) && !empty($content) && strlen($pseudo) <= 50) {
 
        $stmt = $pdo->prepare("INSERT INTO vdece (pseudo, content) VALUES (?, ?)");
        $stmt->execute([$pseudo, $content]);

        $_SESSION['pseudo'] = $pseudo;
        header('Location: index.php');
        exit;
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="container">
    <h2>Poster une nouvelle VdECE</h2>

    <form method="post" action="add_vdece.php" class="form-vdece">
        <label for="pseudo">Ton pseudo :</label><br>
        <input type="text" name="pseudo" maxlength="50" required
               value="<?php echo $_SESSION['pseudo'] ?? ''; ?>" placeholder="Ton pseudo">
        <br>

        <label for="content">Ton anecdote :</label><br>
        <textarea name="content" required placeholder="Raconte ta VdECE ici..."></textarea>
        <br>

        <button type="submit">Envoyer</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
