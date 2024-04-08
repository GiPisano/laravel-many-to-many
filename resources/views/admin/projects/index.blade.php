@extends('layouts.app')

@section('title', 'projects')

@section('content')
    <section id="index-projects">
        <div class="container py-4">
            <h1 class="text-center">Projects List</h1>
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Title</th>
                    {{-- <th>Description</th> --}}
                    <th>Type</th>
                    <th>Author</th>
                    <th class="d-flex justify-content-center">
                        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i>
                            New Project</a>
                    </th>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{!! $project->type->getBadge() !!}</td>
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
                {{ $projects->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection

@section('modal')
    @foreach ($projects as $project)
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
