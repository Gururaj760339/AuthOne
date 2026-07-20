<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ | AutoOne</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    @include('navbar')

    <!-- ================= HERO ================= -->

    <section class="relative bg-slate-900 text-white">

        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&q=80"
                class="w-full h-full object-cover opacity-30">
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-28 text-center">

            <span class="bg-blue-600 px-4 py-2 rounded-full text-sm">
                Help Center
            </span>

            <h1 class="text-5xl font-bold mt-6">

                Frequently Asked
                <span class="text-blue-400">
                    Questions
                </span>

            </h1>

            <p class="text-gray-300 mt-6 max-w-3xl mx-auto text-lg">

                Find answers to the most common questions about buying, financing,
                renting, importing, servicing, and maintaining your vehicle with AutoOne.

            </p>

        </div>

    </section>


    <!-- ================= FAQ ================= -->

    <section class="py-20">

        <div class="max-w-4xl mx-auto px-6">

            <h2 class="text-4xl font-bold text-center">

                General Questions

            </h2>

            <div class="space-y-6 mt-14">
                @foreach ($faqs as $faq)  
                <div class="bg-white rounded-xl shadow p-6">

                    <h3 class="text-xl font-semibold">

                        {{ $faq->question }}

                    </h3>

                    <p class="text-gray-600 mt-3">

                        {{ $faq->answer }}

                    </p>

                </div>
                @endforeach
            </div>

        </div>

    </section>

</body>

</html>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
