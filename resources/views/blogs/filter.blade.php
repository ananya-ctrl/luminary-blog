@foreach($blogs as $blog)

    <div class="border p-4 mb-4 rounded">

        <h2 class="text-2xl font-bold">
            {{ $blog->title }}
        </h2>

        <p class="text-gray-500">
            {{ $blog->category }}
        </p>

        <p class="mt-2">
            {{ $blog->short_description }}
        </p>

        <a href="/blogs/{{ $blog->slug }}"
           class="btn btn-primary mt-3">
            Read More
        </a>

        <a href="/blogs/{{ $blog->id }}/edit"
           class="btn btn-warning mt-3">
            Edit
        </a>

        <form action="/blogs/{{ $blog->id }}/delete"
              method="POST"
              style="display:inline;">

            @csrf

            <button type="submit"
                    class="btn btn-danger mt-3">
                Delete
            </button>

        </form>

    </div>

@endforeach