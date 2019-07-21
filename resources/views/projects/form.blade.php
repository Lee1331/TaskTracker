    @csrf


    <div class="field">
        <div class="label" for="title">
            Title
        </div>

        <div class="control">
            <input type="text" class="input" name="title" placeholder="Title" value="{{$project->title}}" required>
        </div>
    </div>

    <div class="field">
        <div class="label" for="description">
            Description
        </div>

        <div class="control">
            <textarea type="text" class="textarea" name="description" placeholder="Description" required>{{$project->description}}</textarea>
        </div>
    </div>

    <div class="field">
        <div class="control">
            <button type="submit" class="button is-link">{{$buttonText}}</button>
            <a href="{{$project->path()}}">Cancel</a>
        </div>
    </div>

    @include('errors')
