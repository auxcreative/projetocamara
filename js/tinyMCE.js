/**
 * @author Elesbao
 */

tinymce.init({
  selector: 'textarea[name="p#texto"]',
  height: 500,
  menubar: false,
  spellchecker_language: 'pt_BR',
  
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_css: '//www.tinymce.com/css/codepen.min.css'
});