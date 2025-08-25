@extends('master')
@section('title','Profile')
@section('content')
    <style>
        body {
            background: #f0f4ff;
            font-family: 'Segoe UI', sans-serif;
        }
        .profile-card {
            max-width: 600px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
            margin: 2rem auto;
            overflow: hidden;
        }
        .profile-header {
            background: #007acc;
            color: #fff;
            padding: 2rem;
            text-align: center;
        }
        .profile-header img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 15px;
            border: 4px solid #fff;
            margin-bottom: 1rem;
        }
        .profile-body {
            padding: 1.8rem 2rem;
        }
        .profile-body .row {
            margin-bottom: 1rem;
        }
        .label {
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .value {
            font-weight: 600;
            color: #1c1c1c;
            text-transform: uppercase;
        }
        .badge-status {
            padding: 0.4rem 0.9rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #fff;
            display: inline-block;
        }
    </style>

<div class="profile-card">
    <div class="profile-header">
        <img src="{{ asset('storage/app/public/'.$data->img_name) }}" style="width:200px;height:200px;" alt="Student Photo">
        <h3>{{ $data->name }}</h3>
        <p>{{ $data->pretag }}{{ $data->enroll_number }}</p>
    </div>
    <div class="profile-body">
        <div class="row">
            <div class="col-5 label">Father's Name</div>
            <div class="col-7 value">{{ $data->father_name }}</div>
        </div>
        <div class="row">
            <div class="col-5 label">Date of Birth</div>
            <div class="col-7 value">
                {{ date('d-m-Y', strtotime($data->dob)) }} ({{ \Carbon\Carbon::parse($data->dob)->age }} yrs)
            </div>
        </div>
        <div class="row">
            <div class="col-5 label">Gender</div>
            <div class="col-7 value">
                {{ucfirst($data->gender)}}
            </div>
        </div>
        <div class="row">
            <div class="col-5 label">Course</div>
            <div class="col-7 value">{{ $data->courses->name }}</div>
        </div>
        <div class="row">
            <div class="col-5 label">Mode of Study</div>
            <div class="col-7 value">{{ $data->modes->name }}</div>
        </div>
        <div class="row">
            <div class="col-5 label">Campus</div>
            <div class="col-7 value">{{ $data->campus }}</div>
        </div>
        <div class="row">
            <div class="col-5 label">Session</div>
            <div class="col-7 value">{{ $data->sessions->session }}</div>
        </div>
        <div class="row">
            <div class="col-5 label">Status</div>
            <div class="col-7 value">
        <span class="badge-status" style="background:
        @php
          switch($data->status) {
              case 'COMPLETED': echo '#1ba94c'; break;
              case 'IN PROGRESS': echo '#007acc'; break;
              case 'RE-APPEAR / BACKLOG': echo '#f39c12'; break;
              case 'FAILED': echo '#e74c3c'; break;
              case 'RESULT PENDING': echo '#f4d03f'; break;
              case 'DISCONTINUED': echo '#7f8e6d'; break;
              default: echo '#6c757d';
          }
        @endphp;">{{ $data->status }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-5 label">Joined At</div>
            <div class="col-7 value">{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans()  }}</div>
        </div>
        <div class="row">
            <div class="col-5 label">Last Updated</div>
            <div class="col-7 value">{{\Carbon\Carbon::parse($data->updated_at)->diffForHumans() }}</div>
        </div>
    </div>
</div>
@endsection
