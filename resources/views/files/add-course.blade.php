@extends("master")

@section("content")
    <div class="container mt-5">
        <h4 class="text-center mb-4">Add New School</h4>

        <div class="card shadow rounded p-4" style="width:50%;margin:auto;">
            <form method="POST" action="{{route('store.courses')}}">
                @csrf
                <div class="mb-3">
                    <select name="school_id" class="form-control" required>
                        <option selected disabled>----------Choose School----------</option>
                        @foreach($school as $s)
                            <option value="{{$s->id}}" >{{$s->name}}-{{$s->code}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           id="schoolName"
                           placeholder="Enter Course Name"
                           value="{{old('name')}}"
                           required>
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="text"
                           name="code"
                           class="form-control @error('code') is-invalid @enderror"
                           id="schoolCode"
                           value="{{old('code')}}"
                           placeholder="Enter Course Code"
                           required>
                    @error('code')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="text"
                           name="shortcode"
                           class="form-control @error('shortcode') is-invalid @enderror"
                           id="schoolName"
                           placeholder="Short Code eg. BCSE or BEEE"
                           value="{{old('shortcode')}}"
                           required>
                    @error('shortcode')
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
