@extends('master')
@section('title','Modes')
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
            <a href="{{route('mode.create')}}" class="btn btn-primary" role="button">+ Add Mode</a>
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
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
            </thead>
            @php
                $count=1;
            @endphp
            <tbody>
            @foreach($data as $s)
                <tr>
                    <td>{{$count++}}</td>
                    <td>{{$s->name}}</td>
                    <td>
                       <button class="btn btn-sm btn-{{$s->status=='active'?'success':'warning'}}">{{ucfirst($s->status)}}</button>
                    </td>
                    <td class="text-center">
                        <form action="{{route('mode.destroy',$s->id)}}" method="post" >
                            @csrf
                            @method('DELETE')
                            <button type="submit"  class="btn btn-sm btn-danger" onclick="confirm('Are you sure ?')">Delete</button>
                        </form>
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
