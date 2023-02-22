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
                        <th scope="col">Preview</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Authors</th>
                        <th scope="col">License</th>
                        <th scope="col">Languages</th>
                        <th scope="col">Frameworks</th>
                        <th scope="col">Github link</th>
                        {{-- <th scope="col">Date creation</th> --}}
                        <th scope="col">Updated</th>
                        <th scope="col" class="text-center" style="width: 250px;">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-small">
                        @forelse ($projects as $project)
                            <tr>
                                <th scope="row"> {{$project->id}} </th>
                                <td class="text-truncate" style="max-width: 150px;"> {{$project->preview}} </td>
                                <td> {{$project->name}} </td>
                                <td class="text-truncate" style="max-width: 200px;"> {{$project->description}} </td>
                                <td style="max-width: 200px;"> {{$project->authors}} </td>
                                <td> {{$project->license}} </td>
                                <td> {{$project->program_lang}} </td>
                                <td> {{$project->frameworks}} </td>
                                <td class="text-truncate" style="max-width: 100px;"><a href="#">{{$project->github_url}}</a></td>
                                {{-- <td class="text-truncate" style="max-width: 300px;"> {{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }} </td> --}}
                                <td class="text-truncate" style="max-width: 300px;"> {{ \Carbon\Carbon::parse($project->update)->format('Y-m-d  H:i') }} </td>
                                <td style="width: 250px;" class="text-end">
                                    <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-sm btn-success" href="{{route('admin.projects.show', $project->id)}}">Show</a>
                                        <a class="btn btn-sm btn-warning" href="{{route('admin.projects.edit', $project->id)}}">Edit</a>
                                        <button type="submit" class="btn btn-sm btn-danger" href="{{route('admin.projects.destroy', $project->id)}}" onclick="return confirm('Attenzione, sei sicuro di voler eliminare questo record?')">Delete</button>
                                    </form>
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
