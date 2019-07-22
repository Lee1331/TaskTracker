@extends('layouts.app')
@section('content')
    <h1 class="text-2xl font-normal mb-10 text-center">Edit Your Project</h1>
    @include('projects.form')

    <form method="POST" action="{{$project->path()}}" class="lg:w-1/2 lg:max-auto bg-white p-6 md:py-12 md:px-16 rounded shadow">
        @method('PATCH')

        @include ('projects.form', [
                'buttonText' => 'Update Project'
            ])
    </form>
    {{-- <form method="POST" action="{{$project->path()}}" class="lg:w-1/2 lg:max-auto bg-white p-6 md:py-12 md:px-16 rounded shadow">
        @method('PATCH')
        @csrf

        <h1 class="text-2xl font-normal mb-10 text-center">Edit Your Project</h1>

        <div class="field">
            <div class="label" for="title">
                Title
            </div>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="Title" value="{{$project->title}}">
            </div>
        </div>

        <div class="field">
            <div class="label" for="description">
                Description
            </div>

            <div class="control">
                <textarea type="text" class="textarea" name="description" placeholder="Description">{{$project->description}}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Update Project</button>
                <a href="{{$project->path()}}">Cancel</a>
            </div>
        </div>
    </form> --}}
@endsection
