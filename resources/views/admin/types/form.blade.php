@extends('layouts.app')

@section('title', (empty($type->id) ? 'Add New' : 'Edit') . ' type')

@section('content')

    <section>
        <div class="container">
            <h1>{{ (empty($type->id) ? 'Add New' : 'Edit') . ' type' }}</h1>
            <div class="text-center">
                <a href="{{ route('admin.types.index') }}" class="btn btn-primary mb-3">Return to the list</a>
            </div>

            <form action="{{ empty($type->id) ? route('admin.types.store') : route('admin.types.update', $type) }}"
                method="POST">
                @csrf
                @if (!empty($type->id))
                    @method('PATCH')
                @endif
                <div class="row g-2">
                    <div class="col-6">
                        <label class="form-lable" for="label">Label</label>
                        <input @class(['form-control', 'is-invalid' => $errors->has('label')]) value="{{ old('label', $type->label) }}" type="text"
                            name="label" id="label" />
                        {{-- @error('label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                    </div>
                    <div class="col-6">
                        <label class="form-lable" for="color">Color</label>
                        <input @class(['form-control', 'is-invalid' => $errors->has('color')]) value="{{ old('color', $type->color) }}" type="color"
                            name="color" id="color" />
                        {{-- @error('color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror --}}
                    </div>
                </div>

                <button class="btn btn-success mt-3">{{ (empty($type->id) ? 'Save' : 'Edit') . ' type' }}</button>
            </form>
        </div>
    </section>

@endsection
