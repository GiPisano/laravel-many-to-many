@extends('layouts.app')

@section('title', (empty($project->id) ? 'Add New' : 'Edit') . ' Project')

@section('content')

    <section>
        <div class="container">
            <h1>{{ (empty($project->id) ? 'Add New' : 'Edit') . ' Project' }}</h1>
            <div class="text-center">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-primary mb-3">Return to the list</a>
            </div>

            <form
                action="{{ empty($project->id) ? route('admin.projects.store') : route('admin.projects.update', $project) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (!empty($project->id))
                    @method('PATCH')
                @endif
                <div class="row g-2">
                    <div class="col-4">
                        <label class="form-label" for="title">Title</label>
                        <input @class(['form-control', 'is-invalid' => $errors->has('title')]) value="{{ old('title', $project->title) }}" type="text"
                            name="title" id="title" />
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label for="image" class="form-label">Image</label>
                        <input @class(['form-control', 'is-invalid' => $errors->has('image')]) type="file" id="image" name="image">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label class="form-label" for="type_id">Type</label>
                        <select name="type_id" id="type_id" @class(['form-select', 'is-invalid' => $errors->has('type_id')])>
                            <option value="" class="d-none">select a type</option>
                            @foreach ($types as $type)
                                <option {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}
                                    value="{{ $type->id }}">
                                    {{ $type->label }}</option>
                            @endforeach
                        </select>

                        @error('type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="col-12 checkbox">
                        <strong>Technologies: </strong>
                        @foreach ($technologies as $technology)
                            <div @class(['is-invalid' => $errors->has('technologies')])>
                                <input
                                    {{ in_array($technology->id, old('technologies', $technologies_id ?? [])) ? 'checked' : '' }}
                                    @class([
                                        'form-check-input',
                                        'is-invalid' => $errors->has('technologies'),
                                    ]) type="checkbox" value=" {{ $technology->id }}"
                                    id="technologies-{{ $technology->id }}" name="technologies[]">
                                <label class="form-check-label" for="technologies-{{ $technology->id }}">
                                    {{ $technology->label }}
                                </label>

                            </div>
                        @endforeach
                        @error('technologies')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="description">Description</label>
                        <textarea @class(['form-control', 'is-invalid' => $errors->has('description')]) name="description" rows="5" id="description">{{ old('description') ?? $project->description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-success mt-3">{{ (empty($project->id) ? 'Save' : 'Edit') . ' Project' }}</button>
            </form>
        </div>
    </section>

@endsection
