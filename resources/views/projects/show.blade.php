@extends('layouts.app')
@section('content')

    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-grey text-sm font-normal">
                <a href="projects">
                    My Projects
                </a>
                / {{$project->title}}</p>
            <a href="/projects/create">Create New Project</a>
        </div>
    </header>
    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-grey font-normal mb-3">Tasks</h2>
                    <div class="card">loren ipsum</div>
                </div>

                <div>
                    <h2 class="text-lg text-grey font-normal">General Notes</h2>
                    <textarea class="card" style="min-height: 200px">loren ipsum</textarea>
                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                {{-- <div class="card">
                    <h1>{{$project->title}}</h1>
                    <h1>{{$project->description}}</h1>
                    <a href="/projects">Go Back</a>
                </div> --}}
                @include('projects.card')
            </div>
        </div>
    </main>

@endsection
