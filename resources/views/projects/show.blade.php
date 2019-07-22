@extends('layouts.app')
@section('content')

    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-default text-sm font-normal">
                <a href="/projects">
                    My Projects
                </a>
                / {{$project->title}}</p>
            {{-- <a href="/projects/create">Create New Project</a> --}}
            <div class="flex items-center">
                @foreach($project->members as $member)
                    <img
                        src="{{gravatar_url($member->email)}}"
                        alt="{{$member->name}}'s avatar"
                        class="rounded-full w-8 mr-2">
                @endforeach

                <img
                    src="{{gravatar_url($project->owner->email)}}"
                    alt="{{$project->owner->name}}'s avatar"
                    class="rounded-full w-8 mr-2">
                <a href="{{$project->path() . '/edit'}}" class="button ml-4">Edit Project</a>
            </div>
        </div>
    </header>
    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-default font-normal mb-3">Tasks</h2>
                </div>

                @foreach($project->tasks as $task)
                    <div class="card mb-3">
                        <form action="{{$task->path()}}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="flex">
                                <input name="body" value="{{$task->body}}" class="bg-card text-default w-full {{$task->completed ? 'text-default' : ''}}">
                                <input type="checkbox" name="completed" onChange="this.form.submit()" {{$task->completed ? 'checked' : ''}}>
                            </div>
                        </form>
                    </div>
                @endforeach()

                <form action="{{$project->path() . '\tasks'}}" method="POST">
                    @csrf

                    <div class="card mb-3">
                        <input class="w-full bg-card text-default" placeholder="Add Task" name="body">
                    </div>
                </form>
                <div>
                    <h2 class="text-lg text-default font-normal">General Notes</h2>
                    <form action="{{$project->path()}}" method="POST">
                        @method('PATCH')
                        @csrf
                        <textarea name="notes" class="card w-full mb-4" style="min-height: 200px" placeholder="notes">{{$project->notes}}</textarea>
                        <button type="submit" class="button">Add Notes</button>
                    </form>
                </div>
            </div>
            <div class="lg:w-1/4 px-3 lg:py-8">
                {{-- <div class="card">
                    <h1>{{$project->title}}</h1>
                    <h1>{{$project->description}}</h1>
                    <a href="/projects">Go Back</a>
                </div> --}}
                @include('projects.card')

                @include('projects.activity.card')

                @can('manage', $project)
                    @include('projects.invite')
                @endcan
            </div>
        </div>
    </main>

@endsection
