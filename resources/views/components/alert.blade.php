@if(session('success') || session('error'))
<div class="fixed z-50 w-full max-w-sm top-4 right-4 sm:max-w-xs md:max-w-md lg:max-w-lg">
    <div id="toast" 
         class="flex items-center bg-white border-l-4 rounded-md shadow-md 
         {{ session('success') ? 'border-blue-500' : 'border-red-500' }}" 
         role="alert" 
         aria-live="assertive" 
         aria-atomic="true">

        <!-- Content Section -->
        <div class="flex-grow px-4 py-3">
            <strong class="block text-base font-medium 
                {{ session('success') ? 'text-gray-800' : 'text-red-800' }}">
                {{ session('success') ? 'Success' : 'Error' }}
            </strong>
            <p class="text-sm break-words 
                {{ session('success') ? 'text-gray-600' : 'text-red-600' }}">
                {{ session('success') ?? session('error') }}
            </p>
            <div class="h-1 mt-2 overflow-hidden bg-gray-200 rounded">
                <div id="progress-bar" 
                     class="h-full transition-all duration-300 ease-linear 
                     {{ session('success') ? 'bg-blue-500' : 'bg-red-500' }}" 
                     style="width: 0%;"></div>
            </div>
        </div>
        
        <!-- Close Button -->
        <button type="button" class="px-3 text-gray-500 hover:text-gray-700 focus:outline-none" onclick="closeToast()">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastElement = document.getElementById('toast');
        var progressBar = document.getElementById('progress-bar');
        var delay = 3000; // Delay in milliseconds (3 seconds)

        if (toastElement) {
            // Animate the progress bar
            var progress = 0;
            var interval = setInterval(function () {
                progress += 1;
                progressBar.style.width = progress + '%';
                if (progress >= 100) {
                    clearInterval(interval);
                }
            }, delay / 100);

            // Hide the toast after the delay
            setTimeout(function () {
                toastElement.classList.add('hidden');
            }, delay);
        }
    });

    function closeToast() {
        document.getElementById('toast').classList.add('hidden');
    }
</script>
@endif
