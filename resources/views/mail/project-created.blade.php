@component('mail::message')
# New project: {{ $project->title }}

{{ $project->description }}

@component('mail::button', ['url' => url('/projects/' . $project->id)])
View project
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
