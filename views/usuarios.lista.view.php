<?php foreach ($usuarios as $usuario): ?>
<tr>
    <td><?= htmlspecialchars($usuario['nome']) ?></td>
    <td><?= htmlspecialchars($usuario['email']) ?></td>
    <td><?= htmlspecialchars($usuario['tipo'] ?? 'Comum') ?></td>
    <td>
        <a href="painel-administrador.view.php?page=usuarios&crud=alterar&id=<?= $usuario['id'] ?>">
            <button>Alterar</button>
        </a>
        <a href="painel-administrador.view.php?page=usuarios&crud=excluir&id=<?= $usuario['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">
            <button>Excluir</button>
        </a>
    </td>
</tr>
<?php endforeach; ?>
