<!-- News Release -->
<section class="py-24 bg-white">

<div class="max-w-6xl mx-auto mb-16">

    <p class="text-sm tracking-[0.3em] text-orange-500 font-semibold mb-4">
        STRATEGIC MEDIA
    </p>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

        <div>
            <h2 class="text-5xl font-bold text-gray-900 mb-4">
                Latest Insights
            </h2>

            <p class="text-gray-500 max-w-xl">
                Inside look at our latest reforestation projects, industrial innovations, and community impact.
            </p>
        </div>

        <a href="/news"
           class="inline-flex items-center gap-2 border border-gray-300 px-6 py-3 rounded-full text-sm font-semibold hover:bg-gray-100 transition">
            View More →
        </a>

    </div>

</div>


<div id="news" class="pt-6 pb-16 bg-gray-50">

<div class="relative max-w-6xl mx-auto">

    <!-- Button Left -->
    <button id="prevBtn"
        class="absolute left-0 top-1/2 -translate-y-1/2 bg-green-700 text-white w-10 h-10 rounded-full hidden z-10">
        ❮
    </button>

    <div class="overflow-hidden">

        <div id="newsSlider" class="flex transition-transform duration-500">

            <!-- SLIDES -->
            @foreach($newsItems->take(6)->chunk(3) as $slide)
            <div class="flex-shrink-0 w-full flex justify-center gap-6">

                @foreach($slide as $data)
                    @include('components.news.news_card', [
                        'image' => asset('storage/' . $data->thumbnail_path),
                        'title' => $data->title,
                        'description' => $data->summary,
                        'date' => $data->published_at ? $data->published_at->format('d') : $data->created_at->format('d'),
                        'month' => $data->published_at ? $data->published_at->format('M') : $data->created_at->format('M'),
                        'link' => route('news.show', $data->slug)
                    ])
                @endforeach

            </div>
            @endforeach

        </div>

    </div>

    <!-- Button Right -->
    <button id="nextBtn"
        class="absolute right-0 top-1/2 -translate-y-1/2 bg-green-700 text-white w-10 h-10 rounded-full z-10">
        ❯
    </button>

</div>

</div>


<script>

const slider = document.getElementById("newsSlider");
const nextBtn = document.getElementById("nextBtn");
const prevBtn = document.getElementById("prevBtn");

let index = 0;
const slides = slider.children.length;

function updateSlider(){

    slider.style.transform = `translateX(-${index * 100}%)`;

    if(index === 0){
        prevBtn.style.display = "none";
    }else{
        prevBtn.style.display = "block";
    }

    if(index === slides - 1){
        nextBtn.style.display = "none";
    }else{
        nextBtn.style.display = "block";
    }

}

nextBtn.onclick = function(){

    if(index < slides - 1){
        index++;
        updateSlider();
    }

}

prevBtn.onclick = function(){

    if(index > 0){
        index--;
        updateSlider();
    }

}

updateSlider();

</script>

</section>