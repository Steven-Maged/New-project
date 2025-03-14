<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('All Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Courses List -->
                    <ul class="space-y-4">
                        @foreach ($courses as $course)
                            <li class="flex flex-wrap items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                                <!-- Course Info -->
                                <div class="flex flex-wrap items-center w-full sm:w-auto">
                                    <img 
                                        src="{{ asset('storage/' . $course->coursePhoto) }}" 
                                        alt="{{ $course->courseName }}" 
                                        class="object-cover w-20 h-20 mb-4 mr-4 rounded-lg sm:w-24 sm:h-24 sm:mb-0"
                                    >
                                    <a href="{{ route('courses.show', $course->id) }}" 
                                       class="text-lg font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-200">
                                        {{ $course->courseName }}
                                    </a>
                                </div>

                                <!-- Action Buttons -->
                                <div class="w-full sm:w-auto">
                                    <!-- Small Screens: Select Dropdown -->
                                    <div class="relative block sm:hidden">
                                        <select onchange="handleSelectAction(this, '{{ $course->id }}')" 
                                                class="w-full px-4 py-2 font-semibold text-gray-800 bg-gray-100 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400 dark:bg-gray-700 dark:text-gray-200">
                                            <option value="" disabled selected>{{ __('Actions') }}</option>
                                            @if(auth()->user()->role == 'admin')
                                                <option value="edit">{{ __('Edit') }}</option>
                                                <option value="delete">{{ __('Delete') }}</option>
                                            @endif
                                            <option value="content">{{ __('Content of Course') }}</option>
                                        </select>
                                    </div>

                                    <!-- Large Screens: Buttons -->
                                    <div class="hidden sm:flex sm:space-x-2">
                                        @if(auth()->user()->role == 'admin')
                                            <a href="{{ route('courses.edit', $course->id) }}" 
                                               class="inline-flex items-center px-4 py-2 font-semibold text-white bg-yellow-500 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                                                {{ __('Edit') }}
                                            </a>

                                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-4 py-2 font-semibold text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        @endif
                                        @if(auth()->user()->role == 'user')
                                            <form action="{{ route('checkout', ['courseId' => $course->id]) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <button class="inline-flex items-center px-4 py-2 font-semibold text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                                                    type="submit">Confirm Online Order
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('content.by.course', $course->id) }}" method="GET" style="display:inline;">
                                            @csrf
                                            <button type="submit" 
                                                    class="inline-flex items-center px-4 py-2 font-semibold text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                                {{ __('Content of Course') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        <!-- Add New Course Card -->
                        @if(auth()->user()->role == 'admin')
                            <li class="flex items-center justify-between p-4 bg-gray-100 rounded-lg shadow-md hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600">
                                <a href="{{ route('courses.create') }}" class="flex items-center w-full">
                                    <div class="flex items-center">
                                        <!-- Placeholder Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" 
                                            class="w-16 h-16 mr-4 text-indigo-600 dark:text-indigo-400 sm:w-20 sm:h-20">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        <!-- Add Course Text -->
                                        <span class="text-lg font-semibold text-indigo-600 dark:text-indigo-400">
                                            {{ __('Add New Course') }}
                                        </span>
                                    </div>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function handleSelectAction(select, courseId) {
    const action = select.value;

    if (action === 'edit') {
        window.location.href = `/courses/${courseId}/edit`;
    } else if (action === 'delete') {
        if (confirm('{{ __("Are you sure you want to delete this course?") }}')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/courses/${courseId}`;
            form.innerHTML = `
                @csrf
                @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
        }
    } else if (action === 'content') {
        // Create a form element
        const form = document.createElement('form');
        form.method = 'GET';
        form.action = `/contents/course/${courseId}/content`;
        form.innerHTML = `
            @csrf
        `;
        document.body.appendChild(form);
        form.submit();
    }
}
</script>