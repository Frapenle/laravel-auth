
<form id="{{$idForm}}" action="{{route($route, $project->id)}}" method="POST" class="mb-3" name={{$idForm}} enctype="multipart/form-data">
@csrf
@method($method)

@if ($errors->any())
        
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{$error}}
            </li>
        @endforeach
        </ul>
    </div>
    @endif
    
    <div class="mb-4">
        <label for="name" class="form-label">Name</label>
        <input name="name" type="text" class="form-control" id="title" value={{ old('name', $project->name) }}>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" value="Description" class="form-control" id="description" rows="3">{{ old('description', $project->description) }}</textarea>
    </div>
    <div class="mb-4">
        <label for="preview" class="form-label">Preview</label>
        <input name="preview" type="file" class="form-control" id="preview" value={{ old('preview', $project->preview) }}>
    </div>
    <div class="mb-4">
        <label for="authors" class="form-label">Authors</label>
        <input name="authors" type="text" class="form-control" id="authors" value={{ old('title', $project->authors) }}>
    </div>
    <div class="mb-4">
        <label for="license" class="form-label">Lincense</label>
        <input name="license" type="text" class="form-control" id="license" value={{ old('title', $project->license) }}>
    </div>
    <div class="mb-4">
        <label for="program_lang" class="form-label">Languages</label>
        <input name="program_lang" type="text" class="form-control" id="program_lang" value={{ old('program_lang', $project->program_lang) }}>
    </div>
    <div class="mb-4">
        <label for="frameworks" class="form-label">Frameworks</label>
        <input name="frameworks" type="text" class="form-control" id="type" value={{ old('frameworks', $project->frameworks) }}>
    </div>
    <div class="mb-4">
        <label for="github_url" class="form-label">Github link</label>
        <input name="github_url" type="text" class="form-control" id="type" value={{ old('github_url', $project->github_url) }}>
    </div>
    <div class="mb-4">
        <label for="start_date" class="form-label">Creation date</label>
        <input name="start_date" type="date" class="form-control" id="type" value={{ old('start_date', $project->start_date) }}>
    </div>
    <div class="mb-4">
        <label for="update" class="form-label">Update</label>
        <input name="update" type="date" class="form-control" id="type" value={{ old('update', $project->update) }}>
    </div>
    <button type="submit" class="btn {{ $method == 'PUT' ? 'btn-warning' : 'btn-success' }}">
    {{ $method == 'PUT' ? 'Modifica' : 'Aggiungi' }}
    </button>

</form>
@section('script')
    @vite('resources/js/confirm-delete.js')
@endsection