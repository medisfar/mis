<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Laravel | Elegant Login</title>
  <!-- Bootstrap 5 CSS + Icons + Google Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
      position: relative;
      overflow-x: hidden;
    }

    /* elegant animated background */
    body::before {
      content: "";
      position: absolute;
      width: 350px;
      height: 350px;
      background: radial-gradient(circle, rgba(56, 189, 248, 0.2) 0%, rgba(6, 182, 212, 0) 70%);
      border-radius: 50%;
      top: -120px;
      left: -120px;
      z-index: 0;
      animation: float 20s infinite ease-in-out;
    }

    body::after {
      content: "";
      position: absolute;
      width: 450px;
      height: 450px;
      background: radial-gradient(circle, rgba(168, 85, 247, 0.12) 0%, rgba(139, 92, 246, 0) 70%);
      border-radius: 50%;
      bottom: -150px;
      right: -150px;
      z-index: 0;
      animation: floatReverse 22s infinite ease-in-out;
    }

    @keyframes float {
      0%, 100% { transform: translate(0, 0); }
      50% { transform: translate(30px, 20px); }
    }

    @keyframes floatReverse {
      0%, 100% { transform: translate(0, 0); }
      50% { transform: translate(-30px, -20px); }
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.06);
      backdrop-filter: blur(16px);
      border-radius: 2rem;
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 25px 45px -12px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.02) inset;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .glass-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 35px 55px -15px rgba(0, 0, 0, 0.5);
      border-color: rgba(255, 255, 255, 0.18);
    }

    .login-wrapper {
      max-width: 460px;
      width: 100%;
      margin: 0 auto;
      position: relative;
      z-index: 2;
    }

    .brand-icon {
      background: linear-gradient(125deg, #38bdf8, #818cf8);
      width: 70px;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 28px;
      margin-bottom: 1.5rem;
      box-shadow: 0 12px 24px -8px rgba(56, 189, 248, 0.35);
    }

    .brand-icon i {
      font-size: 2.5rem;
      color: white;
    }

    .form-floating > .form-control {
      background-color: rgba(15, 23, 42, 0.55);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 1.2rem;
      color: #f1f5f9;
      font-weight: 500;
      transition: all 0.2s;
    }

    .form-floating > .form-control:focus {
      background-color: rgba(30, 41, 59, 0.85);
      border-color: #38bdf8;
      box-shadow: 0 0 0 0.25rem rgba(56, 189, 248, 0.3);
      color: white;
    }

    .form-floating > .form-control.is-invalid {
      border-color: #f87171;
      background-color: rgba(220, 38, 38, 0.15);
    }

    .form-floating > .form-control.is-invalid:focus {
      box-shadow: 0 0 0 0.2rem rgba(248, 113, 113, 0.3);
    }

    .form-floating > label {
      color: #94a3b8;
      font-weight: 500;
      letter-spacing: 0.3px;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
      color: #a5f3fc;
      opacity: 0.95;
    }

    .input-group-text {
      background-color: rgba(15, 23, 42, 0.7);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 1.2rem;
      color: #cbd5e1;
      cursor: pointer;
      transition: 0.2s;
    }

    .input-group-text:hover {
      background-color: #1e293b;
      color: #38bdf8;
    }

    .btn-login {
      background: linear-gradient(95deg, #2563eb, #7c3aed);
      border: none;
      padding: 0.85rem 1rem;
      border-radius: 2rem;
      font-weight: 600;
      font-size: 1rem;
      letter-spacing: 0.4px;
      box-shadow: 0 8px 20px -6px #3b82f650;
      transition: all 0.25s;
    }

    .btn-login:hover {
      background: linear-gradient(95deg, #3b82f6, #8b5cf6);
      transform: scale(1.02);
      box-shadow: 0 12px 28px -8px #3b82f6a0;
    }

    .forgot-link, .register-link {
      color: #cbd5f0;
      text-decoration: none;
      font-weight: 500;
      transition: 0.2s;
      font-size: 0.85rem;
    }

    .forgot-link:hover, .register-link:hover {
      color: #7dd3fc;
      text-decoration: underline;
    }

    .divider {
      display: flex;
      align-items: center;
      text-align: center;
      color: #94a3b8;
      font-size: 0.7rem;
      font-weight: 500;
      letter-spacing: 0.5px;
    }

    .divider::before, .divider::after {
      content: '';
      flex: 1;
      border-bottom: 1px solid rgba(255, 255, 255, 0.12);
    }

    .divider::before {
      margin-right: 0.75rem;
    }

    .divider::after {
      margin-left: 0.75rem;
    }

    .form-check-input {
      background-color: rgba(15, 23, 42, 0.7);
      border-color: rgba(255, 255, 255, 0.3);
      cursor: pointer;
    }
    .form-check-input:checked {
      background-color: #3b82f6;
      border-color: #3b82f6;
    }
    .form-check-label {
      font-size: 0.85rem;
      color: #cbd5e6;
      cursor: pointer;
    }

    .alert-custom {
      border-radius: 1rem;
      font-size: 0.85rem;
      backdrop-filter: blur(4px);
    }

    .invalid-feedback-custom {
      width: 100%;
      margin-top: 0.3rem;
      font-size: 0.75rem;
      color: #fca5a5;
      padding-left: 0.75rem;
      font-weight: 500;
    }

    @media (max-width: 520px) {
      body {
        padding: 1rem;
      }
      .glass-card {
        border-radius: 1.75rem;
        padding: 1.5rem !important;
      }
      .brand-icon {
        width: 60px;
        height: 60px;
      }
      .brand-icon i {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>

<div class="login-wrapper">
  <div class="glass-card p-4 p-md-5">
    <div class="text-center mb-4">
      <div class="brand-icon mx-auto">
        <i class="bi bi-shield-lock-fill"></i>
      </div>
      <h2 class="fw-bold mt-3 mb-1" style="font-family: 'Playfair Display', serif; background: linear-gradient(135deg, #FFFFFF, #B8E1FC); background-clip: text; -webkit-background-clip: text; color: transparent;">Welcome Back</h2>
      <p class="text-white-50 small mt-2">Sign in to your Laravel account</p>
    </div>

    <!-- Session Status (password reset confirmation etc) -->
    @if (session('status'))
      <div class="alert alert-success mb-3 alert-dismissible fade show alert-custom" style="background: rgba(34,197,94,0.12); border-left: 3px solid #4ade80;" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('status') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
      <div class="alert alert-danger mb-3 alert-dismissible fade show alert-custom" style="background: rgba(220,38,38,0.12); border-left: 3px solid #f87171;" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <strong>Access denied:</strong> {{ $errors->first() }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <!-- Laravel Authentication Form -->
    <form method="POST" action="{{ route('login') }}" id="loginForm">
      @csrf

      <!-- Email input -->
      <div class="form-floating mb-4">
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus autocomplete="username">
        <label for="email"><i class="bi bi-envelope-fill me-1"></i> Email address</label>
        @error('email')
          <div class="invalid-feedback-custom">{{ $message }}</div>
        @enderror
      </div>

      <!-- Password input with toggle -->
      <div class="form-floating mb-2">
        <div class="input-group">
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required autocomplete="current-password" style="border-top-right-radius: 1.2rem; border-bottom-right-radius: 1.2rem;">
          <span class="input-group-text" id="togglePassword" style="border-top-left-radius: 0; border-bottom-left-radius: 0; border-left: 0;">
            <i class="bi bi-eye-slash" id="toggleIcon"></i>
          </span>
        </div>
        <label for="password"><i class="bi bi-key-fill me-1"></i> Password</label>
        @error('password')
          <div class="invalid-feedback-custom">{{ $message }}</div>
        @enderror
      </div>

      <!-- Remember me + Forgot password row -->
      <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="remember" id="remember_me" {{ old('remember') ? 'checked' : '' }}>
          <label class="form-check-label" for="remember_me"> Keep me signed in</label>
        </div>
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="forgot-link">Recover password?</a>
        @endif
      </div>

      <button type="submit" class="btn btn-login w-100 text-white">
        <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
      </button>
    </form>

    <!-- Simple elegant divider -->
    <div class="divider my-4">
      <span>secure access</span>
    </div>

    <!-- Registration link - clean and minimal -->
    <div class="text-center pt-1">
      <p class="mb-0 text-white-50 small">
        New to the platform?
        @if (Route::has('register'))
          <a href="{{ route('register') }}" class="register-link fw-semibold ms-1">Create an account</a>
        @else
          <a href="#" class="register-link fw-semibold ms-1">Get started</a>
        @endif
      </p>
    </div>
    
    <div class="text-center mt-4">
      <p class="text-white-50 opacity-50 small mb-0">
        <i class="bi bi-shield-check"></i> Laravel • Protected & Modern
      </p>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  (function() {
    // Elegant password visibility toggle
    const toggleBtn = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (toggleBtn && passwordField) {
      toggleBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
      });
    }

    // Auto-dismiss alerts after 5 seconds for better UX
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
      setTimeout(() => {
        if (alert && alert.remove) {
          const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
          bsAlert.close();
        }
      }, 5000);
    });

    // Clean client-side validation (non-intrusive, enhances user feedback)
    const form = document.getElementById('loginForm');
    if (form) {
      form.addEventListener('submit', function(e) {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        let errorFlag = false;
        
        // Remove any previous client custom errors
        document.querySelectorAll('.client-error-custom').forEach(el => el.remove());
        
        // Email validation
        const emailVal = emailInput.value.trim();
        if (!emailVal) {
          showGentleError(emailInput, 'Email address is required.');
          errorFlag = true;
        } else if (!/^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/.test(emailVal)) {
          showGentleError(emailInput, 'Please enter a valid email address (e.g., name@domain.com).');
          errorFlag = true;
        }
        
        // Password validation
        const passVal = passwordInput.value;
        if (!passVal) {
          showGentleError(passwordInput, 'Password cannot be empty.');
          errorFlag = true;
        } else if (passVal.length < 4) {
          showGentleError(passwordInput, 'Password must contain at least 4 characters.');
          errorFlag = true;
        }
        
        if (errorFlag) {
          e.preventDefault();
          const firstErrorElem = document.querySelector('.client-error-custom');
          if (firstErrorElem) {
            firstErrorElem.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
        }
      });
      
      function showGentleError(inputElement, message) {
        // Mark input as invalid visually
        inputElement.classList.add('is-invalid');
        const parentContainer = inputElement.closest('.form-floating') || inputElement.parentElement;
        let errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback-custom client-error-custom';
        errorDiv.style.fontSize = '0.75rem';
        errorDiv.style.marginTop = '0.25rem';
        errorDiv.innerText = message;
        
        // Remove existing error if any
        const existingError = parentContainer.querySelector('.client-error-custom');
        if (existingError) existingError.remove();
        parentContainer.appendChild(errorDiv);
        
        // Remove error indicator on input focus or change
        inputElement.addEventListener('input', function removeErrorOnInput() {
          inputElement.classList.remove('is-invalid');
          const errDiv = parentContainer.querySelector('.client-error-custom');
          if (errDiv) errDiv.remove();
          inputElement.removeEventListener('input', removeErrorOnInput);
        }, { once: true });
      }
    }
    
    // Add subtle placeholder animation and auto-focus improvement
    const emailField = document.getElementById('email');
    if (emailField && !emailField.value) {
      // just pure elegance: if empty, slight attention
    }
    
    // Extra polish: floating label fix for autofilled browsers
    setTimeout(() => {
      const autoFilled = document.querySelectorAll('input');
      autoFilled.forEach(field => {
        if (field.value) {
          field.dispatchEvent(new Event('input', { bubbles: true }));
        }
      });
    }, 100);
  })();
</script>
</body>
</html>