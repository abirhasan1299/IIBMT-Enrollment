<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>IIBMT | Enrollment Verification</title>
  <style>
    :root{
      --blue-600:#0a66c2;
      --blue-700:#0b5aad;
      --blue-800:#0a4a8a;
      --bg:#f5f7fb;
      --card:#ffffff;
      --text:#1f2937;
      --muted:#6b7280;
      --danger:#b91c1c;
      --success:#166534;
      --border:#e5e7eb;
      --radius:14px;
      --shadow:0 10px 25px rgba(16,24,40,.08);
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji","Segoe UI Emoji";
      color:var(--text);
      background:var(--bg);
      line-height:1.4;
    }
    .wrap{
      max-width:1100px;
      margin: clamp(12px,4vw,40px) auto;
      padding: clamp(8px,2vw,16px);
    }
    .panel{
      display:grid;
      grid-template-columns: 420px 1fr;
      background:var(--card);
      border-radius:var(--radius);
      overflow:hidden;
      box-shadow:var(--shadow);
      min-height: 560px;
      position:relative;
    }
    .left{
      position:relative;
      padding:38px 28px;
      color:#fff;
      background: linear-gradient(160deg,var(--blue-700), var(--blue-600) 50%, var(--blue-800));
      display:flex;
      flex-direction:column;
      justify-content:space-between;
    }
    .left .brand{display:flex;align-items:center;gap:12px;}
    .logo{width:44px;height:44px;border-radius:10px;border:2px solid rgba(255,255,255,.35);display:grid;place-items:center;font-weight:800;letter-spacing:1px;}
    .brand h1{margin:0;font-size:28px;letter-spacing:.6px;}
    .left .copy{margin-top:12px;opacity:.95;font-size:16px;}
    .left .contact{margin-top:24px;padding:14px 16px;background: rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);border-radius:12px;font-size:14px;backdrop-filter: blur(2px);}
    .left .contact strong{display:block; margin-bottom:6px}
    .left .contact a{color:#fff; text-underline-offset:3px}
    .right{padding:38px 34px;display:flex;align-items:center;justify-content:center;}
    form{width:100%;max-width:520px;}
    .title{margin:0 0 6px 0;font-size:28px;font-weight:800;letter-spacing:.3px;}
    .subtitle{margin:0 0 22px 0;color:var(--muted);font-size:14px;}
    label{display:block;font-size:14px;margin: 16px 0 8px 2px;color:#111827;font-weight:600;}
    input[type="text"],input[type="date"]{
      width:100%;padding:14px 14px;font-size:16px;
      border-radius:12px;border:1px solid var(--border);background:#fff;outline:none;
      transition:.2s border-color, .2s box-shadow;
    }

box-shadow: var(--shadow);
}
    input::placeholder{color:#9aa2af}
    input:focus{border-color: var(--blue-600);box-shadow: 0 0 0 4px rgba(10,102,194,.12);}
    .captcha{margin:18px 0 12px;height:82px;border-radius:12px;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;background:#fbfbfc;font-size:14px;color:#374151;}
    .actions{margin-top:8px;display:flex;gap:10px;align-items:center;}
    button{appearance:none;border:none;cursor:pointer;padding:14px 18px;border-radius:12px;font-weight:700;background: var(--blue-600);color:#fff;transition:.2s transform, .2s opacity, .2s background;}
    button:hover{ background: var(--blue-700) }
    .note{margin-top:12px; font-size:12px; color:var(--muted);}
    .alert{margin-top:16px;padding:12px 14px;border-radius:10px;border:1px solid var(--border);background:#fff;font-size:14px;}
    .alert.error{ border-color: #fecaca; background:#fff1f2; color:var(--danger) }
    .alert.success{ border-color: #bbf7d0; background:#f0fdf4; color:var(--success) }
    .footer{margin-top:22px; font-size:12px; color:var(--muted);}
    .loader-overlay{position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(255,255,255,0.8);display:none;align-items:center;justify-content:center;z-index:99;}
    .loader{border:6px solid #f3f3f3;border-top:6px solid var(--blue-600);border-radius:50%;width:55px;height:55px;animation: spin 1s linear infinite;}
    @keyframes spin{0%{transform:rotate(0deg);}100%{transform:rotate(360deg);}}
    @media (max-width: 900px){.panel{ grid-template-columns: 1fr }.left{ min-height: 220px }.right{ padding:28px 22px }.wrap{ margin: 0; padding:0 }body{ background:#ffffff }.panel{ border-radius:0; box-shadow:none }}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="panel" role="main">
      <aside class="left" aria-label="IIBMT Information">
        <div>
          <div class="brand">
            <div class="logo" aria-hidden="true">I</div>
            <h1>IIBMT</h1>
          </div>
          <p class="copy">Verify student enrollment details securely and instantly through our enrollment verification system.</p>
          <div class="contact">
            <strong>Need help or record not found?</strong>
            If enrollment verification is unavailable, kindly contact IIBMT:
            <div style="margin-top:8px">
              📞 Landline: <a href="tel:+914428239004">044-28239004</a><br>
              📱 Mobile: <a href="tel:+919677989004">+91-9677989004</a><br>
              ✉️ Email: <a href="mailto:enrollment@iibmt.com">enrollment@iibmt.com</a>
            </div>
          </div>
        </div>
        <div class="footer">© <span id="year"></span> Indian Institute of Business Management &amp; Technology (IIBMT). All rights reserved.</div>
      </aside>

      <section class="right">
        <form id="verifyForm" method="POST" action="{{route('enrollment-verify')}}">
          @csrf
          <h2 class="title">Enrollment Verification</h2>
          <p class="subtitle">Enter the student details below to verify.</p>

          @if (session('invalid'))
            <div class="alert error" role="alert">{{ session('invalid') }}</div>
          @endif

          <label for="enrollNumber">Enrollment / Register Number</label>
          <input type="text" id="enrollNumber" name="enrollNumber" placeholder="Enter Register Number (e.g. IIBMT2025001)" required value="{{ old('enrollNumber') }}">
            <div class="note">Alphanumeric Only, e.g. IIBMT2025001</div>
          @error('enrollNumber')
            <div class="alert error">{{$message}}</div>
          @enderror

          <label for="dob">Date of Birth</label>
          <input type="text" id="dob" name="dob" placeholder="DD-MM-YYYY" required value="{{ old('dob') }}" onfocus="this.type='date'" onblur="if(!this.value)this.type='text'">
            <div class="note">Use Format: DD-MM-YY , eg. 07-09-1998</div>
          @error('dob')
            <div class="alert error">{{$message}}</div>
          @enderror

          <div class="captcha">
            <div   class="g-recaptcha" data-sitekey="6LfP0a8rAAAAAABFmu-M2vGLHywLdYymLENvIFM2"></div>
          </div>
          @error('g-recaptcha-response')
            <div class="alert error">{{$message}}</div>
          @enderror

          <div class="actions">
            <button type="submit" id="verifyBtn">Verify Enrollment</button>
              <div class="note">All data entered is kept secure and confidential.</div>
          </div>


          <div class="note">Have Trouble ? Call <b>044-28239004</b> or Email <b>enrollment@iibmt.com</b></div>
        </form>

        <!-- Loader -->
        <div class="loader-overlay" id="loaderOverlay">
          <div class="loader"></div>
        </div>
      </section>
    </div>
  </div>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>

    // Loader
    document.getElementById('verifyForm').addEventListener('submit', function (e) {
      document.getElementById('loaderOverlay').style.display = 'flex';
    });
  </script>
</body>
</html>
