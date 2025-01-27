<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor</title>
    <script src="https://cdn.tiny.cloud/1/apib7xcg6bpbohpnx8gx9urjphyzuohx0aiyx9ztfhhf1wuy/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#editor', // Asegúrate de que esto coincida con el ID del textarea
            plugins: [
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>
</head>
<body>

    <form action="/editor" method="post">
        @csrf
        <input type="hidden" name="contenido" id="contenido">
        <input type="hidden" name="file_type" value="{{ session('file_type') }}">
        <textarea id="editor"></textarea><br /> <!-- Aquí se carga el contenido -->
        <input type="submit" value="Guardar"><br />
    </form>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();
            document.getElementById('contenido').value = tinymce.activeEditor.getContent();
            this.submit();
        });
    </script>
</body>
</html>
