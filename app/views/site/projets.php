<?php require ROOT_PATH . '/app/views/includes/header.php'; ?>

<section class="py-20">
    <div class="max-w-5xl mx-auto px-4">

        <h1 class="text-4xl font-bold text-white mb-2">Tous les projets</h1>
        <div class="w-12 h-1 bg-indigo-500 mb-10 rounded"></div>

        <?php if (empty($projets)): ?>
        <p class="text-slate-500 text-center py-12">Aucun projet pour le moment.</p>
        <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php foreach ($projets as $projet): ?>
            <a href="<?= BASE_URL ?>/projet/<?= htmlspecialchars($projet['slug']) ?>"
               class="bg-slate-900 rounded-xl border border-slate-800 overflow-hidden hover:border-indigo-500/40 transition-colors block">

                <div class="h-40 bg-slate-800 overflow-hidden">
                    <?php if (!empty($projet['image'])): ?>
                        <img src="<?= BASE_URL ?>/<?= htmlspecialchars($projet['image']) ?>"
                             alt="<?= htmlspecialchars($projet['titre']) ?>"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-5xl">💻</div>
                    <?php endif; ?>
                </div>

                <?php if ($projet['mis_en_avant']): ?>
                <div class="px-4 pt-3">
                    <span class="text-xs bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 px-2 py-0.5 rounded-full">⭐ Mis en avant</span>
                </div>
                <?php endif; ?>

                <div class="p-4">
                    <h2 class="text-white font-semibold mb-1"><?= htmlspecialchars($projet['titre']) ?></h2>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        <?= htmlspecialchars(mb_strimwidth($projet['description'] ?? '', 0, 100, '…')) ?>
                    </p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php require ROOT_PATH . '/app/views/includes/footer.php'; ?>
