<?php require ROOT_PATH . '/app/views/includes/header.php'; ?>

<section class="py-20">
    <div class="max-w-3xl mx-auto px-4">

        <a href="<?= BASE_URL ?>/#projets" class="text-slate-400 hover:text-white text-sm mb-8 inline-block transition-colors">
            ← Retour aux projets
        </a>

        <?php if (!empty($projet['image'])): ?>
        <div class="rounded-xl overflow-hidden mb-8 border border-slate-800 h-56 sm:h-72">
            <img src="<?= BASE_URL ?>/<?= htmlspecialchars($projet['image']) ?>"
                 alt="<?= htmlspecialchars($projet['titre']) ?>"
                 class="w-full h-full object-cover">
        </div>
        <?php endif; ?>

        <h1 class="text-3xl font-bold text-white mb-3"><?= htmlspecialchars($projet['titre']) ?></h1>
        <p class="text-slate-400 text-lg mb-6"><?= htmlspecialchars($projet['description'] ?? '') ?></p>

        <!-- Compétences utilisées -->
        <?php if (!empty($projet['competences'])): ?>
        <div class="mb-6">
            <h2 class="text-white font-semibold mb-2">Technologies</h2>
            <div class="flex flex-wrap gap-2">
                <?php foreach ($projet['competences'] as $comp): ?>
                <span class="px-3 py-1 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 rounded-full text-sm">
                    <?= htmlspecialchars($comp['nom']) ?>
                </span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Liens -->
        <div class="flex flex-wrap gap-3 mb-8">
            <?php if (!empty($projet['lien_github'])): ?>
            <a href="<?= htmlspecialchars($projet['lien_github']) ?>" target="_blank"
               class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white rounded-lg border border-slate-700 text-sm transition-colors">
                GitHub →
            </a>
            <?php endif; ?>
            <?php if (!empty($projet['lien_site'])): ?>
            <a href="<?= htmlspecialchars($projet['lien_site']) ?>" target="_blank"
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm transition-colors">
                Voir le site →
            </a>
            <?php endif; ?>
        </div>

        <!-- Description longue -->
        <?php if (!empty($projet['description_longue'])): ?>
        <div class="bg-slate-900 rounded-xl p-5 border border-slate-800">
            <p class="text-slate-400 leading-relaxed whitespace-pre-line">
                <?= htmlspecialchars($projet['description_longue']) ?>
            </p>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php require ROOT_PATH . '/app/views/includes/footer.php'; ?>
