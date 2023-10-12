<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('dist/css/tailwind.css') }}">

    <title>Document</title>
    <style>
        .top-100 {top: 100%}
        .bottom-100 {bottom: 100%}
        .max-h-select {
            max-height: 300px;
        }
    </style>
</head>
<body>

<input type="text" />
<button onclick="addToArray()">Add to Array</button>
<ul id="list">
{{--    @foreach($list as $item)--}}
{{--        <li>{{ $item }}</li>--}}
{{--    @endforeach--}}
</ul>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    let a = [];

    // a.push('New Item');  // 예를 들면 'New Item'을 추가합니다. 원하는 값으로 변경 가능합니다.
    // renderList();
    function addToArray() {
        let n = 1;
        a.push(n);
        n += 1;
        axios.get('{{ route('test') }}', a).then(function (response) {
            console.log(response)
        });
    }

    function renderList() {
        const listElement = document.getElementById('list');
        listElement.innerHTML = '';  // 기존 항목들을 지웁니다.

        for (let item of a) {
            const li = document.createElement('li');
            li.textContent = item;
            listElement.appendChild(li);
        }
    }
</script>
</body>
</html>
