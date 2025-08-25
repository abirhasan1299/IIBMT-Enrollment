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
        .qr-box {
            text-align: right;
            padding: 15px 30px 25px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: center;
        }
        .qr-box img {
            width: 90px;
            height: 90px;
        }
        .qr-box p {
            font-size: 12px;
            color: #666;
            margin: 5px 0 0;
        }
    </style>
    <script>
        function updateQRCode() {
            const qrImg = document.getElementById("qrCode");
            qrImg.src = "https://api.qrserver.com/v1/create-qr-code/?size=90x90&data={{ url('/qrcode') }}/{{ bin2hex($data->enroll_number) }}";
        }
        window.onload = updateQRCode;
    </script>
</head>
<body>

<div class="card">
    <div class="card-header">
        <img src="{{ asset('storage/app/public/'.$data->img_name) }}" alt="Student Photo">
        <h2>{{ $data->name }}</h2>
        <p> <span id="enrollNo" style="font-weight: bolder;text-align:center;">{{ $data->pretag }}{{ $data->enroll_number }}</span></p>
    </div>
    <div class="card-body">
        <div class="detail"><label>Father's Name:</label> <span>{{ strtoupper($data->father_name) }}</span></div>
        <div class="detail"><label>Date of Birth:</label> <span>{{ strtoupper(date('d-m-Y', strtotime($data->dob))) }}</span></div>
        <div class="detail"><label>Gender:</label> <span>{{ strtoupper($data->gender )}}</span></div>
        <div class="detail"><label>Programme:</label> <span>{{ strtoupper($data->courses->name) }}</span></div>
        <div class="detail"><label>Mode of Study:</label> <span>{{ strtoupper($data->modes->name) }}</span></div>
        <div class="detail"><label>Campus:</label> <span>{{ strtoupper($data->campus) }}</span></div>
        <div class="detail"><label>Session:</label> <span>{{ strtoupper($data->sessions->session) }}</span></div>

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
          {{strtoupper($data->status)}}
        </span>
        </div>
    </div>
    <div class="qr-box">
        <div>
            <img id="qrCode" src="" alt="QR Code">
            <p>Scan to Verify</p>
        </div>
    </div>
</div>

</body>
</html>
