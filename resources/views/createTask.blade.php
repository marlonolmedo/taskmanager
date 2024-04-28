@extends('layouts.indexTask')

@section('content')
    <!-- Content of your website -->
    <article class="m-6 rounded-lg">
        <section class="bg-gray-200 rounded p-6 mb-8">
            <h2 class="text-lg font-bold mb-4">Create New Task</h2>

            <!-- Create Task Form -->
            @if ($errors->any())
                {{-- {{dd($errors->all())}} --}}
                <!-- Error Message Box -->
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">some field are required.</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a1.6 1.6 0 002.273-2.274l-7.781-7.78a1.6 1.6 0 00-2.273 2.274l7.781 7.78zm-8.696 0a1.6 1.6 0 002.274-2.274l-7.78-7.78a1.6 1.6 0 10-2.274 2.274l7.78 7.78z" />
                        </svg>
                    </span>
                </div>
            @endif
            <form action="{{ route('task.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="taskName" class="block mb-2">Task Name:</label>
                    <input type="text" id="taskName" name="name"
                        class="border border-gray-300 px-2 py-1 rounded w-full" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-2 py-1 rounded">
                            <span class="text-xs">Required</span>
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="project" class="block mb-2">Project:</label>
                    <select id="project" name="proyect_id"
                        class="border border-gray-300 px-2 py-1 rounded w-full appearance-none bg-white focus:outline-none focus:ring focus:border-blue-500"
                        required value="{{ old('proyect_id') }}">
                        <option value="" disabled selected>Select Project</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" {{ $project->id == old('proyect_id') ? 'selected' : '' }}>
                                {{ $project->name }}</option>
                        @endforeach
                    </select>
                    @error('name')
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-2 py-1 rounded">
                            <span class="text-xs">Required</span>
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="priority" class="block mb-2">Priority:</label>
                    <select id="priority" name="priority"
                        class="border border-gray-300 px-2 py-1 rounded w-full appearance-none bg-white focus:outline-none focus:ring focus:border-blue-500"
                        required value="{{ old('priority') }}">
                        <option value="" disabled selected>Select Priority</option>
                        @foreach (['low', 'medium', 'high'] as $priority)
                            <option value="{{ $priority }}" {{ $priority == old('priority') ? 'selected' : '' }}>
                                {{ ucfirst($priority) }}</option>
                        @endforeach
                    </select>
                    @error('name')
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-2 py-1 rounded">
                            <span class="text-xs">Required</span>
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="descriptionTask" class="block mb-2">Description</label>
                    <textarea class="border border-gray-300 px-2 py-1 rounded w-full" name="description" id="descriptionTask" cols="30"
                        rows="5">{{ old('description') }}</textarea>
                    @error('name')
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-2 py-1 rounded">
                            <span class="text-xs">Required</span>
                        </div>
                    @enderror
                </div>
                <div class="flex justify-between">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Save</button>
                    <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                        id="clearField">Clear</button>
                </div>
            </form>
        </section>
    </article>
@endsection
@push('scripts')
    <script type="module">
        $(() => {
            $("#clearField").on("click", function() {
                $("#taskName").val('');
                $("#project").val('');
                $("#priority").val('');
                $("#descriptionTask").val('');
            });
        });
    </script>
@endpush
