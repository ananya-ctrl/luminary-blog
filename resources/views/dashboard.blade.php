{{-- ============================================================
     dashboard.blade.php
     Place in: resources/views/blogs/dashboard.blade.php
     ============================================================ --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard — Luminary Blog</title>

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500;600&family=Cinzel:wght@400;600&display=swap" rel="stylesheet">

  {{-- Luxury Blog CSS --}}
  <link rel="stylesheet" href="{{ asset('css/luxury-blog.css') }}">
</head>
<body>

  {{-- Decorative orbs --}}
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>

  {{-- ── NAVBAR ────────────────────────────────────────────── --}}
  <nav class="lux-nav">
    <a href="{{ url('/') }}" class="nav-brand">
      <div class="nav-brand-icon">✦</div>
      <span class="nav-brand-text">Luminary</span>
    </a>

    <ul class="nav-links" id="navLinks">
      <li><a href="{{ route('dashboard') }}" class="active">Dashboard</a></li>
      <li><a href="{{ route('blogs.create') }}">New Post</a></li>
    </ul>

    <div class="nav-user">
      <a href="{{ route('blogs.create') }}" class="btn-lux btn-gold" style="display:none;" id="navAddBtn">
        <svg width="13" height="13" viewBox="0 0 14 14" fill="currentColor"><path d="M7 1v12M1 7h12"/></svg>
        New Post
      </a>
      <div class="nav-avatar" title="{{ auth()->user()->name ?? 'User' }}">
        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
      </div>
      <form method="POST" action="{{ route('logout') }}" style="margin:0;">
        @csrf
        <button type="submit" class="btn-lux btn-ghost btn-sm">Logout</button>
      </form>
      <button class="nav-toggler" id="navToggler" aria-label="Toggle menu">☰</button>
    </div>
  </nav>

  <div class="page-wrapper">

    {{-- ── FLASH MESSAGES ────────────────────────────────── --}}
    @if(session('success'))
      <div style="padding: 1rem 2rem 0;">
        <div class="lux-alert lux-alert-success">
          <span>✦</span> {{ session('success') }}
        </div>
      </div>
    @endif
    @if(session('error'))
      <div style="padding: 1rem 2rem 0;">
        <div class="lux-alert lux-alert-error">
          <span>⚠</span> {{ session('error') }}
        </div>
      </div>
    @endif

    {{-- ── PAGE HEADER ───────────────────────────────────── --}}
    <header class="page-header">
      <div style="display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:1rem;">
        <div>
          <h1 class="page-header-title">The <em>Gazette</em></h1>
          <p class="page-header-sub">Curating knowledge, one story at a time</p>
        </div>
        <a href="{{ route('blogs.create') }}" class="btn-lux btn-gold">
          <svg width="13" height="13" viewBox="0 0 14 14" fill="currentColor"><path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
          Publish New Post
        </a>
      </div>
    </header>

    {{-- ── FILTER BAR ────────────────────────────────────── --}}
    <div class="filter-bar">
      <span class="filter-label">Filter by</span>
      <select id="categoryFilter" class="lux-select">
        <option value="">All Categories</option>
        <option value="Latest Jobs">Latest Jobs</option>
        <option value="Results">Results</option>
        <option value="Admit Card">Admit Card</option>
        <option value="Answer Key">Answer Key</option>
      </select>
      <span class="filter-label" id="resultCount" style="margin-left:auto; color: var(--text-muted);">
        {{ $blogs->count() }} {{ Str::plural('post', $blogs->count()) }}
      </span>
    </div>

    {{-- ── BLOG GRID ─────────────────────────────────────── --}}
    <main id="blog-data">
      @if($blogs->isEmpty())
        <div class="empty-state">
          <div class="empty-state-icon">✦</div>
          <p class="empty-state-title">No stories yet</p>
          <p class="empty-state-sub">Begin by publishing your first post.</p>
          <a href="{{ route('blogs.create') }}" class="btn-lux btn-gold" style="margin-top:1.5rem; display:inline-flex;">
            Write Something
          </a>
        </div>
      @else
        <div class="blog-grid">
          @foreach($blogs as $blog)
            <article class="blog-card">

              {{-- Image --}}
              @if($blog->image)
                <div style="overflow:hidden;">
                  <img
                    src="{{ asset('uploads/' . $blog->image) }}"
                    alt="{{ $blog->title }}"
                    class="blog-card-img"
                    loading="lazy"
                  >
                </div>
              @else
                <div class="blog-card-img-placeholder">✦</div>
              @endif

              {{-- Body --}}
              <div class="blog-card-body">
                {{-- Category badge --}}
                <div class="blog-card-category">{{ $blog->category }}</div>

                {{-- Title --}}
                <h2 class="blog-card-title">{{ $blog->title }}</h2>

                {{-- Short description --}}
                <p class="blog-card-desc">{{ $blog->short_description }}</p>

                {{-- Meta --}}
                <div class="blog-card-meta">
                  <span>{{ \Carbon\Carbon::parse($blog->publish_date)->format('M j, Y') }}</span>
                  <span class="blog-card-meta-dot">◆</span>
                  <span>{{ str_word_count(strip_tags($blog->content)) }} words</span>
                </div>

                {{-- Actions --}}
                <div class="blog-card-actions">
                  <a href="{{ route('blogs.show', $blog->slug) }}" class="btn-lux btn-em btn-sm">
                    Read More
                  </a>
                  <a href="{{ route('blogs.edit', $blog->id) }}" class="btn-lux btn-ghost btn-sm">
                    Edit
                  </a>
                  <button
                    class="btn-lux btn-danger-lux btn-sm btn-delete-trigger"
                    data-action="/blogs/{{ $blog->id }}/delete"
                  >
                    Delete
                  </button>
                </div>
              </div>

            </article>
          @endforeach
        </div>
      @endif
    </main>

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

  {{-- Hidden delete form --}}
  <form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
  </form>

  {{-- ── FOOTER ────────────────────────────────────────────── --}}
  <footer class="lux-footer">
    <p>© {{ date('Y') }} <span>Luminary Blog</span> — Founded by Ananya Jain ✨ | ananyajain2103@gmail.com</p>
  </footer>

  {{-- Scripts --}}
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="{{ asset('js/luxury-blog.js') }}"></script>

  {{-- Show nav add btn on desktop --}}
  <script>
    if (window.innerWidth >= 768) {
      document.getElementById('navAddBtn').style.display = 'inline-flex';
    }
  </script>
</body>
</html>
