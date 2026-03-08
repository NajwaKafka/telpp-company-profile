@foreach($data as $news)
<article class="group bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 dark:border-slate-800">
    <div class="aspect-[16/10] overflow-hidden">
        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
             src="{{ $news->thumbnail_path ? asset('storage/' . $news->thumbnail_path) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuB5Zdnlc-VmzGgmp_Fc-ENqsU3jikzRlZZpneHBzuZpYCDxqyCUc9zpWIQr_JVuqzY_UBzkS_A7ebRFlGtKwbNu4zYaiRgmbAtm4-6NGdXQPk62OIi5U0iwhQLJUS3wZwZ8l4LjAlWLDWOz_gK-AFbH9NYIafyw91hGwlGq52dNsawh9cYM4dqh4NOvxc6wepUxSZUVsub4a_lx3PTrtsHF35G4OP3qLmTJBWJ5x2ZRWqH35H-5a9lHcoImMsgCC2r-ZPdB5fOcwIlK' }}" 
             alt="{{ $news->title }}">
    </div>
    <div class="p-6">
        <span class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2 block">
            Corporate • {{ $news->created_at->format('M d, Y') }}
        </span>
        <h3 class="text-xl font-bold leading-tight group-hover:text-primary transition-colors cursor-pointer">
            <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
        </h3>
        <p class="mt-3 text-slate-500 dark:text-slate-400 text-sm line-clamp-2">{{ $news->summary }}</p>
    </div>
</article>
@endforeach
