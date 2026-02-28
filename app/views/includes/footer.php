</main>

<!-- Footer -->
<footer class="bg-slate-900 border-t border-slate-800 mt-20 py-10">
    <div class="max-w-5xl mx-auto px-4 flex flex-col sm:flex-row justify-between items-center gap-4">
        <p class="text-slate-500 text-sm">
            © <?= date('Y') ?> <?= htmlspecialchars(($profil['prenom'] ?? '') . ' ' . ($profil['nom'] ?? '')) ?>
        </p>

        <div class="flex items-center gap-4">
            <?php if (!empty($profil['github'])): ?>
            <a href="<?= htmlspecialchars($profil['github']) ?>" target="_blank"
               class="text-slate-500 hover:text-white transition-colors text-sm">GitHub</a>
            <?php endif; ?>
            <?php if (!empty($profil['linkedin'])): ?>
            <a href="<?= htmlspecialchars($profil['linkedin']) ?>" target="_blank"
               class="text-slate-500 hover:text-white transition-colors text-sm">LinkedIn</a>
            <?php endif; ?>
            <a href="<?= BASE_URL ?>/admin/connexion"
               class="text-slate-700 hover:text-slate-500 transition-colors text-xs">Admin</a>
        </div>
    </div>
</footer>

<script>
    // Menu mobile
    document.getElementById('btnMenu').addEventListener('click', function() {
        document.getElementById('menuMobile').classList.toggle('hidden');
    });

    // Animation des barres de compétences
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                const barre = entry.target;
                barre.style.width = barre.dataset.largeur + '%';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.skill-bar').forEach(function(barre) {
        barre.style.width = '0%';
        observer.observe(barre);
    });
</script>
</body>
</html>
