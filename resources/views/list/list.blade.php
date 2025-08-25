@extends('master')
@section('title',"list")
@section('content')
    <table class="table table-hover table-striped table-bordered">
        <tr>
            <th>#</th>
            <th>Enrollment</th>
            <th>Name</th>
            <th>Age</th>
            <th>Status</th>
            <th>Joined</th>
            <th>Action</th>
        </tr>
        <tbody>
        @php $count=1; @endphp
        @forelse($data as $d)
            <tr>
                <td>{{$count++}}</td>
                <td>{{$d->pretag}}{{$d->enroll_number}}</td>
                <td>{{$d->name}}</td>
                <td>{{\Carbon\Carbon::parse($d->dob)->age}} Years</td>
                <td>{{$d->status}}</td>
                <td>{{\Carbon\Carbon::parse($d->created_at)->diffForHumans()}}</td>
                <td class="d-flex justify-content-center">
                    <a class="btn btn-sm btn-primary" href="{{route('sessions.details',$d->id)}}" role="button"><i class="bi bi-eye"></i></a>
                </td>
            </tr>
        @empty
            <tr class="text-center fw-bold text-danger"> No Data Found</tr>
        @endforelse
        </tbody>
    </table>
@endsection
