<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Verification</title>
    <style>
        :root {
            --primary:#2563eb;
            --primary-light:#60a5fa;
            --green:#22c55e;
            --red:#ef4444;
            --amber:#f59e0b;
            --gray:#6b7280;
            --bg-grad:linear-gradient(135deg,#eef2ff 0%,#f8fafc 100%);
            --card-radius:22px;
        }
        body {
            margin:0;
            font-family:'Segoe UI', Helvetica, Arial, sans-serif;
            background:var(--bg-grad);
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
            padding:1rem;
        }
        .card {
            background:rgba(255,255,255,0.85);
            border-radius:var(--card-radius);
            box-shadow:0 10px 30px rgba(0,0,0,0.1);
            width:650px;
            padding:2.5rem;
            backdrop-filter: blur(12px);
            position:relative;
            overflow:hidden;
            animation:fadeIn 0.7s ease-in-out;
        }
        .card::before {
            content:"";
            position:absolute;
            top:-70px; right:-70px;
            width:180px; height:180px;
            background:var(--primary-light);
            opacity:0.15;
            border-radius:50%;
        }
        h2 {
            margin:0 0 1rem;
            font-size:2rem;
            text-align:center;
            color:var(--primary);
            font-weight:700;
            letter-spacing:1px;
            position:relative;
        }
        .profile {
            display:flex;
            justify-content:center;
            margin-bottom:1.5rem;
        }
        .profile img {
            width:150px;
            height:150px;
            border-radius:50%;
            object-fit:cover;
            border:6px solid #fff;
            box-shadow:0 8px 25px rgba(0,0,0,0.15);
            transition: transform 0.3s;
        }
        .profile img:hover {
            transform: scale(1.05);
        }
        .details {
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:1rem 2rem;
        }
        .item {
            display:flex;
            flex-direction:column;
            gap:0.25rem;
        }
        .label {
            font-size:0.85rem;
            font-weight:600;
            color:var(--gray);
            text-transform:uppercase;
            letter-spacing:0.5px;
        }
        .value {
            font-size:1rem;
            font-weight:600;
            color:#111827;
        }
        .badge {
            display:inline-block;
            padding:0.5rem 1rem;
            border-radius:50px;
            font-size:0.85rem;
            font-weight:700;
            color:#fff;
            text-align:center;
            box-shadow:0 4px 12px rgba(0,0,0,0.1);
        }
        @keyframes fadeIn {
            from {opacity:0; transform:translateY(15px);}
            to {opacity:1; transform:translateY(0);}
        }
    </style>
</head>
<body>
<div class="card">
    <h2>Enrollment Verification</h2>

    <div class="profile">
        <img src="{{ asset('storage/app/public/'.$data->img_name) }}" alt="Student Photo">
    </div>

    <div class="details">
        <div class="item"><div class="label">Enrollment No</div><div class="value">{{ $data->pretag }}{{ $data->enroll_number }}</div></div>
        <div class="item"><div class="label">Student Name</div><div class="value">{{ $data->name }}</div></div>
        <div class="item"><div class="label">Father's Name</div><div class="value">{{ $data->father_name }}</div></div>
        <div class="item"><div class="label">Date of Birth</div><div class="value">{{ date('d-m-Y', strtotime($data->dob)) }}</div></div>
        <div class="item"><div class="label">Gender</div><div class="value">{{ ucfirst($data->gender) }}</div></div>
        <div class="item"><div class="label">Programme</div><div class="value">{{ $data->courses->name }}</div></div>
        <div class="item"><div class="label">Mode of Study</div><div class="value">{{ $data->modes->name }}</div></div>
        <div class="item"><div class="label">Campus</div><div class="value">{{ $data->campus }}</div></div>
        <div class="item"><div class="label">Session</div><div class="value">{{ $data->sessions->session }}</div></div>
        <div class="item">
            <div class="label">Status</div>
            <div class="value">
          <span class="badge" style="background:
            @php
              switch($data->status) {
                  case 'COMPLETED': echo 'linear-gradient(135deg,#16a34a,#22c55e)'; break;
                  case 'IN PROGRESS': echo 'linear-gradient(135deg,#2563eb,#3b82f6)'; break;
                  case 'RE-APPEAR / BACKLOG': echo 'linear-gradient(135deg,#f59e0b,#fbbf24)'; break;
                  case 'FAILED': echo 'linear-gradient(135deg,#dc2626,#ef4444)'; break;
                  case 'RESULT PENDING': echo 'linear-gradient(135deg,#eab308,#fde047)'; break;
                  case 'DISCONTINUED': echo 'linear-gradient(135deg,#6b7280,#9ca3af)'; break;
                  default: echo 'linear-gradient(135deg,#6c757d,#9ca3af)';
              }
            @endphp;">
            {{ $data->status }}
          </span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
