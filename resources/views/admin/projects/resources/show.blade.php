@extends('layouts.admin')
@section('title', "Admin - Show $project->name")
@section('content')
<section id="cards" class="m-4">
    <div class="">
        <div class="row w-100">
            <div class="col-12">
                <p><span class="fw-bold">Id</span>: {{$project->id}} </p>
                <h4><span class="fw-bold">Name</span>: {{$project->name}} </h4>
                <p><span class="fw-bold">Description</span>: {{$project->description}} </p>
                <p><span class="fw-bold">Preview</span>: {{$project->preview}} </p>
                <p><span class="fw-bold">Authors</span>: {{$project->authors}} </p>
                <p><span class="fw-bold">Licence</span>: {{$project->licence}} </p>
                <p><span class="fw-bold">Languages</span>: {{$project->program_lang}} </p>
                <p><span class="fw-bold">Frameworks</span>: {{$project->frameworks}} </p>
                <p><span class="fw-bold">Github link</span>: {{$project->github_url}} </p>
                <p><span class="fw-bold">Creation date</span>: {{$project->start_date}} </p>
                <p><span class="fw-bold">Last update</span>: {{$project->update}} </p>
                {{-- inserire pulsanti --}}
            </div>
        </div>
    </div>
</section>
@endsection
