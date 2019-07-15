@extends('layouts.app')
@section('content')
    <h1>App</h1>
    <h1>{{$project->title}}</h1>
    <h1>{{$project->description}}</h1>
    <a href="/projects">Go Back</a>
@endsection
