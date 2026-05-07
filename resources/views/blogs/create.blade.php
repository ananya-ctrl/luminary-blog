{{-- ============================================================
     create.blade.php
     Place in: resources/views/blogs/create.blade.php
     ============================================================ --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Post — Luminary Blog</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500;600&family=Cinzel:wght@400;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/luxury-blog.css') }}">
</head>
<body>

  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>

  {{-- ── NAVBAR ────────────────────────────────────────────── --}}
  <nav class="lux-nav">
    <a href="{{ url('/') }}" class="nav-brand">
      <div class="nav-brand-icon">✦</div>
      <span class="nav-brand-text">Luminary</span>
    </a>
    <ul class="nav-links" id="navLinks">
      <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li><a href="{{ route('blogs.create') }}" class="active">New Post</a></li>
    </ul>
    <div class="nav-user">
      <div class="nav-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
      <form method="POST" action="{{ route('logout') }}" style="margin:0;">
        @csrf
        <button type="submit" class="btn-lux btn-ghost btn-sm">Logout</button>
      </form>
      <button class="nav-toggler" id="navToggler">☰</button>
    </div>
  </nav>

  <div class="page-wrapper">

    {{-- Breadcrumb --}}
    <div class="breadcrumb-bar">
      <a href="{{ route('dashboard') }}">Dashboard</a>
      <span class="sep">›</span>
      <span class="current">New Post</span>
    </div>

    {{-- Page header --}}
    <header class="page-header">
      <h1 class="page-header-title">Publish a <em>New Story</em></h1>
      <p class="page-header-sub">Fill in the details below to create a new blog post.</p>
    </header>

    {{-- ── FORM ──────────────────────────────────────────── --}}
    <div class="form-panel">

      {{-- Validation errors --}}
      @if($errors->any())
        <div class="lux-alert lux-alert-error">
          <span>⚠</span>
          <div>
            <strong>Please fix the following:</strong>
            <ul style="margin:4px 0 0; padding-left:1.2em; font-size:0.8rem;">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      <form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- ── SECTION: Core Details ───────────────────────── --}}
        <div class="form-section">
          <div class="form-section-title">✦ Post Details</div>

          {{-- Title --}}
          <div class="field-group">
            <label class="field-label" for="titleInput">Post Title <span style="color:#f87171;">*</span></label>
            <input
              type="text"
              id="titleInput"
              name="title"
              class="field-input @error('title') is-invalid @enderror"
              placeholder="Enter an engaging headline…"
              value="{{ old('title') }}"
              required
            >
            @error('title')<span class="error-text">{{ $message }}</span>@enderror
          </div>

          {{-- Slug --}}
          <div class="field-group">
            <label class="field-label" for="slugInput">
              Slug
              <span style="font-weight:400; text-transform:none; font-size:0.7rem; color:var(--text-muted); margin-left:6px;">(auto-filled from title)</span>
            </label>
            <input
              type="text"
              id="slugInput"
              name="slug"
              class="field-input @error('slug') is-invalid @enderror"
              placeholder="post-url-slug"
              value="{{ old('slug') }}"
            >
            @error('slug')<span class="error-text">{{ $message }}</span>@enderror
          </div>

          {{-- Category + Publish Date --}}
          <div class="field-row">
            <div class="field-group">
              <label class="field-label" for="categoryInput">Category <span style="color:#f87171;">*</span></label>
              <select
                id="categoryInput"
                name="category"
                class="field-input @error('category') is-invalid @enderror"
                required
              >
                <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select category…</option>
                @foreach(['Latest Jobs','Results','Admit Card','Answer Key'] as $cat)
                  <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
              </select>
              @error('category')<span class="error-text">{{ $message }}</span>@enderror
            </div>

            <div class="field-group">
              <label class="field-label" for="publishDate">Publish Date <span style="color:#f87171;">*</span></label>
              <input
                type="date"
                id="publishDate"
                name="publish_date"
                class="field-input @error('publish_date') is-invalid @enderror"
                value="{{ old('publish_date', date('Y-m-d')) }}"
                required
              >
              @error('publish_date')<span class="error-text">{{ $message }}</span>@enderror
            </div>
          </div>

          {{-- Short Description --}}
          <div class="field-group">
            <label class="field-label" for="shortDesc">Short Description <span style="color:#f87171;">*</span></label>
            <textarea
              id="shortDesc"
              name="short_description"
              class="field-input @error('short_description') is-invalid @enderror"
              placeholder="Write a compelling summary (shown in preview cards)…"
              rows="3"
              required
            >{{ old('short_description') }}</textarea>
            @error('short_description')<span class="error-text">{{ $message }}</span>@enderror
          </div>
        </div>

        {{-- ── SECTION: Content ────────────────────────────── --}}
        <div class="form-section">
          <div class="form-section-title">✦ Article Content</div>
          <div class="field-group">
            <label class="field-label">Full Content <span style="color:#f87171;">*</span></label>
            <div class="ckeditor-wrapper">
              <textarea
                id="content"
                name="content"
                class="field-input @error('content') is-invalid @enderror"
              >{{ old('content') }}</textarea>
            </div>
            @error('content')<span class="error-text">{{ $message }}</span>@enderror
          </div>
        </div>

        {{-- ── SECTION: Cover Image ─────────────────────────── --}}
        <div class="form-section">
          <div class="form-section-title">✦ Cover Image</div>
          <div class="field-group">
            <label class="field-label">Upload Image</label>

            <div class="upload-zone" id="uploadZone">
              <div class="upload-zone-icon">🖼</div>
              <div class="upload-zone-text">
                <strong>Click to upload</strong> or drag & drop<br>
                <span style="font-size:0.75rem; opacity:0.7;">PNG, JPG, WEBP up to 5MB</span>
              </div>
            </div>

            <input
              type="file"
              id="imageInput"
              name="image"
              accept="image/*"
              style="display:none;"
            >
            <img id="imagePreview" src="" alt="Preview">
            @error('image')<span class="error-text">{{ $message }}</span>@enderror
          </div>
        </div>

        {{-- ── FORM ACTIONS ─────────────────────────────────── --}}
        <div class="form-actions">
          <button type="submit" class="btn-lux btn-gold">
            ✦ Publish Post
          </button>
          <a href="{{ route('dashboard') }}" class="btn-lux btn-ghost">
            Cancel
          </a>
        </div>

      </form>
    </div>

  </div>{{-- /page-wrapper --}}

  <footer class="lux-footer">
    <p>© {{ date('Y') }} <span>Luminary Blog</span></p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  {{-- CKEditor 5 --}}
  <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
  <script>
    ClassicEditor
      .create(document.querySelector('#content'), {
        toolbar: {
          items: [
            'heading', '|',
            'bold', 'italic', 'underline', 'strikethrough', '|',
            'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
            'insertTable', 'imageInsert', '|',
            'outdent', 'indent', '|',
            'undo', 'redo'
          ]
        },
        placeholder: 'Begin writing your story here…',
        table: {
          contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
        }
      })
      .then(function(editor) {
        // Expose to global for form submit
        window.contentEditor = editor;
      })
      .catch(function(error) {
        console.error('CKEditor error:', error);
      });
  </script>

  <script src="{{ asset('js/luxury-blog.js') }}"></script>
</body>
</html>
