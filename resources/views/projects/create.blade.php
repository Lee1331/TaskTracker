@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-normal mb-10 text-center">Create Your Project</h1>

    <form method="POST" action="/projects" class="lg:w-1/2 lg:max-auto bg-white p-6 md:py-12 md:px-16 rounded shadow">

        @include('projects.form', [
            'project' => new App\Project,
            'buttonText' => 'Create Project'
        ])
    </form>
    {{-- <form method="POST" action="/projects">
        @csrf
        <div class="field">
            <div class="label" for="title">
                Title
            </div>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="Title">
            </div>
        </div>

        <div class="field">
            <div class="label" for="description">
                Description
            </div>

            <div class="control">
                <textarea type="text" class="textarea" name="description" placeholder="Description"></textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create Project</button>
                <a href="/projects">Cancel</a>
            </div>
        </div>
    </form> --}}
@endsection
