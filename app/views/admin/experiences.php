<?php $titre_page = 'Expériences'; require ROOT_PATH . '/app/views/includes/admin-header.php'; ?>

<div class="flex justify-between items-center mb-5">
    <p class="text-slate-400 text-sm"><?= count($experiences) ?> expérience(s)</p>
    <a href="<?= BASE_URL ?>/admin/experiences/nouveau"
       class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors">
        + Nouvelle
    </a>
</div>

<?php if (empty($experiences)): ?>
<div class="bg-slate-900 rounded-xl border border-slate-800 p-10 text-center text-slate-500">Aucune expérience.</div>
<?php else: ?>
<div class="bg-slate-900 rounded-xl border border-slate-800 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="border-b border-slate-800">
            <tr>
                <th class="text-left px-4 py-3 text-slate-400 font-medium">Poste</th>
                <th class="text-left px-4 py-3 text-slate-400 font-medium hidden sm:table-cell">Entreprise</th>
                <th class="text-center px-4 py-3 text-slate-400 font-medium">Type</th>
                <th class="text-right px-4 py-3 text-slate-400 font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800">
            <?php foreach ($experiences as $exp): ?>
            <tr class="hover:bg-slate-800/50">
                <td class="px-4 py-3">
                    <p class="text-white"><?= htmlspecialchars($exp['poste']) ?></p>
                    <p class="text-slate-500 text-xs"><?= date('m/Y', strtotime($exp['date_debut'])) ?> — <?= $exp['en_cours'] ? 'Présent' : ($exp['date_fin'] ? date('m/Y', strtotime($exp['date_fin'])) : '?') ?></p>
                </td>
                <td class="px-4 py-3 text-slate-400 hidden sm:table-cell"><?= htmlspecialchars($exp['entreprise']) ?></td>
                <td class="px-4 py-3 text-center">
                    <span class="text-xs px-2 py-0.5 rounded-full <?= $exp['type'] === 'travail' ? 'bg-blue-500/10 text-blue-400' : 'bg-violet-500/10 text-violet-400' ?>">
                        <?= $exp['type'] === 'travail' ? 'Pro' : 'Formation' ?>
                    </span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex justify-end gap-2">
                        <a href="<?= BASE_URL ?>/admin/experiences/<?= $exp['id'] ?>/editer"
                           class="px-2.5 py-1 bg-slate-800 border border-slate-700 text-slate-300 hover:text-white rounded text-xs">Modifier</a>
                        <a href="<?= BASE_URL ?>/admin/experiences/<?= $exp['id'] ?>/supprimer"
                           data-confirm="Supprimer ?"
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
