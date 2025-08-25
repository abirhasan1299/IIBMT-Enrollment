@extends("master")
@yield("Update Enrollment ")
@section('content')
<style>
    input, select, button {
        border-radius: 0 !important; /* Make all inputs, selects, and buttons square */
    }
</style>


@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif



<div class="container mt-5">
    <h4 class="text-center mb-4">Enrollment Update Form</h4>
    <form method="post" action="{{route('updateStudent',$data->id)}}" autocomplete="off">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="input-group-text bg-success">
                    <input type="hidden" name="pretag" id="pretag" value="{{$data->pretag}}" >
                    <label id="prenum" style="color:white;" class="form-check-label small mb-0">{{$data->pretag}}</label>
                </div>
                <input type="text"   class="form-control" placeholder="Enter Number" value="{{ $data->enroll_number }}"
                       readonly >

            </div>
            <div class="col-md-6">
                <label for="studentName" class="form-label">Student Name</label>
                <input type="text" name="name" class="form-control" id="studentName" value="{{ $data->name }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="fatherName" class="form-label">Father's Name</label>
                <input type="text" name="father_name" class="form-control" id="fatherName" value="{{ $data->father_name }}" required>
            </div>
            <div class="col-md-6">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" id="dob" value="{{ $data->dob }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label for="course" class="form-label fw-semibold">Course</label>
                <select class="form-control" name="course" id="course" onchange="data()">
                    <option  disabled>-----Choose Course-----</option>

                    @forelse($course as $c)
                        <option value="{{ $c->id }}" data-content="{{ $c->name }}" {{$data->course_id=$c->id ?'selected':''}}>
                            {{ $c->name }} ({{ $c->code }})
                        </option>
                    @empty
                        <option disabled>No course Found</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-6">
                <label for="session" class="form-label fw-semibold">Session</label>
                <select class="form-control" name="session_out">
                    <option selected disabled>-----Choose Session-----</option>
                    @forelse($session as $s)

                        <option value="{{$s->id}}" {{$data->session_id=$s->id?'selected':''}}>{{$s->session}}</option>
                    @empty
                        No session Found
                    @endforelse
                </select>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Mode of Study</label>
                <select name="mode" class="form-control">
                    @forelse($mode as $m)
                        <option value="{{$m->id}}" {{$data->mode==$m->id?'selected':''}}>{{$m->name}}</option>
                    @empty
                        <option>No Modes Found</option>
                    @endforelse
                </select>
            </div>
            <div class="col-md-6 mb-3 mt-3">
                <label class="form-label fw-semibold">Gender</label> <br>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male" {{$data->gender=='male'?'checked':''}}>
                    <label class="form-check-label" for="genderMale">Male</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female" {{$data->gender=='female'?'checked':''}}>
                    <label class="form-check-label" for="genderFemale">Female</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="genderOther" value="other" {{$data->gender=='other'?'checked':''}}>
                    <label class="form-check-label" for="genderOther" >Others</label>
                </div>
            </div>

        </div>

        <div class="row mb-3">
           <div class="col-md-6 mb-3 mb-md-0">
    <label for="status" class="form-label">Status</label>
    <select class="form-select" name="status" required>
        <option selected value="{{ $data->session }}">{{ $data->status }}</option>
        <option value="COMPLETED" style="color: #1ba94c">COMPLETED</option>
        <option value="IN PROGRESS" style="color: #007acc">IN PROGRESS</option>
        <option value="RE-APPEAR / BACKLOG" style="color: #f39c12">RE-APPEAR / BACKLOG</option>
        <option value="FAILED" style="color: #e74c3c">FAILED</option>
        <option value="RESULT PENDING" style="color: #f4d03f">RESULT PENDING</option>
        <option value="DISCONTINUED" style="color: #7f8e6d">DISCONTINUED</option>
    </select>
</div>
            <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Campus</label> <br>
                    <input type="text" value="{{$data->campus}}" name="campus" class="form-control">
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div >
                <button type="submit" class="btn btn-danger"> UPDATE </button>
            </div>
        </div>
    </form>
</div>
    <script>
        function data() {
            let select = document.getElementById('course');
            let selectedOption = select.options[select.selectedIndex]; // get the <option>
            let val = selectedOption.dataset.content; // get data-content value

            document.getElementById('prenum').innerHTML = val;
            document.getElementById('pretag').value = val;
        }
    </script>

@endsection
