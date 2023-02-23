@extends('layouts.admin')
@section('buttons')
    <div class="container-fluid">
        <div class="row w-100 d-flex mt-2">
            <div class="col-12">
                <div class="controllers w-100 d-flex gap-2">
                    <a href="{{route('admin.projects.create')}}" class="h-50 btn btn-outline-success fw-bold sticky-top">Nuovo progetto</a>
                    @if (session('message'))
                    <div class="my-alert message alert text-center flex-grow-1 {{session('alert-type')}}">
                        <span>{{session('message')}}</span>
                    </div>
                    @endif
                    <a href="{{route('admin.projects.trashed')}}" class="ms-auto h-50 btn btn-outline-secondary fw-bold sticky-top"><i class="fa-solid fa-trash fa-xl"></i>@if($trashed>0)&nbsp;{{$trashed}}@endif</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
<section id="index">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{-- Inserire checkbox --}}

            </div>
        </div>
        <div class="row w-100 mt-2">
            <div class="col-12">
                <table class="table table-striped table-hover table-warning">
                    <thead class="table-success-dark text-small-th">
                        <tr>
                        <th scope="col" class="" style="min-width: 50px;">
                            <a class="text-primary text-decoration-none" href="{{ route('admin.projects.index', ['sort' => 'id', 'direction' => $direction == 'asc' ? 'desc' : 'asc']) }}">
                                Id @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-up fa-xs"></i>
                                    @else
                                        <i class="fas fa-sort-down fa-xs"></i>
                                    @endif
                                @else
                                <i class="fas fa-sort fa-xs"></i>
                                @endif
                            </a>
                        </th>

                        <th scope="col"><a class="text-primary text-decoration-none" href="{{route('admin.projects.index', 'sort=preview')}}"> Preview</a></th>
                        <th scope="col"><a class="text-primary text-decoration-none" href="{{route('admin.projects.index', 'sort=name')}}"> Name</a></th>
                        <th scope="col"><a class="text-primary text-decoration-none" href="{{route('admin.projects.index', 'sort=description')}}"> Description</a></th>
                        <th scope="col"><a class="text-primary text-decoration-none" href="{{route('admin.projects.index', 'sort=authors')}}"> Authors</a></th>
                        <th scope="col"><a class="text-primary text-decoration-none" href="{{route('admin.projects.index', 'sort=license')}}"> License</a></th>
                        <th scope="col"><a class="text-primary text-decoration-none" href="{{route('admin.projects.index', 'sort=program_lang')}}"> Languages</a></th>
                        <th scope="col"><a class="text-primary text-decoration-none" href="{{route('admin.projects.index', 'sort=frameworks')}}"> Frameworks</a></th>
                        <th scope="col"><span class="text-primary fst-italic">Github link</span></th>
                        {{-- <th scope="col"<a class="text-primary text-decoration-none" href="{{route('admin.projects.index', 'sort=id')}}"> Date creation</a></th> --}}
                        <th scope="col"><a class="text-primary text-decoration-none" href="{{route('admin.projects.index', 'sort=update')}}"> Updated</a></th>
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
                                    <form action="{{route('admin.projects.destroy', $project->id)}}" method="POST" class="delete">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-sm btn-success" href="{{route('admin.projects.show', $project->id)}}">Show</a>
                                        <a class="btn btn-sm btn-warning" href="{{route('admin.projects.edit', $project->id)}}">Edit</a>
                                        <button title="Cancella" type="submit" class="btn btn-sm btn-danger confirm" href="{{route('admin.projects.destroy', $project->id)}}">Delete</button>
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
@section('script')
    @vite('resources/js/confirm-delete.js')
@endsection