<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo editor</title>

    <script src="https://cdn.tiny.cloud/1/apib7xcg6bpbohpnx8gx9urjphyzuohx0aiyx9ztfhhf1wuy/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
tinymce.init({
    selector: 'textarea',
    plugins: [
      // Core editing features
      'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',

    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
  });
  </script>

</head>
<body>

    <form action="ejemploeditorpost" method="post">
        @csrf

        <input type="hidden" name="contenido" id="contenido">

        <textarea id="editor" >{{$contenido}}</textarea><br />

        <input type="submit" value="Probar"><br />

    </form>


    <script>

        // Obtener el contenido del editor al enviar el formulario
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();
            document.getElementById('contenido').value = tinymce.activeEditor.getContent();
            console.log("dice: "+tinymce.activeEditor.getContent());
            this.submit();
        });
    </script>
</body>
</html>
