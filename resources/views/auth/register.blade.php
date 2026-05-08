{{-- ============================================================
     register.blade.php
     resources/views/auth/register.blade.php
     Laravel Breeze — Luminary Emerald & Gold Theme
     TailwindCSS CDN + inline custom styles
     ============================================================ --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account — Luminary</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500;600&family=Cinzel:wght@400;600&display=swap" rel="stylesheet">

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
              deep:    '#92660a',
              DEFAULT: '#b8860b',
              bright:  '#d4a017',
              light:   '#f0c040',
              shim:    '#fde68a',
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
            'orb-float': {
              '0%,100%': { transform: 'translate(0,0) scale(1)' },
              '50%':     { transform: 'translate(24px,16px) scale(1.05)' },
            },
            'orb-float-alt': {
              '0%,100%': { transform: 'translate(0,0) scale(1)' },
              '50%':     { transform: 'translate(-20px,24px) scale(1.04)' },
            },
            'pulse-ring': {
              '0%':   { boxShadow: '0 0 0 0 rgba(212,160,23,0.35)' },
              '70%':  { boxShadow: '0 0 0 10px rgba(212,160,23,0)' },
              '100%': { boxShadow: '0 0 0 0 rgba(212,160,23,0)' },
            },
            'strength-fill': {
              '0%':   { width: '0%' },
              '100%': { width: 'var(--target-width)' },
            },
          },
          animation: {
            'fade-up':       'fade-up 0.7s cubic-bezier(0.4,0,0.2,1) forwards',
            'fade-up-slow':  'fade-up 1s cubic-bezier(0.4,0,0.2,1) 0.15s forwards',
            'orb-float':     'orb-float 12s ease-in-out infinite',
            'orb-float-alt': 'orb-float-alt 15s ease-in-out 5s infinite',
            'pulse-ring':    'pulse-ring 2s ease-out infinite',
          },
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

    body::after {
      content: '';
      position: fixed; inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
      pointer-events: none; z-index: 0; opacity: 0.5;
    }

    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: #020f0a; }
    ::-webkit-scrollbar-thumb { background: #047857; border-radius: 3px; }

    .auth-card { opacity: 0; }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus {
      -webkit-box-shadow: 0 0 0 1000px #071c13 inset !important;
      -webkit-text-fill-color: #f0f9f4 !important;
      caret-color: #f0f9f4;
    }

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
    .btn-shimmer::before {
      content: '';
      position: absolute; top: 0; left: -100%;
      width: 100%; height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.18), transparent);
      transition: left 0.55s ease;
    }
    .btn-shimmer:hover::before { left: 100%; }

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

    /* Password strength bar */
    .strength-bar-track {
      height: 3px;
      background: rgba(255,255,255,0.06);
      border-radius: 99px;
      margin-top: 8px;
      overflow: hidden;
    }
    .strength-bar-fill {
      height: 100%;
      border-radius: 99px;
      width: 0%;
      transition: width 0.4s ease, background 0.4s ease;
    }

    /* Password requirements */
    .req-item {
      display: flex; align-items: center; gap: 6px;
      font-size: 0.72rem;
      transition: color 0.25s;
      color: #3a6e55;
    }
    .req-item.met { color: #34d399; }
    .req-item .req-icon { font-size: 0.65rem; width: 12px; text-align: center; }

    /* Field row for name --*/
    @media (min-width: 540px) {
      .field-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
    }
  </style>
</head>

<body class="relative">

  {{-- ── Ambient background ─────────────────────────────────── --}}
  <div class="fixed inset-0 z-0 pointer-events-none">
    <div class="absolute inset-0"
      style="background:
        radial-gradient(ellipse 70% 55% at 20% 8%, rgba(5,150,105,0.15) 0%, transparent 55%),
        radial-gradient(ellipse 60% 50% at 85% 90%, rgba(180,134,11,0.12) 0%, transparent 55%),
        radial-gradient(ellipse 35% 35% at 60% 40%, rgba(6,78,59,0.08) 0%, transparent 75%);
      ">
    </div>
    <div class="absolute rounded-full pointer-events-none animate-orb-float"
      style="width:560px;height:560px;top:-140px;right:-140px;
        background:radial-gradient(circle,rgba(5,150,105,0.15) 0%,transparent 70%);
        filter:blur(65px);opacity:0.65;">
    </div>
    <div class="absolute rounded-full pointer-events-none animate-orb-float-alt"
      style="width:440px;height:440px;bottom:-100px;left:-100px;
        background:radial-gradient(circle,rgba(180,134,11,0.12) 0%,transparent 70%);
        filter:blur(60px);opacity:0.55;">
    </div>
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
      <div class="text-center mb-8 opacity-0 animate-fade-up" style="animation-delay:0.05s;">
        <a href="{{ url('/') }}" class="inline-flex flex-col items-center gap-3 group">
          <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl
            border animate-pulse-ring"
            style="background:linear-gradient(135deg,#065f46,#047857);
              border-color:rgba(212,160,23,0.45);
              box-shadow:0 0 24px rgba(180,134,11,0.25);">
            ✦
          </div>
          <span class="font-accent text-xl tracking-widest"
            style="background:linear-gradient(135deg,#f0c040,#d4a017,#34d399);
              -webkit-background-clip:text;-webkit-text-fill-color:transparent;
              background-clip:text;">
            LUMINARY
          </span>
        </a>
        <p class="text-xs mt-2 tracking-widest uppercase" style="color:#6b9e88;letter-spacing:0.15em;">
          Begin your journey
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

        {{-- Top accent --}}
        <div style="height:2px;background:linear-gradient(90deg,transparent,#34d399 30%,#d4a017 70%,transparent);opacity:0.7;"></div>

        <div class="px-8 pt-9 pb-10">

          {{-- Heading --}}
          <div class="mb-7">
            <h1 class="font-display text-3xl font-semibold leading-tight" style="color:#f0f9f4;">
              Create your <em class="italic"
                style="background:linear-gradient(135deg,#f0c040,#d4a017);
                  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
                  background-clip:text;">
                account
              </em>
            </h1>
            <p class="text-sm mt-1.5" style="color:#6b9e88;">
              Join Luminary and start curating your stories
            </p>
            <div style="height:1px;background:linear-gradient(90deg,transparent,#d4a017,transparent);margin-top:1rem;opacity:0.4;"></div>
          </div>

          {{-- ── Form ──────────────────────────────────────── --}}
          <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            {{-- Name --}}
            <div>
              <label for="name"
                class="block text-xs font-semibold uppercase tracking-widest mb-2"
                style="color:{{ $errors->has('name') ? '#f87171' : '#6b9e88' }};">
                Full Name
              </label>
              <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                autocomplete="name"
                autofocus
                required
                class="lux-input {{ $errors->has('name') ? 'error' : '' }}"
                placeholder="Your full name"
              >
              @error('name')
                <p class="text-xs mt-1.5 flex items-center gap-1" style="color:#f87171;">
                  <span>⚠</span> {{ $message }}
                </p>
              @enderror
            </div>

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
              <label for="password"
                class="block text-xs font-semibold uppercase tracking-widest mb-2"
                style="color:{{ $errors->has('password') ? '#f87171' : '#6b9e88' }};">
                Password
              </label>
              <div class="relative">
                <input
                  id="password"
                  type="password"
                  name="password"
                  autocomplete="new-password"
                  required
                  class="lux-input {{ $errors->has('password') ? 'error' : '' }}"
                  placeholder="Min. 8 characters"
                  oninput="checkPasswordStrength(this.value)"
                >
                <button type="button" id="togglePassword"
                  class="absolute right-3 top-1/2 -translate-y-1/2 transition-colors duration-200"
                  style="color:#6b9e88;background:none;border:none;cursor:pointer;font-size:1rem;padding:4px;"
                  onmouseover="this.style.color='#d4a017'"
                  onmouseout="this.style.color='#6b9e88'">
                  👁
                </button>
              </div>

              {{-- Strength indicator --}}
              <div class="strength-bar-track">
                <div class="strength-bar-fill" id="strengthBar"></div>
              </div>
              <div class="flex items-center justify-between mt-1.5">
                <span id="strengthLabel" class="text-xs" style="color:#3a6e55;font-size:0.7rem;"></span>
              </div>

              {{-- Requirements checklist --}}
              <div class="grid grid-cols-2 gap-1.5 mt-3" id="reqList">
                <div class="req-item" id="req-len">
                  <span class="req-icon">○</span> 8+ characters
                </div>
                <div class="req-item" id="req-upper">
                  <span class="req-icon">○</span> Uppercase letter
                </div>
                <div class="req-item" id="req-num">
                  <span class="req-icon">○</span> Number
                </div>
                <div class="req-item" id="req-special">
                  <span class="req-icon">○</span> Special character
                </div>
              </div>

              @error('password')
                <p class="text-xs mt-2 flex items-center gap-1" style="color:#f87171;">
                  <span>⚠</span> {{ $message }}
                </p>
              @enderror
            </div>

            {{-- Confirm Password --}}
            <div>
              <label for="password_confirmation"
                class="block text-xs font-semibold uppercase tracking-widest mb-2"
                style="color:{{ $errors->has('password_confirmation') ? '#f87171' : '#6b9e88' }};">
                Confirm Password
              </label>
              <div class="relative">
                <input
                  id="password_confirmation"
                  type="password"
                  name="password_confirmation"
                  autocomplete="new-password"
                  required
                  class="lux-input {{ $errors->has('password_confirmation') ? 'error' : '' }}"
                  placeholder="Re-enter password"
                  oninput="checkPasswordMatch()"
                >
                <button type="button" id="toggleConfirm"
                  class="absolute right-3 top-1/2 -translate-y-1/2 transition-colors duration-200"
                  style="color:#6b9e88;background:none;border:none;cursor:pointer;font-size:1rem;padding:4px;"
                  onmouseover="this.style.color='#d4a017'"
                  onmouseout="this.style.color='#6b9e88'">
                  👁
                </button>
              </div>
              <p id="matchMsg" class="text-xs mt-1.5" style="display:none;"></p>
              @error('password_confirmation')
                <p class="text-xs mt-1.5 flex items-center gap-1" style="color:#f87171;">
                  <span>⚠</span> {{ $message }}
                </p>
              @enderror
            </div>

            {{-- Submit --}}
            <div class="pt-3">
              <button type="submit"
                class="btn-shimmer relative w-full overflow-hidden rounded-xl py-3.5
                  font-ui font-semibold text-sm tracking-widest uppercase cursor-pointer border-0"
                style="color:#0a1a0d;
                  box-shadow:0 4px 24px rgba(180,134,11,0.28),
                    inset 0 1px 0 rgba(255,255,255,0.14);">
                Create My Account
              </button>
            </div>

          </form>

          {{-- Divider --}}
          <div class="flex items-center gap-4 my-6">
            <div class="flex-1" style="height:1px;background:linear-gradient(90deg,transparent,rgba(212,160,23,0.18));"></div>
            <span class="text-xs tracking-widest uppercase" style="color:#3a6e55;">Have an account?</span>
            <div class="flex-1" style="height:1px;background:linear-gradient(90deg,rgba(212,160,23,0.18),transparent);"></div>
          </div>

          {{-- Login link --}}
          <a href="{{ route('login') }}"
            class="flex items-center justify-center gap-2 w-full rounded-xl py-3.5
              text-sm font-semibold tracking-wide uppercase transition-all duration-300"
            style="color:#d4a017;border:1px solid rgba(212,160,23,0.2);background:transparent;"
            onmouseover="this.style.background='rgba(212,160,23,0.07)';this.style.borderColor='rgba(212,160,23,0.4)'"
            onmouseout="this.style.background='transparent';this.style.borderColor='rgba(212,160,23,0.2)'">
            Sign In Instead
            <span style="font-size:0.8rem;">→</span>
          </a>

        </div>

        {{-- Bottom --}}
        <div style="height:1px;background:linear-gradient(90deg,transparent,rgba(212,160,23,0.12),transparent);"></div>
        <div class="px-8 py-3 flex items-center justify-center" style="background:rgba(2,15,10,0.3);">
          <p class="text-xs" style="color:#3a6e55;font-size:0.65rem;letter-spacing:0.12em;">
            © {{ date('Y') }} LUMINARY · CRAFTED WITH ELEGANCE
          </p>
        </div>

      </div>{{-- /glass card --}}

    </div>
  </div>

  <script>
    // ── Password strength ────────────────────────────────
    function checkPasswordStrength(val) {
      var bar   = document.getElementById('strengthBar');
      var label = document.getElementById('strengthLabel');
      var score = 0;

      var rules = {
        'req-len':     val.length >= 8,
        'req-upper':   /[A-Z]/.test(val),
        'req-num':     /[0-9]/.test(val),
        'req-special': /[^A-Za-z0-9]/.test(val),
      };

      Object.entries(rules).forEach(function([id, met]) {
        var el   = document.getElementById(id);
        var icon = el.querySelector('.req-icon');
        el.classList.toggle('met', met);
        icon.textContent = met ? '✓' : '○';
        if (met) score++;
      });

      var levels = [
        { w: '0%',   c: 'transparent',                   t: '' },
        { w: '25%',  c: '#f87171',                        t: 'Too weak' },
        { w: '50%',  c: '#fb923c',                        t: 'Fair' },
        { w: '75%',  c: '#facc15',                        t: 'Good' },
        { w: '100%', c: '#34d399',                        t: 'Strong ✦' },
      ];
      var lv = levels[score];
      bar.style.width      = lv.w;
      bar.style.background = lv.c;
      label.textContent    = lv.t;
      label.style.color    = lv.c;

      checkPasswordMatch();
    }

    // ── Password match ───────────────────────────────────
    function checkPasswordMatch() {
      var p1  = document.getElementById('password').value;
      var p2  = document.getElementById('password_confirmation').value;
      var msg = document.getElementById('matchMsg');
      var inp = document.getElementById('password_confirmation');

      if (!p2) { msg.style.display = 'none'; return; }

      if (p1 === p2) {
        msg.style.display = 'flex';
        msg.style.alignItems = 'center';
        msg.style.gap = '4px';
        msg.style.color = '#34d399';
        msg.textContent = '✓ Passwords match';
        inp.style.borderColor = '#34d399';
      } else {
        msg.style.display = 'flex';
        msg.style.alignItems = 'center';
        msg.style.gap = '4px';
        msg.style.color = '#f87171';
        msg.textContent = '⚠ Passwords do not match';
        inp.style.borderColor = '#f87171';
      }
    }

    // ── Toggle password visibility ───────────────────────
    document.getElementById('togglePassword')?.addEventListener('click', function () {
      var input = document.getElementById('password');
      input.type = input.type === 'password' ? 'text' : 'password';
      this.textContent = input.type === 'password' ? '👁' : '🙈';
    });

    document.getElementById('toggleConfirm')?.addEventListener('click', function () {
      var input = document.getElementById('password_confirmation');
      input.type = input.type === 'password' ? 'text' : 'password';
      this.textContent = input.type === 'password' ? '👁' : '🙈';
    });
  </script>
</body>
</html>