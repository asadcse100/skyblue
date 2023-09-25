<script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
<script>
    (function($){
            "use strict";
            $(document).ready(function () {
                // Initialize Summernote editor
                $('.summernote').summernote({
                    height: 300,   // Set editable area's height
                    codemirror: { // Codemirror options
                        theme: 'monokai'
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            $(this).prev('input').val(contents);
                        }
                    },
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'hr']],
                        ['view', ['fullscreen', 'codeview']],
                        ['help', ['help']]
                    ],
                    buttons: {
                        codeBlock: function () {
                            // Add a code block template when the button is clicked
                            const codeBlockTemplate = '<pre><code>// Your code goes here</code></pre>';
                            $('.summernote').summernote('pasteHTML', codeBlockTemplate);
                        },
                    },
                });

                // Load content if multiple editors exist
                if ($('.summernote').length > 1) {
                    $('.summernote').each(function (index, value) {
                        $(this).summernote('code', $(this).data('content'));
                    });
                }
            });
        })(jQuery);
</script>
