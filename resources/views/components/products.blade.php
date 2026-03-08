        <!-- Product Highlights -->
        <section class="py-24 bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row items-center gap-12">

        <!-- TEXT -->
        <div class="md:w-1/2 text-justify">

        <h2 class="text-4xl font-black text-forest-dark mb-4 tracking-tight">
        Our Premium Products
        </h2>

        <p class="text-lg text-slate-600 leading-relaxed mb-4">
        Our main product is 
        <span class="font-semibold text-slate-800">
        TeL Pellita Bleached Kraft Pulp
        </span>
        based on 100% planted Pellita trees.
        </p>

        <p class="text-lg text-slate-600 leading-relaxed mb-4">
        {{$products?->description}}
        </p>

        </div>


        <!-- SLIDER -->
        <div class="md:w-1/2 relative">

        <!-- Slider Wrapper -->
        <div id="slider" class="overflow-hidden rounded-xl shadow-lg">

        <div id="slides" class="flex transition-transform duration-500">

        @foreach ($products->images as $image)

        <img 
        src="{{ asset('storage/'.$image->image) }}"
        class="w-full h-[350px] object-cover flex-shrink-0"
        >

        @endforeach

        </div>

        </div>

        <!-- PREV BUTTON -->
        <div class="absolute inset-y-0 left-0 flex items-center">
        <button id="prev" class="w-10 h-10 bg-white shadow rounded-full flex items-center justify-center hover:bg-green-600 hover:text-white transition">

        <span class="material-symbols-outlined">
        chevron_left
        </span>

        </button>
        </div>

        <!-- NEXT BUTTON -->
        <div class="absolute inset-y-0 right-0 flex items-center">
        <button id="next" class="w-10 h-10 bg-white shadow rounded-full flex items-center justify-center hover:bg-green-600 hover:text-white transition">

        <span class="material-symbols-outlined">
        chevron_right
        </span>

        </button>
        </div>

        </div>

        </div>
        </div>

        </section>



        <!-- Slider Script -->
        <script>

        let index = 0;

        const slides = document.getElementById("slides");
        const totalSlides = slides.children.length;

        document.getElementById("next").addEventListener("click", () => {

        index++;

        if(index >= totalSlides){
        index = 0;
        }

        slides.style.transform = `translateX(-${index * 100}%)`;

        });


        document.getElementById("prev").addEventListener("click", () => {

        index--;

        if(index < 0){
        index = totalSlides - 1;
        }

        slides.style.transform = `translateX(-${index * 100}%)`;

        });

        </script>