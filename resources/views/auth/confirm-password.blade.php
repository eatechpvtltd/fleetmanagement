<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Login Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      max-width: 900px;
      width: 100%;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      overflow: hidden;
      background-color: white;
    }

    .login-form {
      flex: 1 1 400px;
      padding: 3rem;
    }

    .login-image {
      flex: 1 1 400px;
      background-color: #e9ecef;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    .form-title {
      font-weight: 700;
      margin-bottom: 2rem;
      color: #333;
    }

    .form-control {
      padding: 0.8rem 1rem;
      border-radius: 8px;
    }

    .btn-login {
      padding: 0.8rem 1rem;
      border-radius: 8px;
      background-color: #4361ee;
      border: none;
      font-weight: 600;
      width: 100%;
      margin-top: 1.5rem;
      color: white;
    }

    @media (max-width: 768px) {
      .login-container {
        flex-direction: column-reverse;
      }

      .login-form, .login-image {
        flex: 1 1 100%;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <!-- Login Form -->
    <div class="login-form">
      <h2 class="form-title">Reset Password</h2>
      @if (request()->query('success') == 1)
          <div class="alert alert-success">
              {{ request()->query('message') }}
          </div>
      @endif
      <form id="signupForm" action="{{ route('auth.reset-password', ['hashed_id' => $hashed_id]) }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="hidden" name="hashed_id" value="{{ $hashed_id }}">
          <input type="password" id="password" class="form-control" name="password" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-login">Submit</button>
      </form>
    </div>

    <!-- Image Section -->
    <div class="login-image">
      <img src="https://img.freepik.com/free-vector/access-control-system-abstract-concept_335657-3180.jpg?t=st=1744286422~exp=1744290022~hmac=06ffdad0e460fcd5bbb8ebf4d617e1cb1af29fb3f55aa2080a20b2169b4ec428&w=826" alt="Security" class="img-fluid rounded">
    </div>
  </div>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    // Optional: Add JavaScript validation or functionality here
    document.getElementById('signupForm').addEventListener('submit', function(event) {
      event.preventDefault();
      const password = document.getElementById('password').value;
      if (password.length < 6) {
        
        alert('Password must be at least 6 characters long.');
      }
      $.ajax({
        url: "{{ route('auth.reset-password', ['hashed_id' => $hashed_id]) }}",
        type: "POST",
        data: {
          _token: "{{ csrf_token() }}", // important for Laravel!
          password: password,
          hashed_id: "{{ $hashed_id }}"
        },
        success: function(response) {
          // sesssion flash meesage 

         
        },
        error: function(xhr) {
          alert('An error occurred. Please try again.');
        }
      });

    });
  </script>
</body>
</html>

