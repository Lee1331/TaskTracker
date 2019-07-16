@extends('layouts.app')
@section('content')
<header class="d-flex align-items-center py-4">
    <div class="flex justify-between items-center">
        <h1 class="mr-auto p-2 mb-3 text-grey">My Projects</h1>
        <button href="/projects/create" class="text-white bg-blue rounded no-underline br-8">Create New Project</button>
    </div>
</header>

    <main class="flex flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
                No projects yet!
        @endforelse
    </main>
@endsection
