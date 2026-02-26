<?php $titre_page = 'Mon profil'; require ROOT_PATH . '/app/views/includes/admin-header.php'; ?>

<?php if ($succes): ?>
<div class="mb-4 bg-green-500/10 border border-green-500/30 rounded-lg p-3 text-green-400 text-sm">✓ Profil enregistré.</div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL ?>/admin/profil/enregistrer" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">

    <!-- Infos perso -->
    <div class="bg-slate-900 rounded-xl border border-slate-800 p-5 space-y-4">
        <h2 class="font-semibold text-white mb-2">Informations</h2>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-xs text-slate-400 mb-1">Prénom</label>
                <input type="text" name="prenom" value="<?= htmlspecialchars($profil['prenom'] ?? '') ?>"
                       class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Nom</label>
                <input type="text" name="nom" value="<?= htmlspecialchars($profil['nom'] ?? '') ?>"
                       class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-1">Titre</label>
            <input type="text" name="titre" value="<?= htmlspecialchars($profil['titre'] ?? '') ?>"
                   placeholder="Développeur Web Full Stack"
                   class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-1">Bio</label>
            <textarea name="bio" rows="4"
                      class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500 resize-none"><?= htmlspecialchars($profil['bio'] ?? '') ?></textarea>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-xs text-slate-400 mb-1">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($profil['email'] ?? '') ?>"
                       class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs text-slate-400 mb-1">Téléphone</label>
                <input type="text" name="telephone" value="<?= htmlspecialchars($profil['telephone'] ?? '') ?>"
                       class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
            </div>
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-1">Ville</label>
            <input type="text" name="ville" value="<?= htmlspecialchars($profil['ville'] ?? '') ?>"
                   class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-1">GitHub</label>
            <input type="url" name="github" value="<?= htmlspecialchars($profil['github'] ?? '') ?>"
                   class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
        </div>

        <div>
            <label class="block text-xs text-slate-400 mb-1">LinkedIn</label>
            <input type="url" name="linkedin" value="<?= htmlspecialchars($profil['linkedin'] ?? '') ?>"
                   class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white text-sm focus:outline-none focus:border-indigo-500">
        </div>
    </div>

    <!-- Photo & CV -->
    <div class="space-y-5">
        <div class="bg-slate-900 rounded-xl border border-slate-800 p-5">
            <h2 class="font-semibold text-white mb-4">Photo de profil</h2>
            <?php if (!empty($profil['photo'])): ?>
            <img src="<?= BASE_URL ?>/<?= htmlspecialchars($profil['photo']) ?>" alt="Photo"
                 class="w-16 h-16 rounded-xl object-cover border border-slate-700 mb-3">
            <?php endif; ?>
            <input type="file" name="photo" accept=".jpg,.jpeg,.png,.webp"
                   class="text-slate-400 text-xs file:bg-indigo-600 file:text-white file:border-0 file:rounded-lg file:px-3 file:py-1.5 file:mr-2 file:cursor-pointer">
            <p class="text-slate-600 text-xs mt-1">JPG, PNG, WebP — max 5 Mo</p>
        </div>

        <div class="bg-slate-900 rounded-xl border border-slate-800 p-5">
            <h2 class="font-semibold text-white mb-4">CV (PDF)</h2>
            <?php if (!empty($profil['cv'])): ?>
            <p class="text-green-400 text-xs mb-2">✓ CV déjà uploadé — <a href="<?= BASE_URL ?>/<?= htmlspecialchars($profil['cv']) ?>" target="_blank" class="underline">voir</a></p>
            <?php endif; ?>
            <input type="file" name="cv" accept=".pdf"
                   class="text-slate-400 text-xs file:bg-indigo-600 file:text-white file:border-0 file:rounded-lg file:px-3 file:py-1.5 file:mr-2 file:cursor-pointer">
            <p class="text-slate-600 text-xs mt-1">PDF uniquement — max 5 Mo</p>
        </div>

        <button type="submit"
                class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition-colors">
            Enregistrer
        </button>
    </div>
</form>

<?php require ROOT_PATH . '/app/views/includes/admin-footer.php'; ?>
