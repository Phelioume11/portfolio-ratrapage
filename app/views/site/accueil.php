<?php require ROOT_PATH . '/app/views/includes/header.php'; ?>

<!-- ========== HERO ========== -->
<section class="min-h-screen flex items-center">
    <div class="max-w-5xl mx-auto px-4 py-20 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

        <!-- Texte -->
        <div>
            <span class="inline-block px-3 py-1 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 rounded-full text-sm mb-5">
                Disponible pour alternance
            </span>

            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4 leading-tight">
                Bonjour, je suis<br>
                <span class="text-indigo-400"><?= htmlspecialchars(($profil['prenom'] ?? 'Prénom') . ' ' . ($profil['nom'] ?? 'Nom')) ?></span>
            </h1>

            <p class="text-indigo-300 text-lg mb-3 font-medium">
                <?= htmlspecialchars($profil['titre'] ?? '') ?>
            </p>

            <p class="text-slate-400 leading-relaxed mb-8 max-w-md">
                <?= htmlspecialchars($profil['bio'] ?? '') ?>
            </p>

            <div class="flex flex-wrap gap-3">
                <a href="<?= BASE_URL ?>/contact"
                   class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors inline-flex items-center gap-2">
                    <span>Me contacter</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>

                <?php if (!empty($profil['cv'])): ?>
                <a href="<?= BASE_URL ?>/<?= htmlspecialchars($profil['cv']) ?>" download
                   class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-white font-medium rounded-lg border border-slate-700 transition-colors inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Télécharger mon CV</span>
                </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Photo -->
        <div class="flex justify-center md:justify-end">
            <div class="w-64 h-64 rounded-2xl overflow-hidden border-2 border-slate-700">
                <?php if (!empty($profil['photo'])): ?>
                    <img src="<?= BASE_URL ?>/<?= htmlspecialchars($profil['photo']) ?>"
                         alt="Photo de profil"
                         class="w-full h-full object-cover">
                <?php else: ?>
                    <div class="w-full h-full bg-slate-800 flex items-center justify-center">
                        <span class="text-7xl font-bold text-indigo-400">
                            <?= strtoupper(substr($profil['prenom'] ?? 'P', 0, 1)) ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>

<!-- ========== INFOS DE CONTACT ========== -->
<section class="py-12 bg-slate-900/50">
    <div class="max-w-5xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            <?php if (!empty($profil['email'])): ?>
            <div class="bg-slate-800 rounded-xl p-4 border border-slate-700">
                <p class="text-slate-500 text-xs mb-1">Email</p>
                <p class="text-white text-sm font-medium break-all"><?= htmlspecialchars($profil['email']) ?></p>
            </div>
            <?php endif; ?>

            <?php if (!empty($profil['telephone'])): ?>
            <div class="bg-slate-800 rounded-xl p-4 border border-slate-700">
                <p class="text-slate-500 text-xs mb-1">Téléphone</p>
                <p class="text-white text-sm font-medium"><?= htmlspecialchars($profil['telephone']) ?></p>
            </div>
            <?php endif; ?>

            <?php if (!empty($profil['ville'])): ?>
            <div class="bg-slate-800 rounded-xl p-4 border border-slate-700">
                <p class="text-slate-500 text-xs mb-1">Ville</p>
                <p class="text-white text-sm font-medium"><?= htmlspecialchars($profil['ville']) ?></p>
            </div>
            <?php endif; ?>

            <div class="bg-slate-800 rounded-xl p-4 border border-slate-700">
                <p class="text-slate-500 text-xs mb-1">Statut</p>
                <p class="text-green-400 text-sm font-medium">Disponible</p>
            </div>

        </div>
    </div>
</section>

<!-- ========== COMPÉTENCES ========== -->
<section id="competences" class="py-20">
    <div class="max-w-5xl mx-auto px-4">

        <h2 class="text-3xl font-bold text-white mb-2">Compétences</h2>
        <div class="w-12 h-1 bg-indigo-500 mb-10 rounded"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($competences as $cat): ?>
            <div class="bg-slate-900 rounded-xl p-6 border border-slate-800">
                <h3 class="text-white font-semibold mb-5 text-lg"><?= htmlspecialchars($cat['nom']) ?></h3>

                <div class="grid grid-cols-3 gap-4">
                    <?php foreach ($cat['competences'] as $comp): ?>
                    <div class="flex flex-col items-center gap-2 group">
                        <?php if (!empty($comp['logo'])): ?>
                            <div class="w-14 h-14 rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center overflow-hidden group-hover:border-indigo-500 transition-colors">
                                <img src="<?= BASE_URL ?>/<?= htmlspecialchars($comp['logo']) ?>" 
                                     alt="<?= htmlspecialchars($comp['nom']) ?>"
                                     class="w-10 h-10 object-contain">
                            </div>
                        <?php else: ?>
                            <div class="w-14 h-14 rounded-lg bg-slate-800 border border-slate-700 flex items-center justify-center text-xl group-hover:border-indigo-500 transition-colors">
                                💻
                            </div>
                        <?php endif; ?>
                        <span class="text-slate-400 text-xs text-center group-hover:text-white transition-colors">
                            <?= htmlspecialchars($comp['nom']) ?>
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ========== EXPÉRIENCES ========== -->
<section id="experiences" class="py-20 bg-slate-900/50">
    <div class="max-w-5xl mx-auto px-4">

        <h2 class="text-3xl font-bold text-white mb-2">Parcours</h2>
        <div class="w-12 h-1 bg-indigo-500 mb-10 rounded"></div>

        <?php
        $travail   = array_filter($experiences, fn($e) => $e['type'] === 'travail');
        $formation = array_filter($experiences, fn($e) => $e['type'] === 'formation');
        ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            <!-- Pro -->
            <div>
                <h3 class="text-white font-semibold text-lg mb-5">💼 Expériences</h3>
                <?php if (empty($travail)): ?>
                    <p class="text-slate-500 text-sm">Aucune expérience professionnelle.</p>
                <?php else: ?>
                <div class="border-l-2 border-slate-700 pl-5 space-y-5">
                    <?php foreach ($travail as $exp): ?>
                    <div class="relative">
                        <span class="absolute -left-7 top-1 w-3 h-3 rounded-full bg-indigo-500 border-2 border-slate-900"></span>
                        <div class="bg-slate-800 rounded-xl p-4 border border-slate-700">
                            <p class="text-indigo-400 text-xs font-medium mb-1">
                                <?= date('m/Y', strtotime($exp['date_debut'])) ?> —
                                <?= $exp['en_cours'] ? 'Présent' : ($exp['date_fin'] ? date('m/Y', strtotime($exp['date_fin'])) : '?') ?>
                            </p>
                            <h4 class="text-white font-semibold"><?= htmlspecialchars($exp['poste']) ?></h4>
                            <p class="text-slate-400 text-sm"><?= htmlspecialchars($exp['entreprise']) ?></p>
                            <?php if (!empty($exp['lieu'])): ?>
                                <p class="text-slate-500 text-xs mt-1">📍 <?= htmlspecialchars($exp['lieu']) ?></p>
                            <?php endif; ?>
                            <?php if (!empty($exp['description'])): ?>
                                <p class="text-slate-400 text-sm mt-2"><?= htmlspecialchars($exp['description']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Formation -->
            <div>
                <h3 class="text-white font-semibold text-lg mb-5">🎓 Formation</h3>
                <?php if (empty($formation)): ?>
                    <p class="text-slate-500 text-sm">Aucune formation renseignée.</p>
                <?php else: ?>
                <div class="border-l-2 border-slate-700 pl-5 space-y-5">
                    <?php foreach ($formation as $exp): ?>
                    <div class="relative">
                        <span class="absolute -left-7 top-1 w-3 h-3 rounded-full bg-violet-500 border-2 border-slate-900"></span>
                        <div class="bg-slate-800 rounded-xl p-4 border border-slate-700">
                            <p class="text-violet-400 text-xs font-medium mb-1">
                                <?= date('m/Y', strtotime($exp['date_debut'])) ?> —
                                <?= $exp['en_cours'] ? 'Présent' : ($exp['date_fin'] ? date('m/Y', strtotime($exp['date_fin'])) : '?') ?>
                            </p>
                            <h4 class="text-white font-semibold"><?= htmlspecialchars($exp['poste']) ?></h4>
                            <p class="text-slate-400 text-sm"><?= htmlspecialchars($exp['entreprise']) ?></p>
                            <?php if (!empty($exp['lieu'])): ?>
                                <p class="text-slate-500 text-xs mt-1">📍 <?= htmlspecialchars($exp['lieu']) ?></p>
                            <?php endif; ?>
                            <?php if (!empty($exp['description'])): ?>
                                <p class="text-slate-400 text-sm mt-2"><?= htmlspecialchars($exp['description']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<!-- ========== PROJETS ========== -->
<section id="projets" class="py-20">
    <div class="max-w-5xl mx-auto px-4">

        <div class="mb-10">
            <h2 class="text-3xl font-bold text-white mb-2">Projets</h2>
            <div class="w-12 h-1 bg-indigo-500 rounded"></div>
        </div>

        <?php if (empty($projets)): ?>
        <p class="text-slate-500 text-center py-10">Aucun projet pour le moment.</p>
        <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php foreach ($projets as $projet): ?>
            <a href="<?= BASE_URL ?>/projet/<?= htmlspecialchars($projet['slug']) ?>"
               class="bg-slate-900 rounded-xl border border-slate-800 overflow-hidden hover:border-indigo-500/40 transition-colors block">

                <!-- Miniature -->
                <div class="h-36 bg-slate-800 overflow-hidden">
                    <?php if (!empty($projet['image'])): ?>
                        <img src="<?= BASE_URL ?>/<?= htmlspecialchars($projet['image']) ?>"
                             alt="<?= htmlspecialchars($projet['titre']) ?>"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-5xl">💻</div>
                    <?php endif; ?>
                </div>

                <div class="p-4">
                    <h3 class="text-white font-semibold mb-1"><?= htmlspecialchars($projet['titre']) ?></h3>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        <?= htmlspecialchars(mb_strimwidth($projet['description'] ?? '', 0, 80, '…')) ?>
                    </p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php require ROOT_PATH . '/app/views/includes/footer.php'; ?>
