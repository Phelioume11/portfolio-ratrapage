<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; background: #0f172a; }</style>
</head>
<body class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-sm">
        <div class="text-center mb-8">
            <div class="w-14 h-14 bg-indigo-600 rounded-xl mx-auto flex items-center justify-center text-white text-2xl font-bold mb-3">A</div>
            <h1 class="text-xl font-bold text-white">Administration</h1>
            <p class="text-slate-500 text-sm mt-1">Accès réservé</p>
        </div>

        <div class="bg-slate-900 rounded-xl border border-slate-800 p-6">

            <?php if ($erreur): ?>
            <div class="bg-red-500/10 border border-red-500/30 rounded-lg p-3 mb-4 text-red-400 text-sm">
                <?= htmlspecialchars($erreur) ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="<?= BASE_URL ?>/admin/connexion" class="space-y-4">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">

                <div>
                    <label class="block text-sm text-slate-400 mb-1">Email</label>
                    <input type="email" name="email" required autocomplete="email"
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                           class="w-full px-3 py-2.5 bg-slate-800 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-indigo-500 text-sm">
                </div>

                <div>
                    <label class="block text-sm text-slate-400 mb-1">Mot de passe</label>
                    <input type="password" name="password" required
                           class="w-full px-3 py-2.5 bg-slate-800 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-indigo-500 text-sm">
                </div>

                <button type="submit"
                        class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors">
                    Se connecter
                </button>
            </form>
        </div>

        <p class="text-center mt-4">
            <a href="<?= BASE_URL ?>/" class="text-slate-600 hover:text-slate-400 text-xs transition-colors">← Retour au portfolio</a>
        </p>
    </div>
</body>
</html>
