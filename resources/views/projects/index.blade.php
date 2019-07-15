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
                <div class="bg-white p-3 rounded-lg shadow" style="height: 200px;">
                    <h1 class="text-xl mb-2 py-4 -ml-3 mb-3 border-l-4 border-blue pl-4">
                        <a href="{{ $project->path() }}">
                            {{$project->title}}
                        </a>
                    </h1>
                    <div class="text-grey">
                        {{str_limit($project->description, 100)}}
                    </div>
                </div>
            </div>
        @empty
                No projects yet!
        @endforelse
    </main>
@endsection
