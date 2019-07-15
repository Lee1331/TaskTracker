@extends('layouts.app')
@section('content')
<div class="d-flex align-items-center">
    <h1 class="mr-auto p-2 mb-3">App</h1>
    <a href="/projects/create">Create New Project</a>
</div>
    <ul>
        @forelse($projects as $project)
            <li>
                <a href="{{ $project->path() }}">
                    {{$project->title}}
                </a>
            </li>
        @empty
            <li>
                No projects yet!
            </li>
        @endforelse
    </ul>
@endsection
