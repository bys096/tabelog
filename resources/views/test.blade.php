<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('dist/css/tailwind.css') }}">

    <title>Document</title>
    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor-viewer.css">

</head>
<body>
<div id="viewer"></div>

<script src="https://uicdn.toast.com/editor/latest/toastui-editor-viewer.js"></script>
<script>
    const viewer = new toastui.EditorViewer({
        el: document.querySelector('#viewer'),
        initialValue: '# Hello Toast UI Viewer'
    });

</script>
</body>
</html>
