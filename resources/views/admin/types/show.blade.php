@extends('layouts.app')

@section('title', 'types')

@section('content')

    <div class="container">

        <div class="text-center mt-4">
            <a href="{{ route('admin.types.index') }}" class="btn btn-primary">Return to the list</a>
            <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-primary">Edit type</a>
        </div>
        <h1 class="my-4 text-center">{{ $type->label }}</h1>
        <div class="row">
            <div class="col-6">
                <span class="fs-4">Label: </span>
                <span>{!! $type->getBadge() !!}</span>
            </div>
            <div class="col-6">
                <span class="fs-4" class="h4">Color: </span>
                <span>{{ $type->color }}</span>
            </div>
        </div>

        <table class="table">
            <thead>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th></th>
            </thead>
            <tbody>
                @forelse ($related_projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->author }}</td>
                        <td>
                            <div class="link-index-list">
                                <a href="{{ route('admin.projects.show', $project) }}">
                                    <i class="fa-solid fa-eye fa-lg" style="color: #0c4d13;"></i>
                                </a>
                                <a href="{{ route('admin.projects.edit', $project) }}">
                                    <i class="fa-solid fa-pen fa-lg" style="color: #203fa4;"></i>
                                </a>
                                <button class="btn btn-primary btn-trash" data-bs-toggle="modal"
                                    data-bs-target="#delete-project-{{ $project->id }}-modal" type="button">
                                    <i class="fa-solid fa-trash-can fa-lg" style="color: #e00b04;"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%">
                            <i>No projects found</i>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="paginator">
            {{ $related_projects->links('pagination::bootstrap-5') }}
        </div>
    </div>
    </div>

@endsection

@section('modal')
    @foreach ($related_projects as $project)
        <div class="modal fade" id="delete-project-{{ $project->id }}-modal" tabindex="-1"
            aria-labelledby="delete-project-{{ $project->id }}-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete project
                            {{ $project->title }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this Project? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
