@section('content')
<section id="cards" class="m-4">
    <div class="">
        <div class="row w-100">
            <div class="col-12">
                <p> {{$project->id}} </p>
                <h4> {{$project->name}} </h4>
                <p class="text-truncate" style="max-width: 300px;"> {{$project->description}} </p>
                <p> {{$project->preview}} </p>
                <p style="max-width: 200px;"> {{$project->authors}} </p>
                <p> {{$project->licence}} </p>
                <p> {{$project->program_lang}} </p>
                <p> {{$project->frameworks}} </p>
                <p> {{$project->github_url}} </p>
                <p class="text-truncate" style="max-width: 300px;"> {{$project->start_date}} </p>
                <p class="text-truncate" style="max-width: 300px;"> {{$project->update}} </p>
                {{-- inserire pulsanti --}}
            </div>
        </div>
    </div>

</section>