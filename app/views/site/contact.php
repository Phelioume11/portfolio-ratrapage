<?php require ROOT_PATH . '/app/views/includes/header.php'; ?>

<section class="py-20">
    <div class="max-w-xl mx-auto px-4">

        <h1 class="text-4xl font-bold text-white mb-2">Contact</h1>
        <div class="w-12 h-1 bg-indigo-500 mb-8 rounded"></div>
        <p class="text-slate-400 mb-8">Vous avez une proposition ou une question ? Laissez-moi un message.</p>

        <?php if ($succes): ?>

        <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-6 text-center">
            <p class="text-3xl mb-2">✅</p>
            <p class="text-green-400 font-semibold text-lg mb-1">Message envoyé !</p>
            <p class="text-slate-400 text-sm">Je vous répondrai dans les plus brefs délais.</p>
            <a href="<?= BASE_URL ?>/" class="mt-4 inline-block text-indigo-400 hover:underline text-sm">← Retour à l'accueil</a>
        </div>

        <?php else: ?>

        <!-- Erreurs -->
        <?php if (!empty($erreurs)): ?>
        <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 mb-5">
            <?php foreach ($erreurs as $e): ?>
            <p class="text-red-400 text-sm">• <?= htmlspecialchars($e) ?></p>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>/contact" class="space-y-4">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">

            <div>
                <label class="block text-sm text-slate-400 mb-1">Nom *</label>
                <input type="text" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>"
                       placeholder="Votre nom"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-indigo-500 text-sm transition-colors">
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Email *</label>
                <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                       placeholder="votre@email.fr"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-indigo-500 text-sm transition-colors">
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Sujet *</label>
                <input type="text" name="sujet" value="<?= htmlspecialchars($_POST['sujet'] ?? '') ?>"
                       placeholder="Proposition de stage…"
                       class="w-full px-4 py-2.5 bg-slate-900 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-indigo-500 text-sm transition-colors">
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Message *</label>
                <textarea name="message" rows="5" placeholder="Votre message…"
                          class="w-full px-4 py-2.5 bg-slate-900 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-indigo-500 text-sm resize-none transition-colors"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
            </div>

            <button type="submit"
                    class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors">
                Envoyer le message
            </button>
        </form>

        <?php endif; ?>
    </div>
</section>

<?php require ROOT_PATH . '/app/views/includes/footer.php'; ?>
