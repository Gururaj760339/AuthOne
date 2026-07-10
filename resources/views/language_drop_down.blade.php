 <!-- Language Dropdown -->
 <div class="relative">
     <button onclick="toggleDropdown()" class="flex items-center gap-2 px-3 py-2 border rounded-lg hover:bg-gray-50">
         🌐 {{ strtoupper(app()->getLocale()) }}

         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
         </svg>
     </button>

     <div id="dropdown" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-xl border z-50">

         <a href="{{ route('language.switch', 'en') }}" class="block px-4 py-2 hover:bg-gray-100">
             🇺🇸 English
         </a>

         <a href="{{ route('language.switch', 'de') }}" class="block px-4 py-2 hover:bg-gray-100">
             🇩🇪 Deutsch
         </a>

         <a href="{{ route('language.switch', 'ar') }}" class="block px-4 py-2 hover:bg-gray-100">
             🇸🇦 العربية
         </a>

     </div>
 </div>

<script>
    function toggleDropdown() {
        document.getElementById("dropdown").classList.toggle("hidden");
    }

    window.addEventListener("click", function (e) {
        if (!e.target.closest(".relative")) {
            document.getElementById("dropdown").classList.add("hidden");
        }
    });
</script>