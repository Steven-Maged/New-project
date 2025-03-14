<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('All Contents') }}
        </h2>
    </x-slot>

    <div class="py-12 text-white bg-gray-900">
        <div class="flex mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Main Video Section -->
            <div class="w-2/3 pr-4">
                @if($contents->isNotEmpty())
                    <div class="p-4 bg-gray-800 rounded-lg shadow-lg">
                        <video id="main-video" width="100%" height="400" controls class="rounded-lg" 
                               oncontextmenu="return false;" 
                               onselectstart="return false;" 
                               ondragstart="return false;">
                            <source id="main-video-source" 
                                    src="{{ asset('storage/' . $contents->first()->url) }}" 
                                    type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <h3 id="main-video-title" class="mt-4 text-xl font-bold">{{ $contents->first()->title }}</h3>
                        <p id="main-video-description" class="text-gray-400">{{ $contents->first()->description }}</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar Content List -->
            <div class="w-1/3 p-4 bg-gray-800 rounded-lg shadow-lg">
                <h3 class="mb-4 text-lg font-semibold">All Videos</h3>
                <ul id="video-list" class="space-y-4">
                    @foreach ($contents as $key => $content)
                        <li class="video-item flex items-center space-x-4 p-2 rounded-lg cursor-pointer
                            {{ $key === 0 ? 'bg-gray-600' : 'bg-gray-700 hover:bg-gray-600' }} "
                            data-url="{{ asset('storage/' . $content->url) }}"
                            data-title="{{ $content->title }}"
                            data-description="{{ $content->description }}"
                            onclick="swapVideo(this)">
                            <video width="120" height="80" class="rounded-lg" oncontextmenu="return false;" 
                                    onselectstart="return false;" ondragstart="return false;">
                                <source src="{{ asset('storage/' . $content->url) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <span class="text-white hover:text-gray-300">{{ $content->title }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
        function swapVideo(selectedItem) {
            const mainVideo = document.getElementById('main-video');
            const mainVideoSource = document.getElementById('main-video-source');
            const mainVideoTitle = document.getElementById('main-video-title');
            const mainVideoDescription = document.getElementById('main-video-description');

            // Store current main video state
            const currentTime = mainVideo.currentTime; // Preserve video progress
            const wasPaused = mainVideo.paused;

            // Store current main video details
            const oldVideoUrl = mainVideoSource.src;
            const oldTitle = mainVideoTitle.textContent;
            const oldDescription = mainVideoDescription.textContent;

            // Get clicked video details
            const newVideoUrl = selectedItem.getAttribute('data-url');
            const newTitle = selectedItem.getAttribute('data-title');
            const newDescription = selectedItem.getAttribute('data-description');

            // Swap main video source
            mainVideoSource.src = newVideoUrl;
            mainVideo.load(); // Ensure the video is ready to play

            // Restore playback position
            mainVideo.onloadedmetadata = () => {
                mainVideo.currentTime = currentTime;
                if (!wasPaused) {
                    mainVideo.play();
                }
            };

            mainVideoTitle.textContent = newTitle;
            mainVideoDescription.textContent = newDescription;

            // Update sidebar items to reflect the change
            document.querySelectorAll('.video-item').forEach(item => {
                if (item === selectedItem) {
                    item.classList.add('bg-gray-600');
                    item.classList.remove('bg-gray-700', 'hover:bg-gray-600');
                } else {
                    item.classList.remove('bg-gray-600');
                    item.classList.add('bg-gray-700', 'hover:bg-gray-600');
                }
            });
        }
    </script>
</x-app-layout>
