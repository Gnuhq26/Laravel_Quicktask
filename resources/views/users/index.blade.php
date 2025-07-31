<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-start">
                <a href="{{ route('users.create') }}">
                    <x-primary-button class="py-4 px-6 text-lg font-bold text-xl">
                        {{ __('Create New User') }}
                    </x-primary-button>
                </a>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("User list") }}
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-gray-900 dark:text-gray-100" scope="col">#</th>
                        <th class="text-gray-900 dark:text-gray-100" scope="col">Name</th>
                        <th class="text-gray-900 dark:text-gray-100" scope="col">Username</th>
                        <th class="text-gray-900 dark:text-gray-100" scope="col">Task</th>
                        <th class="text-gray-900 dark:text-gray-100" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <th class="text-gray-900 dark:text-gray-100" scope="row">{{ $index + 1 }}</th>
                            <td class="text-gray-900 dark:text-gray-100">{{ $user->name }}</td>
                            <td class="text-gray-900 dark:text-gray-100">{{ $user->username }}</td>
                            <td class="text-gray-900 dark:text-gray-100">
                                @if($user->tasks->isNotEmpty())
                                    {{ $user->tasks->first()->name }}
                                @else
                                    No task
                                @endif
                            </td>
                            <td class="text-gray-900 dark:text-gray-100">
                                <div class="action-buttons">
                                    <a href="{{ route('users.show', ['user' => $user->id]) }}">
                                        <x-primary-button class="mt-4 bg-blue-500 hover:bg-blue-700">
                                            {{ __('View') }}
                                        </x-primary-button>
                                    </a>
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}">
                                        <x-primary-button class="mt-4 bg-green-500 hover:bg-green-700">
                                            {{ __('Edit') }}
                                        </x-primary-button>
                                    </a>
                                    <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST" style="display:inline" onsubmit="return confirm('Bạn có chắc muốn xóa user này?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-primary-button class="mt-4 bg-red-500 hover:bg-red-700">
                                            {{ __('Delete') }}
                                        </x-primary-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
