<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Verification</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f5f7fb;
            margin: 0;
            padding: 40px;
        }
        .card {
            max-width: 700px;
            margin: auto;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        }
        .card-header {
            background: linear-gradient(135deg, #2563eb, #60a5fa);
            color: #fff;
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }
        .card-header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid #fff;
            margin-bottom: 10px;
            background: #fff;
            object-fit: cover;
        }
        .card-header h2 {
            margin: 10px 0 5px;
            font-size: 24px;
            font-weight: 600;
        }
        .card-header p {
            margin: 0;
            font-size: 14px;
            letter-spacing: 1px;
        }
        .card-body {
            padding: 25px 30px;
        }
        .detail {
            display: flex;
            margin-bottom: 14px;
        }
        .detail label {
            flex: 1;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }
        .detail span {
            flex: 2;
            color: #111;
            font-size: 14px;
            font-weight: 600;
            text-transform: capitalize;
        }
        .status {
            margin-top: 20px;
            text-align: center;
        }
        .status span {
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
            color: #fff;
        }
        .status .completed { background: linear-gradient(135deg,#16a34a,#22c55e); }
        .status .in-progress { background: linear-gradient(135deg,#2563eb,#3b82f6); }
        .status .backlog { background: linear-gradient(135deg,#f59e0b,#fbbf24); }
        .status .failed { background: linear-gradient(135deg,#dc2626,#ef4444); }
        .status .pending { background: linear-gradient(135deg,#eab308,#fde047); color:#111; }
        .status .discontinued { background: linear-gradient(135deg,#6b7280,#9ca3af); }

        /* ✅ Popup Styles */
        .popup {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .popup-content {
            background: #fff;
            border-radius: 15px;
            padding: 30px 40px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            position: relative;
            animation: fadeIn 0.5s ease-in-out;
        }
        .popup-content .tick {
            font-size: 60px;
            color: #16a34a;
        }
        .popup-content h3 {
            margin: 15px 0 0;
            font-size: 22px;
            color: #16a34a;
            font-weight: bold;
        }
        .popup-content .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            font-weight: bold;
            color: #666;
            cursor: pointer;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <img src="{{ asset('storage/app/public/'.$data->img_name) }}" alt="Student Photo">
        <h2>{{ $data->name }}</h2>
        <p><span id="enrollNo" style="font-weight: bolder;">{{ $data->pretag }}{{ $data->enroll_number }}</span></p>
    </div>
    <div class="card-body">
        <div class="detail"><label>Father's Name:</label> <span>{{ $data->father_name }}</span></div>
        <div class="detail"><label>Date of Birth:</label> <span>{{ date('d-m-Y', strtotime($data->dob)) }}</span></div>
        <div class="detail"><label>Gender:</label> <span>{{ ucfirst($data->gender) }}</span></div>
        <div class="detail"><label>Programme:</label> <span>{{ $data->courses->name }}</span></div>
        <div class="detail"><label>Mode of Study:</label> <span>{{ $data->modes->name }}</span></div>
        <div class="detail"><label>Campus:</label> <span>{{ $data->campus }}</span></div>
        <div class="detail"><label>Session:</label> <span>{{ $data->sessions->session }}</span></div>

        <div class="status">
      <span class="
        @switch($data->status)
            @case('COMPLETED') completed @break
            @case('IN PROGRESS') in-progress @break
            @case('RE-APPEAR / BACKLOG') backlog @break
            @case('FAILED') failed @break
            @case('RESULT PENDING') pending @break
            @case('DISCONTINUED') discontinued @break
            @default discontinued
        @endswitch
      ">
        {{ $data->status }}
      </span>
        </div>
    </div>
</div>

<!-- ✅ Verified Popup -->
<div class="popup" id="verifiedPopup">
    <div class="popup-content">
        <span class="close-btn" onclick="document.getElementById('verifiedPopup').style.display='none'">&times;</span>
        <div class="tick">&#10004;</div>
        <h3>Verified</h3>
    </div>
</div>

<script>
    // Auto-show popup on load
    window.onload = function() {
        document.getElementById('verifiedPopup').style.display = 'flex';
    }
</script>

</body>
</html>
