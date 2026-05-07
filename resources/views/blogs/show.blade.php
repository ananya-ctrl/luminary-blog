{{-- ============================================================
     show.blade.php
     Place in: resources/views/blogs/show.blade.php
     Uses $blog variable from controller
     ============================================================ --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $blog->title }} — Luminary Blog</title>
  <meta name="description" content="{{ $blog->short_description }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500;600&family=Cinzel:wght@400;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/luxury-blog.css') }}">

  <style>
    /* Reading progress bar */
    #readingProgress {
      position: fixed;
      top: 0; left: 0;
      height: 2px;
      width: 0%;
      background: linear-gradient(90deg, var(--em-600), var(--gold-bright));
      z-index: 9999;
      transition: width 0.1s linear;
    }
  </style>
</head>
<body>

  <div id="readingProgress"></div>

  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>

  {{-- ── NAVBAR ────────────────────────────────────────────── --}}
  <nav class="lux-nav">
    <a href="{{ url('/') }}" class="nav-brand">
      <div class="nav-brand-icon">✦</div>
      <span class="nav-brand-text">Luminary</span>
    </a>
    <ul class="nav-links" id="navLinks">
      <li><a href="{{ route('blogs.index') }}">Dashboard</a></li>
      <li><a href="{{ route('blogs.create') }}">New Post</a></li>
    </ul>
    <div class="nav-user">
      <div class="nav-avatar">
        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
      </div>
      <form method="POST" action="{{ route('logout') }}" style="margin:0;">
        @csrf
        <button type="submit" class="btn-lux btn-ghost btn-sm">Logout</button>
      </form>
      <button class="nav-toggler" id="navToggler">☰</button>
    </div>
  </nav>

  <div class="page-wrapper">

    {{-- ── BREADCRUMB ────────────────────────────────────── --}}
    <div class="breadcrumb-bar">
      <a href="{{ route('blogs.index') }}">Dashboard</a>
      <span class="sep">›</span>
      <a href="{{ route('blogs.index') }}?category={{ urlencode($blog->category) }}">{{ $blog->category }}</a>
      <span class="sep">›</span>
      <span class="current">{{ Str::limit($blog->title, 40) }}</span>
    </div>

    {{-- ── HERO ──────────────────────────────────────────── --}}
    <div class="blog-hero">
      @if($blog->image)
        <img
          src="{{ asset('uploads/' . $blog->image) }}"
          alt="{{ $blog->title }}"
          class="blog-hero-img"
        >
      @else
        <div style="width:100%;height:100%;background:linear-gradient(135deg,var(--em-900),var(--dark-panel));display:flex;align-items:center;justify-content:center;font-size:5rem;opacity:0.15;">✦</div>
      @endif
      <div class="blog-hero-overlay"></div>
      <div class="blog-hero-content">
        <div class="blog-hero-category">◆ {{ $blog->category }}</div>
        <h1 class="blog-hero-title">{{ $blog->title }}</h1>
        <div class="blog-hero-meta">
          <span>{{ \Carbon\Carbon::parse($blog->publish_date)->format('F j, Y') }}</span>
          <span>·</span>
          <span>{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read</span>
        </div>
      </div>
    </div>

    {{-- ── ARTICLE ────────────────────────────────────────── --}}
    <article class="blog-article">

      {{-- Short description / lead --}}
      @if($blog->short_description)
        <p style="
          font-family: var(--font-display);
          font-size: 1.25rem;
          font-style: italic;
          color: var(--em-400);
          border-left: 3px solid var(--gold-bright);
          padding: 0.8em 1.2em;
          margin-bottom: 2.5rem;
          background: rgba(212,160,23,0.05);
          border-radius: 0 10px 10px 0;
          font-weight: 300;
          line-height: 1.6;
        ">{{ $blog->short_description }}</p>
      @endif

      {{-- Full content (CKEditor HTML) --}}
      <div class="blog-article-content">
        {!! $blog->content !!}
      </div>

      {{-- ── ARTICLE FOOTER ─────────────────────────────── --}}
      <div style="
        margin-top: 4rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(212,160,23,0.12);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
      ">
        <a href="{{ route('blogs.index') }}" class="btn-lux btn-ghost">
          ← Back to Dashboard
        </a>
        <div style="display:flex; gap:10px;">
          <a href="{{ route('blogs.edit', $blog->id) }}" class="btn-lux btn-em btn-sm">
            Edit Post
          </a>
          <button
            class="btn-lux btn-danger-lux btn-sm btn-delete-trigger"
            data-action="data-action="/blogs/{{ $blog->id }}/delete""
          >
            Delete
          </button>
        </div>
      </div>

    </article>

  </div>{{-- /page-wrapper --}}

  {{-- ── DELETE MODAL ──────────────────────────────────────── --}}
  <div class="modal-backdrop" id="deleteModal">
    <div class="modal-box">
      <div class="modal-icon">🗑</div>
      <h3 class="modal-title">Delete this post?</h3>
      <p class="modal-sub">This action cannot be undone. The post will be permanently removed.</p>
      <div class="modal-actions">
        <button class="btn-lux btn-ghost" id="deleteCancel">Cancel</button>
        <button class="btn-lux btn-danger-lux" id="deleteConfirm">Yes, Delete</button>
      </div>
    </div>
  </div>
  <form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
  </form>

  <footer class="lux-footer">
    <p>© {{ date('Y') }} <span>Luminary Blog</span> — Crafted with elegance</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="{{ asset('js/luxury-blog.js') }}"></script>
  <script>
    // Reading progress bar
    window.addEventListener('scroll', function () {
      var scrolled = window.scrollY;
      var total = document.documentElement.scrollHeight - window.innerHeight;
      var pct = total > 0 ? (scrolled / total) * 100 : 0;
      document.getElementById('readingProgress').style.width = pct + '%';
    });
  </script>
</body>
</html>
