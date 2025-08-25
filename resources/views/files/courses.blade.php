@extends('master')
@section('title','School')
@section('content')
    <style>
        body {
            background: #f8f9fa;
            font-family: "Poppins", sans-serif;
        }
        .table thead {
            background: #0d6efd;
            color: #fff;
        }
        .table-hover tbody tr:hover {
            background-color: #eef5ff;
        }
        .btn-sm {
            padding: 4px 10px;
            border-radius: 20px;
        }
    </style>
    <div class="d-flex justify-content-between">
        <div>
            <a href="{{route('add.courses')}}" class="btn btn-primary" role="button">+ Add Course</a>
        </div>
        <div>
            <input type="search" placeholder="search..." class="form-control" id="searchInput">
        </div>
    </div>
    <div class="table-responsive shadow rounded mt-3">
        <table class="table table-hover align-middle mb-0" id="myTable">
            <thead>
            <tr>
                <th scope="col">SL</th>
                <th scope="col">Course Name</th>
                <th scope="col">Code</th>
                <th scope="col">Short Code</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
            </thead>
            @php
                $count=1;
            @endphp
            <tbody>
            @foreach($course as $s)
                <tr>
                    <td>{{$count++}}</td>
                    <td>{{$s->name}}</td>
                    <td>{{$s->code}}</td>
                    <td>{{$s->shortcode}}</td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-danger" href="{{route('courses.destroy',$s->id)}}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>

        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#myTable tr');

            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                if (text.indexOf(filter) > -1) {
                    row.style.display = ''; // show row
                } else {
                    row.style.display = 'none'; // hide row
                }
            });
        });
    </script>
@endsection
