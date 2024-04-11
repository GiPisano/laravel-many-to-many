@extends('layouts.app')

@section('title', (empty($technology->id) ? 'Add New' : 'Edit') . ' technology')

@section('content')

    <section>
        <div class="container">
            <h1>{{ (empty($technology->id) ? 'Add New' : 'Edit') . ' technology' }}</h1>
            <div class="text-center">
                <a href="{{ route('admin.technologies.index') }}" class="btn btn-primary mb-3">Return to the list</a>
            </div>

            <form
                action="{{ empty($technology->id) ? route('admin.technologies.store') : route('admin.technologies.update', $technology) }}"
                method="POST">
                @csrf
                @if (!empty($technology->id))
                    @method('PATCH')
                @endif
                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-lable" for="label">Label</label>
                        <input @class(['form-control', 'is-invalid' => $errors->has('label')]) value="{{ old('label', $technology->label) }}" technology="text"
                            name="label" id="label" />
                        {{-- @error('label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                    </div>
                    <div class="col-6">
                        <label class="form-lable" for="color">Color</label>
                        <input @class(['form-control', 'is-invalid' => $errors->has('color')]) value="{{ old('color', $technology->color) }}"
                            technology="color" name="color" id="color" />
                        {{-- @error('color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                    </div>
                </div>

                <button
                    class="btn btn-success mt-3">{{ (empty($technology->id) ? 'Save' : 'Edit') . ' technology' }}</button>
            </form>
        </div>
    </section>

@endsection
