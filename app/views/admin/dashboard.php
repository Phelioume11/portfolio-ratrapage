<?php $titre_page = 'Dashboard'; require ROOT_PATH . '/app/views/includes/admin-header.php'; ?>

<!-- Stats -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-slate-900 rounded-xl border border-slate-800 p-4">
        <p class="text-slate-500 text-sm mb-1">Projets</p>
        <p class="text-3xl font-bold text-white"><?= $stats['projets'] ?></p>
    </div>
    <div class="bg-slate-900 rounded-xl border border-slate-800 p-4">
        <p class="text-slate-500 text-sm mb-1">Compétences</p>
        <p class="text-3xl font-bold text-white"><?= $stats['competences'] ?></p>
    </div>
    <div class="bg-slate-900 rounded-xl border border-slate-800 p-4">
        <p class="text-slate-500 text-sm mb-1">Expériences</p>
        <p class="text-3xl font-bold text-white"><?= $stats['experiences'] ?></p>
    </div>
    <div class="bg-slate-900 rounded-xl border border-slate-800 p-4">
        <p class="text-slate-500 text-sm mb-1">Messages non lus</p>
        <p class="text-3xl font-bold <?= $stats['messages'] > 0 ? 'text-red-400' : 'text-white' ?>"><?= $stats['messages'] ?></p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Derniers messages -->
    <div class="bg-slate-900 rounded-xl border border-slate-800 p-5">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-white">Derniers messages</h2>
            <a href="<?= BASE_URL ?>/admin/messages" class="text-indigo-400 text-sm hover:underline">Voir tout →</a>
        </div>

        <?php if (empty($derniers_messages)): ?>
        <p class="text-slate-500 text-sm">Aucun message.</p>
        <?php else: ?>
        <div class="space-y-2">
            <?php foreach ($derniers_messages as $msg): ?>
            <a href="<?= BASE_URL ?>/admin/messages/<?= $msg['id'] ?>"
               class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-slate-800 transition-colors block">
                <div class="w-8 h-8 bg-indigo-500/10 rounded-lg flex items-center justify-center text-indigo-400 font-semibold text-sm flex-shrink-0">
                    <?= strtoupper(substr($msg['nom'], 0, 1)) ?>
                </div>
                <div class="min-w-0">
                    <div class="flex items-center gap-1.5">
                        <p class="text-white text-sm truncate"><?= htmlspecialchars($msg['nom']) ?></p>
                        <?php if (!$msg['lu']): ?>
                            <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full flex-shrink-0"></span>
                        <?php endif; ?>
                    </div>
                    <p class="text-slate-500 text-xs truncate"><?= htmlspecialchars($msg['sujet']) ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Actions rapides -->
    <div class="bg-slate-900 rounded-xl border border-slate-800 p-5">
        <h2 class="font-semibold text-white mb-4">Actions rapides</h2>
        <div class="grid grid-cols-2 gap-3">
            <a href="<?= BASE_URL ?>/admin/projets/nouveau"
               class="p-3 bg-slate-800 hover:bg-slate-700 rounded-lg text-center transition-colors">
                <p class="text-xl mb-1">➕</p>
                <p class="text-slate-300 text-xs font-medium">Nouveau projet</p>
            </a>
            <a href="<?= BASE_URL ?>/admin/competences"
               class="p-3 bg-slate-800 hover:bg-slate-700 rounded-lg text-center transition-colors">
                <p class="text-xl mb-1">⚡</p>
                <p class="text-slate-300 text-xs font-medium">Compétences</p>
            </a>
            <a href="<?= BASE_URL ?>/admin/experiences/nouveau"
               class="p-3 bg-slate-800 hover:bg-slate-700 rounded-lg text-center transition-colors">
                <p class="text-xl mb-1">🎯</p>
                <p class="text-slate-300 text-xs font-medium">Nouvelle expérience</p>
            </a>
            <a href="<?= BASE_URL ?>/admin/profil"
               class="p-3 bg-slate-800 hover:bg-slate-700 rounded-lg text-center transition-colors">
                <p class="text-xl mb-1">👤</p>
                <p class="text-slate-300 text-xs font-medium">Mon profil</p>
            </a>
        </div>
    </div>
</div>

<?php require ROOT_PATH . '/app/views/includes/admin-footer.php'; ?>
