<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titre_page) ? htmlspecialchars($titre_page) . ' — ' : '' ?><?= htmlspecialchars(($profil['prenom'] ?? '') . ' ' . ($profil['nom'] ?? '')) ?></title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; background: #0f172a; color: #e2e8f0; }
        .skill-bar { transition: width 1.2s ease; }
    </style>
</head>
<body class="min-h-screen">

<!-- Navigation -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-slate-900/80 backdrop-blur border-b border-slate-800">
    <div class="max-w-5xl mx-auto px-4 flex items-center justify-between h-14">

        <a href="<?= BASE_URL ?>/" class="font-bold text-white text-lg">
            <?= htmlspecialchars(($profil['prenom'] ?? 'Portfolio') . ' ' . ($profil['nom'] ?? '')) ?>
        </a>

        <!-- Menu desktop -->
        <div class="hidden md:flex items-center gap-6 text-sm">
            <a href="<?= BASE_URL ?>/#competences" class="text-slate-400 hover:text-white transition-colors">Compétences</a>
            <a href="<?= BASE_URL ?>/#experiences" class="text-slate-400 hover:text-white transition-colors">Expériences</a>
            <a href="<?= BASE_URL ?>/#projets" class="text-slate-400 hover:text-white transition-colors">Projets</a>
            <a href="<?= BASE_URL ?>/contact" class="text-slate-400 hover:text-white transition-colors">Contact</a>
            <?php if (!empty($profil['cv'])): ?>
            <a href="<?= BASE_URL ?>/<?= htmlspecialchars($profil['cv']) ?>" download
               class="px-3 py-1.5 bg-primary text-white rounded-lg text-xs font-medium hover:bg-indigo-700 transition-colors">
                Télécharger CV
            </a>
            <?php endif; ?>
        </div>

        <!-- Menu mobile -->
        <button id="btnMenu" class="md:hidden text-slate-400">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <!-- Menu mobile déroulant -->
    <div id="menuMobile" class="hidden md:hidden px-4 pb-4 flex flex-col gap-2 text-sm border-t border-slate-800">
        <a href="<?= BASE_URL ?>/#competences" class="text-slate-400 py-1">Compétences</a>
        <a href="<?= BASE_URL ?>/#experiences" class="text-slate-400 py-1">Expériences</a>
        <a href="<?= BASE_URL ?>/#projets" class="text-slate-400 py-1">Projets</a>
        <a href="<?= BASE_URL ?>/contact" class="text-slate-400 py-1">Contact</a>
    </div>
</nav>

<main class="pt-14">
