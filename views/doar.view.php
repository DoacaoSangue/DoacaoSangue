<main>
    <?php if (!$_SESSION["doacao"]): ?>
        <h2>Você deseja:</h2>
        <form action="../controllers/doar.controller.php" method="POST">
            <button type="submit" name="acao" value="doar">
                Doar Sangue
            </button>
            <button type="submit" name="acao" value="receber">
                Receber Sangue
            </button>
        </form>
    <?php else: ?>
        <h2>Uma solicitação já foi enviada!</h2>
    <?php endif; ?>
</main>