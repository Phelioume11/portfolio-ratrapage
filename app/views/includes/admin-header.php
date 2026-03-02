<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — <?= htmlspecialchars($titre_page ?? 'Dashboard') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0f172a; color: #e2e8f0; }
        input, select, textarea { background: #1e293b !important; color: #e2e8f0 !important; }
    </style>
</head>
<body class="min-h-screen flex">

<!-- Sidebar -->
<aside class="w-56 flex-shrink-0 bg-slate-900 border-r border-slate-800 flex flex-col min-h-screen">

    <!-- Logo -->
    <div class="p-5 border-b border-slate-800">
        <p class="text-white font-bold">Admin</p>
        <p class="text-slate-500 text-xs"><?= htmlspecialchars($_SESSION['admin_nom'] ?? '') ?></p>
    </div>

    <!-- Nav -->
    <?php $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>
    <nav class="p-3 flex-1 space-y-0.5">

        <a href="<?= BASE_URL ?>/admin/dashboard"
           class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition-colors
                  <?= str_contains($uri, 'dashboard') ? 'bg-indigo-500/10 text-indigo-400' : 'text-slate-400 hover:text-white hover:bg-slate-800' ?>">
            📊 Dashboard
        </a>

        <a href="<?= BASE_URL ?>/admin/profil"
           class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition-colors
                  <?= str_contains($uri, 'profil') ? 'bg-indigo-500/10 text-indigo-400' : 'text-slate-400 hover:text-white hover:bg-slate-800' ?>">
            👤 Mon profil
        </a>

        <a href="<?= BASE_URL ?>/admin/projets"
           class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition-colors
                  <?= str_contains($uri, 'projet') ? 'bg-indigo-500/10 text-indigo-400' : 'text-slate-400 hover:text-white hover:bg-slate-800' ?>">
            💻 Projets
        </a>

        <a href="<?= BASE_URL ?>/admin/competences"
           class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition-colors
                  <?= str_contains($uri, 'competence') ? 'bg-indigo-500/10 text-indigo-400' : 'text-slate-400 hover:text-white hover:bg-slate-800' ?>">
            ⚡ Compétences
        </a>

        <a href="<?= BASE_URL ?>/admin/experiences"
           class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition-colors
                  <?= str_contains($uri, 'experience') ? 'bg-indigo-500/10 text-indigo-400' : 'text-slate-400 hover:text-white hover:bg-slate-800' ?>">
            🎯 Expériences
        </a>

        <a href="<?= BASE_URL ?>/admin/messages"
           class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition-colors
                  <?= str_contains($uri, 'message') ? 'bg-indigo-500/10 text-indigo-400' : 'text-slate-400 hover:text-white hover:bg-slate-800' ?>">
            ✉️ Messages
            <?php
            $nonLus = (new MessageModel())->compterNonLus();
            if ($nonLus > 0):
            ?>
            <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center"><?= $nonLus ?></span>
            <?php endif; ?>
        </a>
    </nav>

    <!-- Bas de sidebar -->
    <div class="p-3 border-t border-slate-800 space-y-0.5">
        <a href="<?= BASE_URL ?>/" target="_blank"
           class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-slate-400 hover:text-white text-sm transition-colors hover:bg-slate-800">
            🌐 Voir le site
        </a>
        <a href="<?= BASE_URL ?>/admin/deconnexion"
           class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-red-400 hover:bg-red-500/10 text-sm transition-colors">
            🚪 Déconnexion
        </a>
    </div>
</aside>

<!-- Contenu principal -->
<div class="flex-1 flex flex-col">
    <header class="bg-slate-900 border-b border-slate-800 px-6 py-3">
        <h1 class="text-white font-semibold"><?= htmlspecialchars($titre_page ?? 'Dashboard') ?></h1>
    </header>
    <main class="flex-1 p-6">
