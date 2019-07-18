<!--if only one change is made to an activity-->
@if (count($activity->changes['after']) == 1)
    <!--print it (by getting the first key of the associative array)-->
    {{$activity->user->name}} updated the {{key($activity->changes['after'])}} of the project

<!--however if multiple activites are being updated-->
@else
    <!--only display the first to prevent a long comment chain-->
    {{$activity->user->name}} updated the project
@endif
