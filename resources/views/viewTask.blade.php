@extends('layouts.indexTask')

@section('content')
    <article>
        <section class="container mx-auto py-8 flex-grow">
            <!-- Content of your website -->
            <h1 class="text-2xl font-bold">Task List</h1>
            <!-- Create Task Button -->
            <a href="{{ route('createTask') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create
                Task</a>
            <!-- Sorting Box -->
            <div class="flex justify-between mb-4">
                <div></div> <!-- Placeholder for future content -->
                <div class="relative">
                    <select id="sortTask" name="sortTask"
                        class="border border-gray-300 px-2 py-1 rounded appearance-none bg-white focus:outline-none focus:ring focus:border-blue-500">
                        <option value="default">Sort by Default</option>
                        <option value="nameAsc">Name A-Z</option>
                        <option value="nameDesc">Name Z-A</option>
                        <option value="priorityAsc">Priority Low-High</option>
                        <option value="priorityDesc">Priority High-Low</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M10 12l-6-6 1.41-1.41L10 9.17l4.59-4.58L16 6z" />
                        </svg>
                    </div>
                </div>
            </div>
            <!-- Task List -->
            <ul class="mt-4" id="sortable">
                @foreach ($allTasks as $task)
                    <li class="bg-gray-100 p-4 mb-2 rounded-lg justify-between items-center flex flex-row taskClass"
                        data-route="{{ route('changepriority', ['task' => $task->id]) }}"
                        data-sortpriority="{{ $task->sortpriority }}" data-clasifi="{{ $task->id }}">
                        <div class="basis-1/2">
                            <h2 class="text-lg font-bold">{{ $task->sortpriority }} - {{ $task->name }} -
                                {{ $task->priority }} - {{ $task->id }}
                            </h2>
                            <p>{{ $task->description }}</p>
                            <span class="text-xs text-gray-500">{{ $task->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="basis-1/2 flex flex-row">
                            <a href="{{ route('task.edit', ['task' => $task->id]) }}"
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Edit</a>
                            <form action="{{ route('task.destroy', ['task' => $task->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
                <!-- Add more task items as needed -->
            </ul>
        </section>
    </article>
@endsection
@push('scripts')
    <script type="module">
        $(() => {
            $("#sortable").sortable({
                change: function(event, ui) {},
                update: function(event, ui) {
                    let firstBox = $(ui.item[0]).prev();
                    let theBox = $(ui.item[0]);
                    let lastBox = $(ui.item[0]).next();
                    let direction = '';
                    if (Math.sign(theBox.data('sortpriority') - firstBox.data('sortpriority')) == 1) {
                        //if its positive: will be from up the box to down, we sum
                        direction = 'down';
                    } else {
                        //if its negative: will be from down to the box to up
                        direction = 'up';
                    }
                    $.ajax({
                        url: theBox.data('route'),
                        type: 'POST',
                        data: {
                            fistBoxId: firstBox.data('clasifi'),
                            direction
                        },
                        success: function(res) {
                            location.reload();
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                }
            });
        });
    </script>
@endpush
