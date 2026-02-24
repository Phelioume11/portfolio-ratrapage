<?php
$estModif   = !empty($exp['id']);
$titre_page = $estModif ? 'Modifier l\'expérience' : 'Nouvelle expérience';
require ROOT_PATH . '/app/views/includes/admin-header.php';
?>

<a href="<?= BASE_URL ?>/admin/experiences" class="text-slate-400 hover:text-white text-sm mb-5 inline-block">← Retour</a>

<div class="max-w-xl">
    <form method="POST"
          action="<?= BASE_URL ?>/admin/experiences/<?= $estModif ? $exp['id'] . '/enregistrer' : 'creer' ?>"
          class="bg-slate-900 rounded-xl border border-slate-800 p-5 space-y-4">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">

        <div>
            <label class="block text-xs text-slate-400 mb-1">Type</label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2 text-sm cursor-pointer text-slate-300">
                    <input type="radio" name="type" value="travail" <?= ($exp['type'] ?? 'travail') === 'travail' ? 'checked' : '' ?> class="accent-indigo-500">
                    💼 Professionnelle
                </label>
                <label class="flex items-center gap-2 text-sm cursor-pointer text-slate-300">
                    <input type="radio" name="type" value="formation" <?= ($exp['type'] ?? '') === 'formation' ? 'checked' : '' ?> class="accent-indigo-500">
                    🎓 Formation
                </label>
            </div>
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-1">Poste / Titre *</label>
            <input type="text" name="poste" required value="<?= htmlspecialchars($exp['poste'] ?? '') ?>"
                   class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-1">Entreprise / École *</label>
            <input type="text" name="entreprise" required value="<?= htmlspecialchars($exp['entreprise'] ?? '') ?>"
                   class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-1">Lieu</label>
            <input type="text" name="lieu" value="<?= htmlspecialchars($exp['lieu'] ?? '') ?>"
                   class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-xs text-slate-400 mb-1">Date de début *</label>
                <input type="date" name="date_debut" required value="<?= htmlspecialchars($exp['date_debut'] ?? '') ?>"
                       class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Date de fin</label>
                <input type="date" name="date_fin" id="date_fin" value="<?= htmlspecialchars($exp['date_fin'] ?? '') ?>"
                       class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
        </div>

        <label class="flex items-center gap-2 cursor-pointer text-slate-300 text-sm">
            <input type="checkbox" name="en_cours" id="en_cours" value="1"
                   <?= !empty($exp['en_cours']) ? 'checked' : '' ?> class="accent-indigo-500">
            Poste / formation en cours
        </label>

        <div>
            <label class="block text-xs text-slate-400 mb-1">Description</label>
            <textarea name="description" rows="4"
                      class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500 resize-none"><?= htmlspecialchars($exp['description'] ?? '') ?></textarea>
        </div>

        <div class="flex gap-3">
            <a href="<?= BASE_URL ?>/admin/experiences"
               class="flex-1 py-2 text-center bg-slate-800 border border-slate-700 text-slate-400 rounded-lg text-sm">Annuler</a>
            <button type="submit"
                    class="flex-1 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm transition-colors">
                <?= $estModif ? 'Mettre à jour' : 'Créer' ?>
            </button>
        </div>
    </form>
</div>

<script>
document.getElementById('en_cours').addEventListener('change', function() {
    document.getElementById('date_fin').disabled = this.checked;
});
</script>

<?php require ROOT_PATH . '/app/views/includes/admin-footer.php'; ?>
