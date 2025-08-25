@extends("master")

@section("content")
    <div class="container mt-5">
        <h4 class="text-center mb-4">Add New Session</h4>

        <div class="card shadow rounded p-4" style="width:50%;margin:auto;">
            <form method="POST" action="{{route('sessions.store')}}">
                @csrf
                <div class="mb-3">
                    <select name="course_id" class="form-control" required>
                        <option selected disabled>----------Choose Course----------</option>
                        @foreach($course as $s)
                            <option value="{{$s->id}}" >{{$s->name}}-{{$s->code}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text"
                           name="session"
                           class="form-control @error('session') is-invalid @enderror"
                           id="schoolName"
                           placeholder="Session Year eg: 2004-2005"
                           value="{{old('session')}}"
                           required>
                    @error('session')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Add Session</button>
                </div>
            </form>
        </div>
    </div>
@endsection
