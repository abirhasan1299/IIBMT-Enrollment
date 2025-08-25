@extends("master")
@yield("Add Enrollment ")
@section('content')
    <style>
        /* Modern look */
        input, select, button { border-radius: 8px !important; }
        .card-modern { border: 0; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,.06); }

        /* Image preview */
        .image-preview { width:150px; height:150px; border:2px dashed #ccc; border-radius:12px; display:flex; align-items:center; justify-content:center; overflow:hidden; background:#f9fafb; transition:.2s; }
        .image-preview:hover { border-color:#0d6efd; }
        .image-preview img { width:100%; height:100%; object-fit:cover; }

        /* Status badge */
        .status-badge { padding:.4rem .6rem; border-radius:999px; font-weight:600; border:1px solid rgba(0,0,0,.05); }

        /* Ensure datepicker appears above modals/cards */
        .ui-datepicker { z-index: 2000 !important; }
    </style>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Done !</strong> {{session('success')}}.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mt-2">
        <div class="card card-modern p-4">
            <h4 class="text-center mb-4 fw-bold text-primary">📄 Enrollment Submission</h4>

            <form method="post" action="{{ route('enrollDone') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="enrollmentNumber" class="form-label fw-semibold">Enrollment Number</label>
                        <div class="input-group">
                            <div class="input-group-text bg-success">
                                <input type="hidden" name="pretag" id="pretag" >
                                <label id="prenum" style="color:white;" class="form-check-label small mb-0"></label>
                            </div>
                            <input type="number"  name="enroll_number" class="form-control" id="enrollmentNumber"
                                   placeholder="Enter Number" value="{{ old('enroll_number',$num) }}"
                                   readonly required>
                            <div class="input-group-text bg-light">
                                <input type="checkbox" id="toggleEnrollEdit" class="form-check-input me-1">
                                <label for="toggleEnrollEdit" class="form-check-label small mb-0">Edit Mode</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="studentName" class="form-label fw-semibold">Student Name</label>
                        <input type="text" name="name" class="form-control" id="studentName" placeholder="Enter Student Name" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="fatherName" class="form-label fw-semibold">Father's Name</label>
                        <input type="text" name="father_name" class="form-control" id="fatherName" placeholder="Enter Father's Name" required>
                    </div>

                    {{-- Modern jQuery datepicker --}}
                    <div class="col-md-6">
                        <label for="dob" class="form-label fw-semibold">Date of Birth</label>
                        <div class="input-group">
                        <span class="input-group-text">
                            <!-- calendar icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M3 0a1 1 0 0 1 1 1v1h8V1a1 1 0 1 1 2 0v1h1a1 1 0 0 1 1 1v2H0V3a1 1 0 0 1 1-1h1V1a1 1 0 0 1 1-1zM0 7v7a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7z"/>
                            </svg>
                        </span>
                            <input type="text" name="dob" class="form-control" id="dob" placeholder="YYYY-MM-DD" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="programme" class="form-label fw-semibold">Course</label>
                        <select class="form-control" name="programme" id="course" onchange="data()">
                            <option selected disabled>-----Choose Course-----</option>
                            @forelse($course as $c)

                                <option value="{{$c->id}}" data-content="{{$c->shortcode}}">{{$c->name}}{{$c->code}}</option>
                            @empty
                                No course Found
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="session" class="form-label fw-semibold">Session</label>
                        <select class="form-control" name="session_out">
                            <option selected disabled>-----Choose Session-----</option>
                            @forelse($session as $s)

                                <option value="{{$s->id}}">{{$s->session}}</option>
                            @empty
                                No session Found
                            @endforelse
                        </select>
                    </div>
                </div>

                {{-- Photo Upload + Live Preview --}}
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="photo" class="form-label fw-semibold">Upload Student Photo</label>
                        <input type="file" name="image" class="form-control" id="photo" accept="image/*" onchange="previewImage(event)" required>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="image-preview" id="imagePreview">
                            <span class="text-muted">Preview</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Mode of Study</label>
                        <select name="mode" class="form-control">
                            <option selected disabled>------Select Mode------</option>
                            @forelse($mode as $m)
                                <option value="{{$m->id}}">{{$m->name}}</option>
                            @empty
                                <option>No Modes Found</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-6 mb-3 mt-3">
                        <label class="form-label fw-semibold">Gender</label> <br>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male" checked>
                            <label class="form-check-label" for="genderMale">Male</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female">
                            <label class="form-check-label" for="genderFemale">Female</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="genderOther" value="other">
                            <label class="form-check-label" for="genderOther">Others</label>
                        </div>
                    </div>

                </div>

                {{-- Status with color options + live badge --}}
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label fw-semibold">Status</label>
                        <div class="d-flex align-items-center gap-2">
                            <select class="form-select" id="status" name="status" required>
                                <option selected disabled>------Select Status------</option>
                                <option value="COMPLETED"              style="color:#1ba94c" data-color="#1ba94c">COMPLETED</option>
                                <option value="IN PROGRESS"            style="color:#007acc" data-color="#007acc">IN PROGRESS</option>
                                <option value="RE-APPEAR / BACKLOG"    style="color:#f39c12" data-color="#f39c12">RE-APPEAR / BACKLOG</option>
                                <option value="FAILED"                 style="color:#e74c3c" data-color="#e74c3c">FAILED</option>
                                <option value="RESULT PENDING"         style="color:#f4d03f" data-color="#f4d03f">RESULT PENDING</option>
                                <option value="DISCONTINUED"           style="color:#7f8e6d" data-color="#7f8e6d">DISCONTINUED</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Campus</label> <br>
                        <input type="text" placeholder="Enter Campus Name" name="campus" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="d-flex justify-content-center">
                        <div class="d-grid w-50">
                            <button type="submit" class="btn btn-primary fw-semibold shadow-sm">➕ Add Enrollment</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    {{-- jQuery + jQuery UI (modern datepicker) --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" defer></script>
    <script>
        // Toggle readonly for enrollment number
        document.addEventListener('DOMContentLoaded', function () {
            const enrollInput = document.getElementById('enrollmentNumber');
            const toggle = document.getElementById('toggleEnrollEdit');

            toggle.addEventListener('change', function () {
                if (this.checked) {
                    enrollInput.removeAttribute('readonly');
                    enrollInput.focus();
                } else {
                    enrollInput.setAttribute('readonly', true);
                }
            });
        });

       function data() {
           let select = document.getElementById('course');
           let selectedOption = select.options[select.selectedIndex]; // get the <option>
           let val = selectedOption.dataset.content; // get data-content value

           document.getElementById('prenum').innerHTML = val;
           document.getElementById('pretag').value = val;
       }

    </script>
    <script>
        // When scripts load
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize jQuery UI datepicker once jQuery is ready
            const initDatepicker = () => {
                if (window.jQuery && $.fn.datepicker) {
                    $('#dob').datepicker({
                        dateFormat: 'yy-mm-dd',
                        changeMonth: true,
                        changeYear: true,
                        yearRange: '1950:+0',   // adjust as needed
                        maxDate: 0,
                        showAnim: 'fadeIn'
                    });
                } else {
                    // retry shortly if scripts deferred
                    setTimeout(initDatepicker, 50);
                }
            };
            initDatepicker();

            // Status badge color sync
            const statusSelect = document.getElementById('status');
            const badge = document.getElementById('statusBadge');

            function setBadge(color, text) {
                if (!color) {
                    badge.style.backgroundColor = '';
                    badge.style.color = '';
                    badge.textContent = 'Pick status';
                    badge.classList.add('text-muted');
                    return;
                }
                badge.classList.remove('text-muted');
                badge.textContent = text || 'Selected';
                badge.style.backgroundColor = color;
                // pick contrasting text color
                try {
                    const rgb = hexToRgb(color);
                    const brightness = (rgb.r * 299 + rgb.g * 587 + rgb.b * 114) / 1000;
                    badge.style.color = brightness > 150 ? '#111' : '#fff';
                } catch(e) {
                    badge.style.color = '#fff';
                }
            }

            function hexToRgb(hex) {
                const cleaned = hex.replace('#','');
                const bigint = parseInt(cleaned.length === 3
                    ? cleaned.split('').map(c => c + c).join('')
                    : cleaned, 16);
                return { r:(bigint>>16)&255, g:(bigint>>8)&255, b:bigint&255 };
            }

            statusSelect.addEventListener('change', function(){
                const opt = this.options[this.selectedIndex];
                const color = opt.getAttribute('data-color');
                setBadge(color, opt.value);
                // Optional: add colored left border to the select
                this.style.borderLeft = '8px solid ' + color;
            });
        });

        // Photo live preview
        function previewImage(event) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = "";
            const file = event.target.files[0];
            if (!file) return;
            const img = document.createElement("img");
            img.src = URL.createObjectURL(file);
            img.onload = () => URL.revokeObjectURL(img.src);
            preview.appendChild(img);
        }
    </script>
@endsection
