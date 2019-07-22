<div class="card flex flex-col" style="height: 200px;">
    <h1 class="text-xl mb-2 py-4 -ml-3 mb-3 border-l-4 border-blue pl-4">
        <a href="{{ $project->path() }}" class="text-default no-underline">
            {{$project->title}}
        </a>
    </h1>
    <div class="text-default mb-4 flex-1">
        {{str_limit($project->description, 100)}}
    </div>

    @can('manage', $project)
        <footer>
            <form action="{{$project->path()}}" method="POST" class="text-right">
                @method('DELETE')
                @csrf
                <button type="submit" class="text-xs">Delete</button>
            </form>
        </footer>
    @endcan
</div>
