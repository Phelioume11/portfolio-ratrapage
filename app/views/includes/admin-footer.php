    </main>
</div>

<script>
// Confirmation suppression
document.querySelectorAll('[data-confirm]').forEach(function(el) {
    el.addEventListener('click', function(e) {
        if (!confirm(this.dataset.confirm)) {
            e.preventDefault();
        }
    });
});
</script>
</body>
</html>
