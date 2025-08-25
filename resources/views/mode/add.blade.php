@extends("master")

@section("content")
    <div class="container mt-5">
        <h4 class="text-center mb-4">Add New Mode</h4>

        <div class="card shadow rounded p-4" style="width:50%;margin:auto;">
            <form method="POST" action="{{route('mode.store')}}">
                @csrf
                <div class="mb-3">
                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="Enter Mode Name"
                           value="{{old('name')}}"
                           required>
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label d-block">Choose Status</label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="statusActive" value="active" checked>
                        <label class="form-check-label" for="statusActive">Active</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="statusInactive" value="inactive">
                        <label class="form-check-label" for="statusInactive">Inactive</label>
                    </div>
                    @error('status')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Add Course</button>
                </div>
            </form>
        </div>
    </div>
@endsection
