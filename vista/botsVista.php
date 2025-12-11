<?php
$titulo_pagina = 'Panel Bots VAPI | INCITAP';
require __DIR__ . '/header.php';
?>

<div class="container">
    <h2 class="mb-2">Bots Institucionales registrados</h2>

    <?php if (!empty($bots)): ?>
        <?php foreach ($bots as $bot): ?>
            <?php $censurada = censurar_id($bot['id']); ?>
            <div class="bot-card">
                <h4><?= htmlspecialchars($bot['nombre']) ?></h4>

                <div class="bot-id-row">
                    <span class="bot-label">ID del Bot:</span>
                    <span id="id-<?= htmlspecialchars($bot['id']) ?>"
                          data-fullid="<?= htmlspecialchars($bot['id']) ?>"
                          data-maskedid="<?= htmlspecialchars($censurada) ?>"
                          data-state="masked">
                          <?= htmlspecialchars($censurada) ?>
                    </span>
                    <button class="show-btn"
                            id="btn-<?= htmlspecialchars($bot['id']) ?>"
                            onclick="toggleId('<?= htmlspecialchars($bot['id']) ?>')">
                        Mostrar
                    </button>
                </div>

                <div class="bot-meta">
                    <span class="bot-label">Creado el:</span>
                    <?= htmlspecialchars($bot['fecha_creacion']) ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="bot-card">
            <em>No se encontraron bots registrados en la base de datos.</em>
        </div>
    <?php endif; ?>
</div>

<div class="footer">
    INCITAP | Instituto de Ciencias y Tecnología • Todos los derechos reservados
</div>

<script>
function toggleId(id) {
    var input = document.getElementById('id-' + id);
    var btn   = document.getElementById('btn-' + id);
    if (input.dataset.state === "masked") {
        input.textContent   = input.dataset.fullid;
        input.dataset.state = "revealed";
        btn.textContent     = "Ocultar";
    } else {
        input.textContent   = input.dataset.maskedid;
        input.dataset.state = "masked";
        btn.textContent     = "Mostrar";
    }
}
</script>

</body>
</html>