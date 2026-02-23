<?php $titre_page = 'Compétences'; require ROOT_PATH . '/app/views/includes/admin-header.php'; ?>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Formulaire ajout -->
    <div class="bg-slate-900 rounded-xl border border-slate-800 p-5">
        <h2 class="font-semibold text-white mb-4">Ajouter une compétence</h2>
        <form method="POST" action="<?= BASE_URL ?>/admin/competences/ajouter" enctype="multipart/form-data" class="space-y-3">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">

            <div>
                <label class="block text-xs text-slate-400 mb-1">Catégorie</label>
                <select name="categorie_id" class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-xs text-slate-400 mb-1">Nom</label>
                <input type="text" name="nom" required placeholder="PHP, React, Git..."
                       class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-xs text-slate-400 mb-1">Logo (optionnel)</label>
                <input type="file" name="logo" accept=".png,.jpg,.jpeg,.svg,.webp"
                       class="text-slate-400 text-xs file:bg-indigo-600 file:text-white file:border-0 file:rounded-lg file:px-2 file:py-1 file:mr-2 file:cursor-pointer">
                <p class="text-slate-600 text-xs mt-1">PNG, JPG, SVG — Logos langages/technologies</p>
            </div>

            <div>
                <label class="block text-xs text-slate-400 mb-1">Ordre</label>
                <input type="number" name="ordre" min="0" value="0"
                       class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <button type="submit" class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm rounded-lg transition-colors">
                Ajouter
            </button>
        </form>
    </div>

    <!-- Liste par catégorie -->
    <div class="space-y-4">
        <?php foreach ($categories as $cat): ?>
        <div class="bg-slate-900 rounded-xl border border-slate-800 p-4">
            <h3 class="font-semibold text-white mb-3"><?= htmlspecialchars($cat['nom']) ?></h3>
            <?php if (empty($cat['competences'])): ?>
            <p class="text-slate-600 text-xs">Aucune compétence.</p>
            <?php else: ?>
            <div class="space-y-2">
                <?php foreach ($cat['competences'] as $comp): ?>
                <div class="flex items-center justify-between gap-3 group p-2 rounded-lg hover:bg-slate-800">
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <?php if (!empty($comp['logo'])): ?>
                            <img src="<?= BASE_URL ?>/<?= htmlspecialchars($comp['logo']) ?>" 
                                 alt="<?= htmlspecialchars($comp['nom']) ?>"
                                 class="w-8 h-8 object-contain flex-shrink-0">
                        <?php else: ?>
                            <div class="w-8 h-8 rounded bg-slate-700 flex items-center justify-center text-sm flex-shrink-0">💻</div>
                        <?php endif; ?>
                        <span class="text-slate-300 text-sm"><?= htmlspecialchars($comp['nom']) ?></span>
                    </div>
                    <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity flex-shrink-0">
                        <button onclick='ouvrirModif(<?= json_encode($comp) ?>)'
                                class="text-xs px-2 py-1 bg-slate-800 border border-slate-700 text-slate-400 hover:text-white rounded transition-colors">
                            ✏️
                        </button>
                        <a href="<?= BASE_URL ?>/admin/competences/<?= $comp['id'] ?>/supprimer"
                           data-confirm="Supprimer cette compétence ?"
                           class="text-xs px-2 py-1 bg-red-500/10 border border-red-500/20 text-red-400 rounded transition-colors">
                            🗑
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal modification -->
<div id="modalModif" class="hidden fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4">
    <div class="bg-slate-900 rounded-xl border border-slate-800 p-5 w-full max-w-sm">
        <h3 class="font-semibold text-white mb-4">Modifier la compétence</h3>
        <form method="POST" action="<?= BASE_URL ?>/admin/competences/modifier" enctype="multipart/form-data" class="space-y-3">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">
            <input type="hidden" name="id" id="modifId">

            <div>
                <label class="block text-xs text-slate-400 mb-1">Catégorie</label>
                <select name="categorie_id" id="modifCategorie" class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none">
                    <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-xs text-slate-400 mb-1">Nom</label>
                <input type="text" name="nom" id="modifNom" required
                       class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm">
            </div>

            <div>
                <label class="block text-xs text-slate-400 mb-1">Nouveau logo (optionnel)</label>
                <input type="file" name="logo" accept=".png,.jpg,.jpeg,.svg,.webp"
                       class="text-slate-400 text-xs file:bg-indigo-600 file:text-white file:border-0 file:rounded-lg file:px-2 file:py-1 file:mr-2 file:cursor-pointer">
                <p class="text-slate-600 text-xs mt-1" id="logoActuel"></p>
            </div>

            <div>
                <label class="block text-xs text-slate-400 mb-1">Ordre</label>
                <input type="number" name="ordre" id="modifOrdre" min="0"
                       class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm">
            </div>

            <div class="flex gap-3 pt-1">
                <button type="button" onclick="fermerModif()"
                        class="flex-1 py-2 bg-slate-800 border border-slate-700 text-slate-400 rounded-lg text-sm">Annuler</button>
                <button type="submit"
                        class="flex-1 py-2 bg-indigo-600 text-white rounded-lg text-sm">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<script>
function ouvrirModif(comp) {
    document.getElementById('modifId').value        = comp.id;
    document.getElementById('modifNom').value       = comp.nom;
    document.getElementById('modifCategorie').value = comp.categorie_id;
    document.getElementById('modifOrdre').value     = comp.ordre || 0;
    document.getElementById('logoActuel').textContent = comp.logo ? ('Logo actuel : ' + comp.logo) : 'Pas de logo';
    document.getElementById('modalModif').classList.remove('hidden');
}
function fermerModif() {
    document.getElementById('modalModif').classList.add('hidden');
}
document.getElementById('modalModif').addEventListener('click', function(e) {
    if (e.target === this) fermerModif();
});
</script>

<?php require ROOT_PATH . '/app/views/includes/admin-footer.php'; ?>
