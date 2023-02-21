@extends('layouts.admin')
@section('content')
<section id="admin">
    <div class="container-fluid">
        <div class="row w-100 mt-5">
            <div class="col-12">
                <table class="table table-striped table-hover table-warning">
                    <thead class="table-success-dark">
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Preview</th>
                        <th scope="col">Authors</th>
                        <th scope="col">Licence</th>
                        <th scope="col">Languages</th>
                        <th scope="col">Frameworks</th>
                        <th scope="col">Github link</th>
                        <th scope="col">Date creation</th>
                        <th scope="col">Update</th>

                        {{-- colonna pulsanti --}}
                        {{-- <th scope="col" class="text-center" style="width: 250px;">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                            <tr>
                                <th scope="row"> {{$project->id}} </th>
                                <td> {{$project->name}} </td>
                                <td class="text-truncate" style="max-width: 300px;"> {{$project->description}} </td>
                                <td> {{$project->preview}} </td>
                                <td style="max-width: 200px;"> {{$project->authors}} </td>
                                <td> {{$project->licence}} </td>
                                <td> {{$project->program_lang}} </td>
                                <td> {{$project->frameworks}} </td>
                                <td> {{$project->github_url}} </td>
                                <td class="text-truncate" style="max-width: 300px;"> {{$project->start_date}} </td>
                                <td class="text-truncate" style="max-width: 300px;"> {{$project->update}} </td>
                                <td style="width: 250px;" class="text-end">
                                    {{-- inserire form con i pulsanti  --}}
                                </td>
                            </tr>
                        @empty
                        <table>
                            <tr>
                                <td id="empty" colspan="6"> No projects available </td>
                            </tr>
                        </table>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>
@endsection
