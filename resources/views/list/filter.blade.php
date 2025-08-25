@extends("master")
@yield("Enrollment")
@section('content')
    <form action="{{route('home.filter')}}" method="post">
        <div class="d-flex justify-content-around">
            <select class="form-control" name="course" >
                <option selected disabled>Choose Course</option>
                @forelse($course as $c)
                    <option value="{{$c->id}}">{{$c->name}} ({{$c->code}})</option>
                @empty
                    No course Found
                @endforelse
            </select>
            <select class="form-control" name="session_out" >
                <option selected disabled>Choose Session</option>
                @forelse($session as $c)
                    <option value="{{$c->id}}">{{$c->session}} </option>
                @empty
                    No course Found
                @endforelse
            </select>
            <input type="text" name="enroll" placeholder="Enrollment Number" class="form-control">
            <select name="mode" class="form-control">
                <option selected disabled>Select Mode</option>
                @forelse($mode as $m)
                    <option value="{{$m->id}}">{{$m->name}}</option>
                @empty
                    <option>No Modes Found</option>
                @endforelse
            </select>
            <button type="submit" class="btn  btn-success"> <i class="bi bi-funnel-fill"> </i> </button>
        </div>
    </form>
    <br>
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>SL</th>
            <th>Enrollment No</th>
            <th>Name</th>
            <th>Father Name</th>
            <th>Birth</th>
            <th>Course</th>
            <th>Session</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @php $count=1; @endphp
        <tbody id="myTable">
        @foreach($data as $e)
            <tr>
                <td>{{$count++}}</td>
                <td>{{$e->pretag}}{{$e->enroll_number}}</td>
                <td>{{$e->name}}</td>
                <td>{{$e->father_name}}</td>
                <td>{{date('d-m-Y', strtotime($e->dob))}}</td>
                <td>{{$e->courses->name}}({{$e->courses->code}})</td>
                <td>{{$e->sessions->session}}</td>
                <td>
    <span class="badge rounded-pill" style="@php
        switch($e->status) {
            case 'COMPLETED':
                echo 'background-color: #1ba94c; color: white;';
                break;
            case 'IN PROGRESS':
                echo 'background-color: #007acc; color: white;';
                break;
            case 'RE-APPEAR / BACKLOG':
                echo 'background-color: #f39c12; color: white;';
                break;
            case 'FAILED':
                echo 'background-color: #e74c3c; color: white;';
                break;
            case 'RESULT PENDING':
                echo 'background-color: #f4d03f; color: black;';
                break;
            case 'DISCONTINUED':
                echo 'background-color: #7f8e6d; color: white;';
                break;
            default:
                echo 'background-color: #6c757d; color: white;'; // default gray for unknown statuses
        }
    @endphp">
        {{ $e->status }}
    </span>
                </td>
                <td>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('sessions.details',$e->id) }}" role="button" class="btn btn-primary"><i class="bi bi-eye"> </i></a>

                        <a href="{{ route('editStudent',$e->id) }}" role="button" class="btn btn-warning ml-2"><i class="bi bi-pencil-square"> </i></a>

                        <a href="{{ route('delStudent',$e->id) }}" class="btn btn-danger" role="button" style="margin-left:5px;"><i class="bi bi-trash " ></i></a>

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
