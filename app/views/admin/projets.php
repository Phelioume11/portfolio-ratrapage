<?php $titre_page = 'Projets'; require ROOT_PATH . '/app/views/includes/admin-header.php'; ?>

<div class="flex justify-between items-center mb-5">
    <p class="text-slate-400 text-sm"><?= count($projets) ?> projet(s)</p>
    <a href="<?= BASE_URL ?>/admin/projets/nouveau"
       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors">
        + Nouveau
    </a>
</div>

<?php if (empty($projets)): ?>
<div class="bg-slate-900 rounded-xl border border-slate-800 p-10 text-center text-slate-500">Aucun projet.</div>
<?php else: ?>
<div class="bg-slate-900 rounded-xl border border-slate-800 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="border-b border-slate-800">
            <tr>
                <th class="text-left px-4 py-3 text-slate-400 font-medium">Titre</th>
                <th class="text-center px-4 py-3 text-slate-400 font-medium hidden sm:table-cell">Mis en avant</th>
                <th class="text-right px-4 py-3 text-slate-400 font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800">
            <?php foreach ($projets as $p): ?>
            <tr class="hover:bg-slate-800/50">
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <?php if ($p['mis_en_avant']): ?>
                        <span class="text-yellow-400 text-sm" title="Mis en avant">⭐</span>
                        <?php endif; ?>
                        <span class="text-white"><?= htmlspecialchars($p['titre']) ?></span>
                    </div>
                </td>
                <td class="px-4 py-3 text-center hidden sm:table-cell">
                    <a href="<?= BASE_URL ?>/admin/projets/<?= $p['id'] ?>/toggle-featured" 
                       class="inline-block px-3 py-1 text-xs rounded-lg transition-colors <?= $p['mis_en_avant'] ? 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 hover:bg-yellow-500/20' : 'bg-slate-800 text-slate-500 border border-slate-700 hover:bg-slate-700' ?>">
                        <?= $p['mis_en_avant'] ? '⭐ Mis en avant' : 'Mettre en avant' ?>
                    </a>
                </td>
                <td class="px-4 py-3">
                    <div class="flex justify-end gap-2">
                        <a href="<?= BASE_URL ?>/admin/projets/<?= $p['id'] ?>/editer"
                           class="px-2.5 py-1 bg-slate-800 border border-slate-700 text-slate-300 hover:text-white rounded text-xs transition-colors">
                            Modifier
                        </a>
                        <a href="<?= BASE_URL ?>/admin/projets/<?= $p['id'] ?>/supprimer"
                           data-confirm="Supprimer ce projet ?"
                           class="px-2.5 py-1 bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500/20 rounded text-xs transition-colors">
                            Supprimer
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<?php require ROOT_PATH . '/app/views/includes/admin-footer.php'; ?>
