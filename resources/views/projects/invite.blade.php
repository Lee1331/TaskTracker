<div class="card flex flex-col mt-3">
    <h1 class="text-xl mb-2 py-4 -ml-3 mb-3 border-l-4 border-blue pl-4">
            Invite a User
    </h1>
    <form action="{{$project->path() . '/invitations'}}" method="POST">
        @csrf
        <div class="md-3">
            <input type="email" name="email" class="border border-gray-light rounded w-full py-2 px-3" placeholder="Email Address...">
        </div>
        <button type="submit" class="button">Invite</button>
    </form>

    @include('errors', ['bag' => 'invitations'])
</div>
