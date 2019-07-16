    <div class="card" style="height: 200px;">
        <h1 class="text-xl mb-2 py-4 -ml-3 mb-3 border-l-4 border-blue pl-4">
            <a href="{{ $project->path() }}">
                {{$project->title}}
            </a>
        </h1>
        <div class="text-grey">
            {{str_limit($project->description, 100)}}
        </div>
    </div>
