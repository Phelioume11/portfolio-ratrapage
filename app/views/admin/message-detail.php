<?php $titre_page = 'Message de ' . htmlspecialchars($msg['nom']); require ROOT_PATH . '/app/views/includes/admin-header.php'; ?>

<a href="<?= BASE_URL ?>/admin/messages" class="text-slate-400 hover:text-white text-sm mb-5 inline-block">← Retour</a>

<div class="max-w-2xl">
    <div class="bg-slate-900 rounded-xl border border-slate-800 p-6">

        <div class="flex justify-between items-start gap-4 mb-5 pb-5 border-b border-slate-800">
            <div>
                <p class="text-white font-semibold text-lg"><?= htmlspecialchars($msg['nom']) ?></p>
                <a href="mailto:<?= htmlspecialchars($msg['email']) ?>" class="text-indigo-400 text-sm hover:underline">
                    <?= htmlspecialchars($msg['email']) ?>
                </a>
                <p class="text-slate-500 text-xs mt-1"><?= date('d/m/Y à H:i', strtotime($msg['created_at'])) ?></p>
            </div>
            <a href="<?= BASE_URL ?>/admin/messages/<?= $msg['id'] ?>/supprimer"
               data-confirm="Supprimer ce message ?"
               class="px-3 py-1.5 bg-red-500/10 border border-red-500/20 text-red-400 rounded-lg text-xs">
                Supprimer
            </a>
        </div>

        <p class="text-slate-500 text-xs uppercase tracking-wide mb-1">Sujet</p>
        <p class="text-white font-medium mb-5"><?= htmlspecialchars($msg['sujet']) ?></p>

        <p class="text-slate-500 text-xs uppercase tracking-wide mb-2">Message</p>
        <div class="bg-slate-800 rounded-xl p-4 border border-slate-700">
            <p class="text-slate-300 text-sm leading-relaxed whitespace-pre-line"><?= htmlspecialchars($msg['message']) ?></p>
        </div>

        <div class="mt-5 pt-5 border-t border-slate-800">
            <a href="mailto:<?= htmlspecialchars($msg['email']) ?>?subject=Re: <?= urlencode($msg['sujet']) ?>"
               class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition-colors inline-flex items-center gap-2">
                ↩ Répondre par email
            </a>
        </div>
    </div>
</div>

<?php require ROOT_PATH . '/app/views/includes/admin-footer.php'; ?>
