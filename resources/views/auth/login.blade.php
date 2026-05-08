{{-- ============================================================
     login.blade.php
     resources/views/auth/login.blade.php
     Laravel Breeze — Luminary Emerald & Gold Theme
     TailwindCSS CDN + inline custom styles
     ============================================================ --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In — Luminary</title>

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500;600&family=Cinzel:wght@400;600&display=swap" rel="stylesheet">

  {{-- TailwindCSS --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            display: ['Cormorant Garamond', 'Georgia', 'serif'],
            ui:      ['DM Sans', 'sans-serif'],
            accent:  ['Cinzel', 'serif'],
          },
          colors: {
            em: {
              900: '#064e3b', 800: '#065f46', 700: '#047857',
              600: '#059669', 400: '#34d399', 200: '#a7f3d0',
            },
            gold: {
              deep:   '#92660a',
              DEFAULT:'#b8860b',
              bright: '#d4a017',
              light:  '#f0c040',
              shim:   '#fde68a',
            },
            dark: {
              bg:    '#020f0a',
              card:  '#071c13',
              panel: '#0a2517',
            },
          },
          keyframes: {
            'fade-up': {
              '0%':   { opacity: '0', transform: 'translateY(28px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' },
            },
            'shimmer-slide': {
              '0%':   { backgroundPosition: '-400px 0' },
              '100%': { backgroundPosition: '400px 0' },
            },
            'orb-float': {
              '0%,100%': { transform: 'translate(0,0) scale(1)' },
              '50%':     { transform: 'translate(24px,16px) scale(1.05)' },
            },
            'pulse-ring': {
              '0%':   { boxShadow: '0 0 0 0 rgba(212,160,23,0.35)' },
              '70%':  { boxShadow: '0 0 0 10px rgba(212,160,23,0)' },
              '100%': { boxShadow: '0 0 0 0 rgba(212,160,23,0)' },
            },
            'line-grow': {
              '0%':   { width: '0%' },
              '100%': { width: '100%' },
            },
          },
          animation: {
            'fade-up':      'fade-up 0.7s cubic-bezier(0.4,0,0.2,1) forwards',
            'fade-up-slow': 'fade-up 1s cubic-bezier(0.4,0,0.2,1) 0.2s forwards',
            'orb-float':    'orb-float 12s ease-in-out infinite',
            'orb-float-alt':'orb-float 16s ease-in-out 6s infinite',
            'pulse-ring':   'pulse-ring 2s ease-out infinite',
            'line-grow':    'line-grow 0.8s ease 0.5s forwards',
          },
          backdropBlur: { '2xl': '24px', '3xl': '40px' },
        }
      }
    }
  </script>

  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: #020f0a;
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* noise overlay */
    body::after {
      content: '';
      position: fixed; inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
      pointer-events: none; z-index: 0; opacity: 0.5;
    }

    /* scrollbar */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: #020f0a; }
    ::-webkit-scrollbar-thumb { background: #047857; border-radius: 3px; }

    /* card fade-up — starts invisible, Tailwind animation fills it */
    .auth-card { opacity: 0; }

    /* input autofill style fix */
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus {
      -webkit-box-shadow: 0 0 0 1000px #071c13 inset !important;
      -webkit-text-fill-color: #f0f9f4 !important;
      caret-color: #f0f9f4;
    }

    /* Gold shimmer button sweep */
    .btn-shimmer {
      background: linear-gradient(135deg, #92660a 0%, #d4a017 50%, #92660a 100%);
      background-size: 200% auto;
      transition: background-position 0.5s ease, transform 0.25s ease, box-shadow 0.25s ease;
    }
    .btn-shimmer:hover {
      background-position: right center;
      transform: translateY(-2px);
      box-shadow: 0 8px 32px rgba(180,134,11,0.55);
    }
    .btn-shimmer:active { transform: translateY(0); }

    /* Sweep highlight on btn */
    .btn-shimmer::before {
      content: '';
      position: absolute; top: 0; left: -100%;
      width: 100%; height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
      transition: left 0.55s ease;
    }
    .btn-shimmer:hover::before { left: 100%; }

    /* Input focus ring */
    .lux-input {
      background: rgba(2,15,10,0.8);
      border: 1px solid rgba(212,160,23,0.15);
      color: #f0f9f4;
      border-radius: 10px;
      padding: 13px 16px;
      width: 100%;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.9rem;
      outline: none;
      transition: border-color 0.3s, box-shadow 0.3s, background 0.3s;
    }
    .lux-input::placeholder { color: #6b9e88; }
    .lux-input:focus {
      border-color: #d4a017;
      background: rgba(2,15,10,0.95);
      box-shadow: 0 0 0 3px rgba(212,160,23,0.12), 0 0 20px rgba(212,160,23,0.07);
    }
    .lux-input.error { border-color: #f87171; }
    .lux-input.error:focus { box-shadow: 0 0 0 3px rgba(248,113,113,0.12); }

    /* Divider line animation */
    .gold-line {
      height: 1px;
      background: linear-gradient(90deg, transparent, #d4a017, transparent);
      width: 0%;
      animation: line-grow 0.8s ease 0.6s forwards;
    }

    /* Checkbox custom */
    .lux-check {
      appearance: none;
      width: 16px; height: 16px;
      border: 1px solid rgba(212,160,23,0.3);
      border-radius: 4px;
      background: rgba(2,15,10,0.8);
      cursor: pointer;
      position: relative;
      flex-shrink: 0;
      transition: border-color 0.25s, background 0.25s;
    }
    .lux-check:checked {
      background: linear-gradient(135deg, #065f46, #059669);
      border-color: #34d399;
    }
    .lux-check:checked::after {
      content: '✓';
      position: absolute; inset: 0;
      display: flex; align-items: center; justify-content: center;
      color: #f0f9f4; font-size: 10px; font-weight: 700;
    }
  </style>
</head>

<body class="relative">

  {{-- ── Ambient background ─────────────────────────────────── --}}
  <div class="fixed inset-0 z-0 pointer-events-none">
    {{-- Mesh gradient --}}
    <div class="absolute inset-0"
      style="background:
        radial-gradient(ellipse 75% 60% at 15% 5%, rgba(5,150,105,0.16) 0%, transparent 55%),
        radial-gradient(ellipse 55% 45% at 88% 95%, rgba(180,134,11,0.11) 0%, transparent 55%),
        radial-gradient(ellipse 40% 40% at 50% 50%, rgba(6,78,59,0.07) 0%, transparent 80%);
      ">
    </div>
    {{-- Orb 1 --}}
    <div class="absolute rounded-full pointer-events-none animate-orb-float"
      style="width:520px;height:520px;top:-120px;left:-120px;
        background:radial-gradient(circle, rgba(5,150,105,0.18) 0%, transparent 70%);
        filter:blur(60px);opacity:0.7;">
    </div>
    {{-- Orb 2 --}}
    <div class="absolute rounded-full pointer-events-none animate-orb-float-alt"
      style="width:420px;height:420px;bottom:-100px;right:-100px;
        background:radial-gradient(circle, rgba(180,134,11,0.13) 0%, transparent 70%);
        filter:blur(60px);opacity:0.6;">
    </div>
    {{-- Subtle grid lines --}}
    <div class="absolute inset-0 opacity-[0.025]"
      style="background-image:
        linear-gradient(rgba(212,160,23,0.5) 1px, transparent 1px),
        linear-gradient(90deg, rgba(212,160,23,0.5) 1px, transparent 1px);
        background-size: 64px 64px;">
    </div>
  </div>

  {{-- ── Page ───────────────────────────────────────────────── --}}
  <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">

      {{-- ── Brand mark ─────────────────────────────────────── --}}
      <div class="text-center mb-10 opacity-0 animate-fade-up" style="animation-delay:0.05s;">
        <a href="{{ url('/') }}" class="inline-flex flex-col items-center gap-3 group">
          <div class="relative">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl
              border animate-pulse-ring"
              style="background:linear-gradient(135deg,#065f46,#047857);
                border-color:rgba(212,160,23,0.45);
                box-shadow:0 0 24px rgba(180,134,11,0.25);">
              ✦
            </div>
          </div>
          <span class="font-accent text-xl tracking-widest"
            style="background:linear-gradient(135deg,#f0c040,#d4a017,#34d399);
              -webkit-background-clip:text;-webkit-text-fill-color:transparent;
              background-clip:text;">
            LUMINARY
          </span>
        </a>
        <p class="text-sm mt-2 tracking-widest uppercase"
          style="color:#6b9e88;letter-spacing:0.15em;font-size:0.7rem;">
          Knowledge. Curated.
        </p>
      </div>

      {{-- ── Glass card ──────────────────────────────────────── --}}
      <div class="auth-card animate-fade-up-slow rounded-3xl overflow-hidden relative"
        style="
          background: rgba(10,37,23,0.72);
          backdrop-filter: blur(28px) saturate(160%);
          -webkit-backdrop-filter: blur(28px) saturate(160%);
          border: 1px solid rgba(212,160,23,0.16);
          box-shadow: 0 24px 80px rgba(0,0,0,0.55),
                      0 0 0 1px rgba(255,255,255,0.03) inset,
                      0 1px 0 rgba(255,255,255,0.06) inset;
        ">

        {{-- Top gold accent line --}}
        <div style="height:2px;background:linear-gradient(90deg,transparent,#d4a017 40%,#34d399 60%,transparent);opacity:0.7;"></div>

        <div class="px-8 pt-9 pb-10">

          {{-- Heading --}}
          <div class="mb-8">
            <h1 class="font-display text-3xl font-semibold leading-tight"
              style="color:#f0f9f4;">
              Welcome <em class="italic"
                style="background:linear-gradient(135deg,#f0c040,#d4a017);
                  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
                  background-clip:text;">
                back
              </em>
            </h1>
            <p class="text-sm mt-1.5" style="color:#6b9e88;">
              Sign in to continue to your dashboard
            </p>
            <div class="gold-line mt-4"></div>
          </div>

          {{-- Session status --}}
          @if (session('status'))
            <div class="flex items-center gap-2 text-sm px-4 py-3 rounded-xl mb-5"
              style="background:rgba(5,150,105,0.12);border:1px solid rgba(52,211,153,0.22);color:#34d399;">
              <span>✦</span>
              <span>{{ session('status') }}</span>
            </div>
          @endif

          {{-- ── Form ──────────────────────────────────────── --}}
          <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
              <label for="email"
                class="block text-xs font-semibold uppercase tracking-widest mb-2"
                style="color:{{ $errors->has('email') ? '#f87171' : '#6b9e88' }};">
                Email Address
              </label>
              <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                autocomplete="username"
                autofocus
                required
                class="lux-input {{ $errors->has('email') ? 'error' : '' }}"
                placeholder="you@example.com"
              >
              @error('email')
                <p class="text-xs mt-1.5 flex items-center gap-1" style="color:#f87171;">
                  <span>⚠</span> {{ $message }}
                </p>
              @enderror
            </div>

            {{-- Password --}}
            <div>
              <div class="flex items-center justify-between mb-2">
                <label for="password"
                  class="block text-xs font-semibold uppercase tracking-widest"
                  style="color:{{ $errors->has('password') ? '#f87171' : '#6b9e88' }};">
                  Password
                </label>
                @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}"
                    class="text-xs transition-colors duration-200"
                    style="color:#d4a017;"
                    onmouseover="this.style.color='#f0c040'"
                    onmouseout="this.style.color='#d4a017'">
                    Forgot password?
                  </a>
                @endif
              </div>
              <div class="relative">
                <input
                  id="password"
                  type="password"
                  name="password"
                  autocomplete="current-password"
                  required
                  class="lux-input {{ $errors->has('password') ? 'error' : '' }}"
                  placeholder="••••••••••"
                >
                {{-- Toggle password visibility --}}
                <button type="button" id="togglePassword"
                  class="absolute right-3 top-1/2 -translate-y-1/2 transition-colors duration-200"
                  style="color:#6b9e88; background:none; border:none; cursor:pointer; font-size:1rem; padding:4px;"
                  onmouseover="this.style.color='#d4a017'"
                  onmouseout="this.style.color='#6b9e88'"
                  aria-label="Toggle password visibility">
                  👁
                </button>
              </div>
              @error('password')
                <p class="text-xs mt-1.5 flex items-center gap-1" style="color:#f87171;">
                  <span>⚠</span> {{ $message }}
                </p>
              @enderror
            </div>

            {{-- Remember me --}}
            <div class="flex items-center gap-3 pt-1">
              <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="lux-check"
              >
              <label for="remember_me"
                class="text-sm cursor-pointer select-none"
                style="color:#a7c5b5;">
                Keep me signed in
              </label>
            </div>

            {{-- Submit --}}
            <div class="pt-2">
              <button type="submit"
                class="btn-shimmer relative w-full overflow-hidden rounded-xl py-3.5
                  font-ui font-semibold text-sm tracking-widest uppercase
                  cursor-pointer border-0"
                style="color:#0a1a0d;
                  box-shadow:0 4px 24px rgba(180,134,11,0.28),
                    inset 0 1px 0 rgba(255,255,255,0.14);">
                Sign In to Luminary
              </button>
            </div>

          </form>

          {{-- Divider --}}
          <div class="flex items-center gap-4 my-7">
            <div class="flex-1" style="height:1px;background:linear-gradient(90deg,transparent,rgba(212,160,23,0.18));"></div>
            <span class="text-xs tracking-widest uppercase" style="color:#3a6e55;">New here?</span>
            <div class="flex-1" style="height:1px;background:linear-gradient(90deg,rgba(212,160,23,0.18),transparent);"></div>
          </div>

          {{-- Register link --}}
          @if (Route::has('register'))
            <a href="{{ route('register') }}"
              class="flex items-center justify-center gap-2 w-full rounded-xl py-3.5
                text-sm font-semibold tracking-wide uppercase transition-all duration-300"
              style="
                color:#34d399;
                border: 1px solid rgba(52,211,153,0.2);
                background: transparent;
              "
              onmouseover="this.style.background='rgba(52,211,153,0.07)';this.style.borderColor='rgba(52,211,153,0.4)'"
              onmouseout="this.style.background='transparent';this.style.borderColor='rgba(52,211,153,0.2)'">
              Create an Account
              <span style="font-size:0.8rem;">→</span>
            </a>
          @endif

        </div>

        {{-- Bottom accent --}}
        <div style="height:1px;background:linear-gradient(90deg,transparent,rgba(212,160,23,0.12),transparent);"></div>
        <div class="px-8 py-3 flex items-center justify-center" style="background:rgba(2,15,10,0.3);">
          <p class="text-xs tracking-widest" style="color:#3a6e55;font-size:0.65rem;letter-spacing:0.12em;">
            © {{ date('Y') }} LUMINARY · CRAFTED WITH ELEGANCE
          </p>
        </div>

      </div>{{-- /glass card --}}

    </div>
  </div>

  <script>
    // Password toggle
    document.getElementById('togglePassword')?.addEventListener('click', function () {
      var input = document.getElementById('password');
      input.type = input.type === 'password' ? 'text' : 'password';
      this.textContent = input.type === 'password' ? '👁' : '🙈';
    });

    // Trigger card animation
    document.querySelector('.auth-card').style.animationPlayState = 'running';
  </script>
</body>
</html>