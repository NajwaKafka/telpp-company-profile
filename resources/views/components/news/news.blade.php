<!DOCTYPE html>

<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2d5a27",
                        "secondary": "#2d5a27",
                        "background-light": "#f8f7f6",
                        "background-dark": "#221910",
                    },
                    fontFamily: {
                        "display": ["Work Sans", "sans-serif"]
                    },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
<title>TEL Minimalist News Grid</title>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">

<!-- News Grid -->
<div id="news-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @include('components.news.news_cards_partial', ['data' => $data])
</div>

<!-- Load More Button -->
@if($data->hasMorePages())
<div id="load-more-container" class="mt-16 flex flex-col items-center gap-6">
    <button id="load-more-btn" data-page="1" class="px-8 py-3 bg-primary text-white font-bold rounded-full hover:bg-opacity-90 transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
        <span>Load More</span>
        <span class="material-symbols-outlined text-sm">expand_more</span>
    </button>
    <p id="loading-indicator" class="hidden text-slate-400 text-xs font-medium uppercase tracking-widest animate-pulse">Loading more articles...</p>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more-btn');
    const newsContainer = document.getElementById('news-container');
    const loadMoreContainer = document.getElementById('load-more-container');
    const loadingIndicator = document.getElementById('loading-indicator');

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            let currentPage = parseInt(this.getAttribute('data-page'));
            let nextPage = currentPage + 1;
            
            // UI States
            loadMoreBtn.classList.add('hidden');
            loadingIndicator.classList.remove('hidden');

            fetch(`/news?page=${nextPage}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Append new content
                newsContainer.insertAdjacentHTML('beforeend', data.html);
                
                // Update page number
                loadMoreBtn.setAttribute('data-page', nextPage);
                
                // UI States
                loadingIndicator.classList.add('hidden');
                
                if (data.hasMore) {
                    loadMoreBtn.classList.remove('hidden');
                } else {
                    loadMoreContainer.remove();
                }
            })
            .catch(error => {
                console.error('Error loading more news:', error);
                loadMoreBtn.classList.remove('hidden');
                loadingIndicator.classList.add('hidden');
            });
        });
    }
});
</script>
</div>
</footer>
</div>
</body></html>