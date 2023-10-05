<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>食べログ</title>
    {{--    dashboard css   --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">

    {{--    editor css  --}}
    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
    <link rel="stylesheet" href="https://nhn.github.io/tui.editor/latest/dist/cdn/theme/toastui-editor-dark.css">

</head>
<body>
    {{--    Diary追加Modal    --}}
    <div class="create-modal" id="createModal">
        <input type="text" name="" id="">
        <button class="modal-close-btn" id="modalCloseBtn">Close</button>
        {{--    Editor  --}}
        <div id="content"></div>
    </div>
    <div class="app">
        <div class="sidebar">
            <div class="user">
                <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2360&q=80" alt="user photo" class="user-photo">
                <div class="user-name">Alexander</div>
                <div class="user-mail">alexander@email.com</div>
            </div>
            <div class="sidebar-menu">
                <a href="#" class="sidebar-menu__link active">Dairy</a>
                <a href="#" class="sidebar-menu__link">통계</a>
                <a href="#" class="sidebar-menu__link">성분 검색</a>
                <a href="#" class="sidebar-menu__link">설정</a>
            </div>
            <button onclick="location.href='/auth/logout'">Log Out</button>
            {{--        <label class="toggle">--}}
            {{--            <input type="checkbox">--}}
            {{--            <span class="slider"></span>--}}
            {{--        </label>--}}
        </div>
        <div class="main">
            <div class="main-header">
                <div class="main-header__title">Diary</div>
                {{--            <div class="main-header__avatars">--}}
                {{--                <button class="add-button"><svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">--}}
                {{--                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>--}}
                {{--                    </svg></button>--}}
                {{--            </div>--}}

                {{--            버튼 아이콘 + -> 연필모양으로 변경 필요            --}}
                <button class="main-header__add" id="addBtn">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                    </svg>
                </button>
            </div>

            {{--        검색 기능 추가 필요         --}}
            <div class="main-content">
                <div class="card card-2 card-img"></div>
                <div class="card card-3 card-img"></div>
                <div class="card card-img card-1 card-main"></div>
                <div class="card card-4 card-img"></div>
                <div class="card card-img card-5"></div>
                <div class="card card-6 card-img"></div>
            </div>
        </div>
    </div>


<script  src="{{ asset('js/dashboard.js') }}"></script>
{{--    jquery  --}}
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>


{{--    editor js   --}}
<script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    async function uploadDiaryImage(formData) {
        try {
            return await axios.post('/diaries', formData, {
                // headers: {   }
            });
        } catch(err) {
            console.log(err);
        }
    }

    const editor = new toastui.Editor({
        el: document.querySelector('#content'), // 에디터를 적용할 요소 (컨테이너)
        height: '71vh',                        // 에디터 영역의 높이 값 (OOOpx || auto)
        initialEditType: 'markdown',            // 최초로 보여줄 에디터 타입 (markdown || wysiwyg)
        // initialValue: '내용을 입력해 주세요.',     // 내용의 초기 값으로, 반드시 마크다운 문자열 형태여야 함
        previewStyle: 'vertical',                // 마크다운 프리뷰 스타일 (tab || vertical),
        placeholder: '内容を入力してください。',
        // theme: 'dark',

        hooks: {
            async addImageBlobHook(blob, callback) {
                const formData = new FormData();
                formData.append("image", blob);

                try {
                    console.log('upload start');
                    const res = await uploadDiaryImage(formData);
                    console.log('response data:');
                    console.log(res);
                    callback(res.data.imageUrl, `image`);
                } catch (err) {
                    console.log(err);
                }
            }
        }
    });

    $('#addBtn').click(function() {
        const diaryAddModal = $('#createModal');

        if (diaryAddModal.css('visibility') === 'hidden') {
            diaryAddModal.css('z-index', '2');
            diaryAddModal.css('visibility', 'visible');
        } else {
            diaryAddModal.css('visibility', 'hidden');
            diaryAddModal.css('z-index', '-1');
        }
    });

    $('#modalCloseBtn').click(function () {
        const diaryAddModal = $('#createModal');

        if (diaryAddModal.css('visibility') === 'hidden') {
            diaryAddModal.css('visibility', 'visible');
            diaryAddModal.css('z-index', '2');
        } else {
            diaryAddModal.css('visibility', 'hidden');
            diaryAddModal.css('z-index', '-1');
        }
    });
</script>

</body>
</html>
