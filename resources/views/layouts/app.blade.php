<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'PulpCo - Sustaining Nature, Crafting Paper')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho+B1:wght@700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .material-symbols-filled { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
    @stack('styles')
</head>
<body class="bg-white text-slate-900 overflow-x-hidden">
    
    <!-- Page Progress Bar -->
    <div id="scroll-progress" class="fixed top-0 left-0 h-1 bg-primary z-[100] transition-all duration-150" style="width: 0%"></div>

    <!-- Scroll-to-Top Button -->
    <button id="scrollToTop" class="fixed bottom-8 right-8 size-14 bg-white/70 backdrop-blur-xl border border-slate-200 rounded-2xl flex items-center justify-center text-primary shadow-2xl opacity-0 invisible translate-y-10 group hover:bg-primary hover:text-white transition-all duration-500 z-50">
        <span class="material-symbols-outlined group-hover:-translate-y-1 transition-transform">north</span>
    </button>

    @include('components.header')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')
    <!-- Global Masterpiece Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const progress = document.getElementById('scroll-progress');
            const topBtn = document.getElementById('scrollToTop');

            window.addEventListener('scroll', () => {
                // Progress Bar
                const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (winScroll / height) * 100;
                progress.style.width = scrolled + "%";

                // Scroll to Top visibility
                if (winScroll > 300) {
                    topBtn.classList.remove('opacity-0', 'invisible', 'translate-y-10');
                    topBtn.classList.add('opacity-100', 'visible', 'translate-y-0');
                } else {
                    topBtn.classList.add('opacity-0', 'invisible', 'translate-y-10');
                    topBtn.classList.remove('opacity-100', 'visible', 'translate-y-0');
                }
            });

            topBtn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Mobile Menu Logic
            const mobileTrigger = document.getElementById('mobileMenuTrigger');
            const mobileClose = document.getElementById('mobileMenuClose');
            const mobileMenu = document.getElementById('mobileMenu');

            if (mobileTrigger && mobileMenu) {
                mobileTrigger.addEventListener('click', () => {
                    mobileMenu.classList.remove('translate-x-full');
                    document.body.classList.add('overflow-hidden');
                });

                mobileClose.addEventListener('click', () => {
                    mobileMenu.classList.add('translate-x-full');
                    document.body.classList.remove('overflow-hidden');
                });

                // Close on link click
                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.classList.add('translate-x-full');
                        document.body.classList.remove('overflow-hidden');
                    });
                });
            }

            // Intersection Observer (Existing)
            const observerOptions = {
                threshold: 0.15,
                rootMargin: '0px 0px -50px 0px'
            };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('reveal-visible');
                    }
                });
            }, observerOptions);
            document.querySelectorAll('.reveal-hidden').forEach((el) => observer.observe(el));
        });
    </script>
</body>
</html>
