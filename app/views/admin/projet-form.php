<?php
$estModif = !empty($projet['id']);
$titre_page = $estModif ? 'Modifier le projet' : 'Nouveau projet';
require ROOT_PATH . '/app/views/includes/admin-header.php';
?>

<a href="<?= BASE_URL ?>/admin/projets" class="text-slate-400 hover:text-white text-sm mb-5 inline-block">← Retour</a>

<form method="POST"
      action="<?= BASE_URL ?>/admin/projets/<?= $estModif ? $projet['id'] . '/enregistrer' : 'creer' ?>"
      enctype="multipart/form-data"
      class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">

    <!-- Colonne principale -->
    <div class="lg:col-span-2 bg-slate-900 rounded-xl border border-slate-800 p-5 space-y-4">

        <div>
            <label class="block text-xs text-slate-400 mb-1">Titre *</label>
            <input type="text" name="titre" required value="<?= htmlspecialchars($projet['titre'] ?? '') ?>"
                   class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-1">Description courte *</label>
            <textarea name="description" rows="3" required
                      class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500 resize-none"><?= htmlspecialchars($projet['description'] ?? '') ?></textarea>
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-1">Description complète</label>
            <textarea name="description_longue" rows="5"
                      class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500 resize-none"><?= htmlspecialchars($projet['description_longue'] ?? '') ?></textarea>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-xs text-slate-400 mb-1">Lien site</label>
                <input type="url" name="lien_site" value="<?= htmlspecialchars($projet['lien_site'] ?? '') ?>"
                       class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">GitHub</label>
                <input type="url" name="lien_github" value="<?= htmlspecialchars($projet['lien_github'] ?? '') ?>"
                       class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
        </div>

        <!-- Compétences -->
        <div>
            <label class="block text-xs text-slate-400 mb-2">Compétences associées</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                <?php foreach ($competences as $comp): ?>
                <label class="flex items-center gap-2 cursor-pointer text-xs text-slate-400 hover:text-white">
                    <input type="checkbox" name="competences[]" value="<?= $comp['id'] ?>"
                           <?= in_array($comp['id'], $comps_selectionnees) ? 'checked' : '' ?>
                           class="accent-indigo-500">
                    <?= htmlspecialchars($comp['nom']) ?>
                </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Colonne droite -->
    <div class="space-y-4">
        <div class="bg-slate-900 rounded-xl border border-slate-800 p-5 space-y-3">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="mis_en_avant" value="1"
                       <?= !empty($projet['mis_en_avant']) ? 'checked' : '' ?>
                       class="accent-indigo-500">
                <span class="text-slate-300 text-sm">Mis en avant (accueil)</span>
            </label>

            <div>
                <label class="block text-xs text-slate-400 mb-1">Ordre d'affichage</label>
                <input type="number" name="ordre" min="0" value="<?= (int)($projet['ordre'] ?? 0) ?>"
                       class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
        </div>

        <div class="bg-slate-900 rounded-xl border border-slate-800 p-5">
            <label class="block text-xs text-slate-400 mb-2">Image du projet</label>
            <?php if (!empty($projet['image'])): ?>
            <img src="<?= BASE_URL ?>/<?= htmlspecialchars($projet['image']) ?>" alt=""
                 class="w-full h-24 object-cover rounded-lg border border-slate-700 mb-2">
            <?php endif; ?>
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp,.gif"
                   class="text-slate-400 text-xs file:bg-indigo-600 file:text-white file:border-0 file:rounded-lg file:px-2 file:py-1 file:mr-2 file:cursor-pointer">
        </div>

        <button type="submit"
                class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition-colors">
            <?= $estModif ? 'Mettre à jour' : 'Créer le projet' ?>
        </button>
    </div>
</form>

<?php require ROOT_PATH . '/app/views/includes/admin-footer.php'; ?>
