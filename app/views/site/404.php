<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page introuvable</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #0f172a; }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        .glitch {
            position: relative;
        }
        .glitch::before,
        .glitch::after {
            content: '404';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: inherit;
            -webkit-background-clip: text;
            background-clip: text;
        }
        .glitch::before {
            animation: glitch-1 2s infinite;
            clip-path: polygon(0 0, 100% 0, 100% 45%, 0 45%);
        }
        .glitch::after {
            animation: glitch-2 2s infinite;
            clip-path: polygon(0 55%, 100% 55%, 100% 100%, 0 100%);
        }
        @keyframes glitch-1 {
            0%, 95%, 100% { transform: translateX(0); }
            96%, 97% { transform: translateX(-3px); }
            98%, 99% { transform: translateX(3px); }
        }
        @keyframes glitch-2 {
            0%, 95%, 100% { transform: translateX(0); }
            96%, 97% { transform: translateX(3px); }
            98%, 99% { transform: translateX(-3px); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4">
    
    <!-- Background decoration -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-indigo-500/10 rounded-full blur-3xl pulse-slow"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-violet-500/10 rounded-full blur-3xl pulse-slow" style="animation-delay: 2s;"></div>
    </div>

    <div class="relative z-10 max-w-2xl w-full text-center">
        
        <!-- 404 Number -->
        <div class="mb-8 float-animation">
            <div class="glitch text-9xl sm:text-[12rem] font-bold text-transparent bg-clip-text bg-gradient-to-br from-indigo-400 via-violet-400 to-cyan-400 leading-none">
                404
            </div>
        </div>

        <!-- Message -->
        <div class="mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                Page introuvable
            </h1>
            <p class="text-slate-400 text-lg max-w-md mx-auto leading-relaxed">
                Oups ! La page que vous recherchez semble s'être égarée dans le cyberespace.
            </p>
        </div>

        <!-- Suggestions -->
        <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-2xl p-6 mb-8 max-w-lg mx-auto">
            <p class="text-slate-300 text-sm mb-4">Suggestions :</p>
            <div class="space-y-2 text-sm">
                <div class="flex items-center gap-2 text-slate-400">
                    <span class="text-indigo-400">→</span>
                    Vérifiez l'URL saisie
                </div>
                <div class="flex items-center gap-2 text-slate-400">
                    <span class="text-indigo-400">→</span>
                    Retournez à la page d'accueil
                </div>
                <div class="flex items-center gap-2 text-slate-400">
                    <span class="text-indigo-400">→</span>
                    Utilisez le menu de navigation
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-wrap justify-center gap-4">
            <a href="<?= BASE_URL ?>/" 
               class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition-all duration-200 hover:scale-105 inline-flex items-center gap-2 shadow-lg shadow-indigo-500/20">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Retour à l'accueil</span>
            </a>

            <a href="<?= BASE_URL ?>/contact" 
               class="px-6 py-3 bg-slate-800 hover:bg-slate-700 text-white font-medium rounded-xl border border-slate-700 transition-all duration-200 hover:scale-105 inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span>Me contacter</span>
            </a>
        </div>

        <!-- Fun message -->
        <div class="mt-12">
            <p class="text-slate-600 text-xs">
                Erreur HTTP 404 • Page non trouvée
            </p>
        </div>

    </div>

</body>
</html>
