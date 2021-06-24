@push('scripts')
    <link rel="stylesheet" href="{{ asset('admin/plugins/sparksuite-simplemde-markdown-editor-6abda7a/dist/simplemde.min.css') }}">
    <script src="{{ asset('admin/plugins/sparksuite-simplemde-markdown-editor-6abda7a/dist/simplemde.min.js') }}"></script>
    <script>
        $('.editor').each(function (i, el) {
            var simplemde = new SimpleMDE({ element: el });
        })
    </script>

@endpush
