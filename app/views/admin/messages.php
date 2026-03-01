<?php $titre_page = 'Messages'; require ROOT_PATH . '/app/views/includes/admin-header.php'; ?>

<?php if (empty($messages)): ?>
<div class="bg-slate-900 rounded-xl border border-slate-800 p-12 text-center text-slate-500">Aucun message reçu.</div>
<?php else: ?>
<div class="bg-slate-900 rounded-xl border border-slate-800 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="border-b border-slate-800">
            <tr>
                <th class="w-3 px-4 py-3"></th>
                <th class="text-left px-4 py-3 text-slate-400 font-medium">De</th>
                <th class="text-left px-4 py-3 text-slate-400 font-medium hidden sm:table-cell">Sujet</th>
                <th class="text-left px-4 py-3 text-slate-400 font-medium hidden md:table-cell">Date</th>
                <th class="text-right px-4 py-3 text-slate-400 font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800">
            <?php foreach ($messages as $msg): ?>
            <tr class="hover:bg-slate-800/50 <?= !$msg['lu'] ? 'bg-indigo-500/5' : '' ?>">
                <td class="px-4 py-3">
                    <?php if (!$msg['lu']): ?>
                    <span class="block w-2 h-2 rounded-full bg-indigo-400" title="Non lu"></span>
                    <?php endif; ?>
                </td>
                <td class="px-4 py-3">
                    <p class="<?= !$msg['lu'] ? 'text-white font-medium' : 'text-slate-300' ?>"><?= htmlspecialchars($msg['nom']) ?></p>
                    <p class="text-slate-500 text-xs"><?= htmlspecialchars($msg['email']) ?></p>
                </td>
                <td class="px-4 py-3 text-slate-400 hidden sm:table-cell">
                    <?= htmlspecialchars(mb_strimwidth($msg['sujet'], 0, 40, '…')) ?>
                </td>
                <td class="px-4 py-3 text-slate-500 text-xs hidden md:table-cell">
                    <?= date('d/m/Y H:i', strtotime($msg['created_at'])) ?>
                </td>
                <td class="px-4 py-3">
                    <div class="flex justify-end gap-2">
                        <a href="<?= BASE_URL ?>/admin/messages/<?= $msg['id'] ?>"
                           class="px-2.5 py-1 bg-slate-800 border border-slate-700 text-slate-300 hover:text-white rounded text-xs">Lire</a>
                        <a href="<?= BASE_URL ?>/admin/messages/<?= $msg['id'] ?>/supprimer"
                           data-confirm="Supprimer ce message ?"
                           class="px-2.5 py-1 bg-red-500/10 border border-red-500/20 text-red-400 rounded text-xs">Supprimer</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<?php require ROOT_PATH . '/app/views/includes/admin-footer.php'; ?>
