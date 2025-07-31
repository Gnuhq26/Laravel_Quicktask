<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('users.index') }}" class="mr-3 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white" title="{{ __('Back to User List') }}">
                <!-- Heroicon: solid/arrow-left -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User Detail') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Left: User Info -->
                <div class="md:w-1/3 w-full">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8 md:mb-0">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-bold mb-2">{{ __('User Info') }}</h3>
                            <p><strong>{{ __('First Name') }}:</strong> {{ $user->firstname }}</p>
                            <p><strong>{{ __('Last Name') }}:</strong> {{ $user->lastname }}</p>
                            <p><strong>{{ __('Username') }}:</strong> {{ $user->username }}</p>
                            <p><strong>{{ __('Email') }}:</strong> {{ $user->email }}</p>
                        </div>
                    </div>
                </div>
                <!-- Right: Tasks -->
                <div class="md:w-2/3 w-full flex flex-col gap-8">
                    <!-- Tasks -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-lg font-bold">{{ __('Tasks') }}</h3>
                                <a href="{{ route('tasks.create', ['user_id' => $user->id]) }}">
                                    <x-primary-button>{{ __('Add Task') }}</x-primary-button>
                                </a>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Task Name') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($user->tasks as $index => $task)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $task->name }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('tasks.edit', $task) }}">
                                                        <x-primary-button>{{ __('Edit') }}</x-primary-button>
                                                    </a>
                                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-primary-button class="bg-red-500 hover:bg-red-700">{{ __('Delete') }}</x-primary-button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">{{ __('No tasks found.') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Roles table removed as per instruction -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
