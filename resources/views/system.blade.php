@extends("master")
@yield("System")
@section('content')
<div class="row">
    <!-- Admin Insert Form -->
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">Admin Register</div> <br>
            <div class="card-body">
                <!-- Display Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Form Start -->
                <form action="{{ route('adminAdd') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Admin Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Admin Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Admin Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Admin</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Admin List Table -->
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">Admin List</div> <br>
            <div class="card-body">
                <table class="table table-bordered">
    <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
    </thead>
    @php
        $count = 1;
    @endphp
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td>{{ $count }}</td>
            <td>{{ $d->name }}</td>
            <td>{{ $d->email }}</td>
            <td>
                <span class="password-field" style="user-select:none;">••••••••</span>
                <button class="btn btn-sm btn-outline-secondary toggle-password" aria-label="Toggle Password" style="margin-left: 5px;">
                    <i class="bi bi-eye"></i>
                </button>
                <input type="hidden" value="{{ $d->password }}" />
            </td>
            <td>
                <a href="{{ route('deladmin',$d->id) }}" style="text-align: center;font-size:14px;color:red;"><i class="bi bi-trash"> Trash </i></a>
            </td>
        </tr>
        @php
            $count++;
        @endphp
        @endforeach
        <!-- More rows here -->
    </tbody>
</table>

<script>


document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', () => {
        const td = button.closest('td');
        const passwordSpan = td.querySelector('.password-field');
        const realPassword = td.querySelector('input[type="hidden"]').value;

        if (passwordSpan.textContent.includes('•')) {
            // Show password
            passwordSpan.textContent = realPassword;
        } else {
            // Hide password (dots)
            passwordSpan.textContent = '••••••••';
        }
    });
});
</script>

            </div>
        </div>
    </div>
</div>
@endsection
