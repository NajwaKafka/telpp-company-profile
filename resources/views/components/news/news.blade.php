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
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
<!-- Card 1 -->
@foreach($data as $data)
<article class="group bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 dark:border-slate-800">
<div class="aspect-[16/10] overflow-hidden">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Modern sustainable factory building with greenery" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB5Zdnlc-VmzGgmp_Fc-ENqsU3jikzRlZZpneHBzuZpYCDxqyCUc9zpWIQr_JVuqzY_UBzkS_A7ebRFlGtKwbNu4zYaiRgmbAtm4-6NGdXQPk62OIi5U0iwhQLJUS3wZwZ8l4LjAlWLDWOz_gK-AFbH9NYIafyw91hGwlGq52dNsawh9cYM4dqh4NOvxc6wepUxSZUVsub4a_lx3PTrtsHF35G4OP3qLmTJBWJ5x2ZRWqH35H-5a9lHcoImMsgCC2r-ZPdB5fOcwIlK"/>
</div>
<div class="p-6">
<span class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2 block">Corporate • Oct 24, 2023</span>
<h3 class="text-xl font-bold leading-tight group-hover:text-primary transition-colors cursor-pointer">{{$data->title}}</h3>
<p class="mt-3 text-slate-500 dark:text-slate-400 text-sm line-clamp-2">{{$data->summary}}</p>
</div>
</article>
@endforeach
</div>
<!-- Sleek Pagination -->
<div class="mt-16 flex flex-col items-center gap-6">
<div class="flex items-center gap-2">
<button class="w-10 h-10 flex items-center justify-center rounded-full border border-slate-200 dark:border-slate-800 hover:bg-slate-100 transition-colors">
<span class="material-symbols-outlined text-sm">chevron_left</span>
</button>
<button class="w-10 h-10 flex items-center justify-center rounded-full bg-secondary text-white font-bold">1</button>
<button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-100 transition-colors font-medium">2</button>
<button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-100 transition-colors font-medium">3</button>
<span class="px-2 text-slate-400">...</span>
<button class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-100 transition-colors font-medium">12</button>
<button class="w-10 h-10 flex items-center justify-center rounded-full bg-primary text-white hover:opacity-90 transition-opacity">
<span class="material-symbols-outlined text-sm">chevron_right</span>
</button>
</div>
<p class="text-slate-400 text-xs font-medium uppercase tracking-widest">Showing 6 of 72 Articles</p>
</div>
</div>
</footer>
</div>
</body></html>