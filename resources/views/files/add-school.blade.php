@extends("master")

@section("content")
    <div class="container mt-5">
        <h4 class="text-center mb-4">Add New School</h4>

        <div class="card shadow rounded p-4" style="width:50%;margin:auto;">
            <form method="POST" action="{{route('store.schools')}}">
                @csrf

                <div class="mb-3">
                    <label for="schoolName" class="form-label">School Name</label>
                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           id="schoolName"
                           placeholder="Enter School Name"
                           value="{{old('name')}}"
                           required>
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="schoolCode" class="form-label">School Code</label>
                    <input type="text"
                           name="code"
                           class="form-control @error('code') is-invalid @enderror"
                           id="schoolCode"
                           value="{{old('code')}}"
                           placeholder="Enter School Code"
                           required>
                    @error('code')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Add School</button>
                </div>
            </form>
        </div>
    </div>
@endsection
