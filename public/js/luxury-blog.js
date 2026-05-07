/**
 * luxury-blog.js
 * Place in: public/js/luxury-blog.js
 * Requires jQuery (already used by your project)
 */

$(function () {

  /* ── Navbar toggle (mobile) ─────────────────────────── */
  $('#navToggler').on('click', function () {
    $('#navLinks').toggleClass('open');
  });

  /* ── Page entrance animation ────────────────────────── */
  requestAnimationFrame(function () {
    document.querySelectorAll('.blog-card').forEach(function (el, i) {
      el.style.opacity = '0';
      el.style.transform = 'translateY(24px)';
      setTimeout(function () {
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        el.style.opacity = '1';
        el.style.transform = 'translateY(0)';
      }, 60 + i * 55);
    });
  });

  /* ── Category AJAX filter ────────────────────────────── */
  $('#categoryFilter').on('change', function () {
    var category = $(this).val();
    var container = $('#blog-data');

    container.html('<div class="lux-spinner"></div>');

    $.ajax({
      url: '/blogs/filter',
      method: 'GET',
      data: { category: category },
      success: function (response) {
        container.html(response);
        // Re-animate new cards
        requestAnimationFrame(function () {
          container.find('.blog-card').each(function (i) {
            var el = this;
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            setTimeout(function () {
              el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
              el.style.opacity = '1';
              el.style.transform = 'translateY(0)';
            }, 40 + i * 50);
          });
        });
      },
      error: function () {
        container.html(
          '<div class="empty-state">' +
          '<div class="empty-state-icon">⚡</div>' +
          '<p class="empty-state-title">Something went wrong</p>' +
          '<p class="empty-state-sub">Please try again.</p>' +
          '</div>'
        );
      }
    });
  });

  /* ── Delete confirmation modal ───────────────────────── */
  var deleteFormAction = '';

  $(document).on('click', '.btn-delete-trigger', function (e) {
    e.preventDefault();
    deleteFormAction = $(this).data('action');
    $('#deleteModal').addClass('open');
  });

  $('#deleteCancel').on('click', function () {
    $('#deleteModal').removeClass('open');
  });

  $('#deleteModal').on('click', function (e) {
    if (e.target === this) $(this).removeClass('open');
  });

  $('#deleteConfirm').on('click', function () {
    if (deleteFormAction) {
      $('#deleteForm').attr('action', deleteFormAction).submit();
    }
  });

  /* ── Image preview on upload ─────────────────────────── */
  var imageInput = document.getElementById('imageInput');
  var imagePreview = document.getElementById('imagePreview');
  var uploadZone = document.getElementById('uploadZone');

  if (imageInput) {
    imageInput.addEventListener('change', function () {
      var file = this.files[0];
      if (file && file.type.startsWith('image/')) {
        var reader = new FileReader();
        reader.onload = function (e) {
          imagePreview.src = e.target.result;
          imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      }
    });
  }

  if (uploadZone) {
    uploadZone.addEventListener('click', function () {
      if (imageInput) imageInput.click();
    });
    uploadZone.addEventListener('dragover', function (e) {
      e.preventDefault();
      this.classList.add('dragover');
    });
    uploadZone.addEventListener('dragleave', function () {
      this.classList.remove('dragover');
    });
    uploadZone.addEventListener('drop', function (e) {
      e.preventDefault();
      this.classList.remove('dragover');
      if (imageInput && e.dataTransfer.files.length) {
        imageInput.files = e.dataTransfer.files;
        $(imageInput).trigger('change');
      }
    });
  }

  /* ── Auto-generate slug from title ──────────────────── */
  var titleInput = document.getElementById('titleInput');
  var slugInput = document.getElementById('slugInput');
  var slugEdited = false;

  if (slugInput) {
    slugInput.addEventListener('input', function () { slugEdited = true; });
  }

  if (titleInput && slugInput) {
    titleInput.addEventListener('input', function () {
      if (!slugEdited) {
        var slug = this.value
          .toLowerCase()
          .replace(/[^\w\s-]/g, '')
          .replace(/\s+/g, '-')
          .replace(/-+/g, '-')
          .trim();
        slugInput.value = slug;
      }
    });
  }

  /* ── Flash alert auto-dismiss ────────────────────────── */
  setTimeout(function () {
    $('.lux-alert').fadeOut(600);
  }, 4000);

});
