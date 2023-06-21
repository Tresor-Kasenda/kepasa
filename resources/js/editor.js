import {ClassicEditor} from '@ckeditor/ckeditor5-editor-classic';

new ClassicEditor(document.querySelector('#description'), {
    toolbar: ['Bold', 'Italic', 'Underline', 'Link']
});
