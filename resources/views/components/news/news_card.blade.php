<div class="bg-white rounded-2xl shadow-lg overflow-hidden border-b-4 border-green-700 max-w-xs">

    <!-- Image -->
<div class="relative">
    <img src="{{ $image && !str_contains($image, 'images/') ? $image : asset('images/news1.png') }}" class="w-full h-64 object-cover">

    <!-- Date Circle -->
    <div class="absolute top-4 right-4 w-14 h-14 bg-green-700 text-white rounded-full flex flex-col items-center justify-center border-4 border-white shadow">
        <span class="text-lg font-bold leading-none">{{ $date ?? '21' }}</span>
        <span class="text-[10px] uppercase font-bold">{{ $month ?? 'Oct' }}</span>
    </div>
</div>

    <div class="p-6">

        <div class="flex items-center gap-2 mb-3">
            <span class="w-8 h-[2px] bg-green-700"></span>
            <span class="text-green-700 font-bold text-xs uppercase">
                {{ $category ?? 'Operational Excellence' }}
            </span>
        </div>

        <h3 class="text-xl font-bold text-gray-900 leading-snug">
            {{ $title ?? 'Achieving 500 Days Without Lost Time Injury (LTI)' }}
        </h3>

        <p class="text-gray-500 text-sm mt-3">
            {{ $description ?? 'Safety is our core value. This milestone reflects our commitment.' }}
        </p>

        <div class="mt-6">
            <a href="{{ $link ?? '#' }}"
               class="inline-block bg-orange-500 text-white px-5 py-2 rounded-lg font-semibold shadow hover:bg-orange-600">
                Read More
            </a>
        </div>

    </div>
</div>