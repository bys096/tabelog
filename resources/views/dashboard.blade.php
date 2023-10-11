@extends('footer')

@section('style')
    {{--    dashboard css   --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    {{--    editor css  --}}
    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
    <link rel="stylesheet" href="https://nhn.github.io/tui.editor/latest/dist/cdn/theme/toastui-editor-dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


@endsection

@section('content')
    {{--    Diary追加Modal    --}}
    <div class="create-modal" id="createModal">
        <div x-data="select" class="relative w-[30rem]" @click.outside="open = false">
            <button @click="toggle" :class="(open) && 'ring-blue-600'" class="flex w-full items-center justify-between rounded bg-white p-2 ring-1 ring-gray-300">
                <span x-text="(meal == '') ? 'Choose meal-time' : meal"></span>
                <i class="fas fa-chevron-down text-xl"></i>
            </button>

            <ul class="z-2 absolute mt-1 w-full rounded bg-gray-50 ring-1 ring-gray-300" x-show="open">
                <li class="cursor-pointer select-none p-2 hover:bg-gray-200" @click="setMeal('breakfast')">BreakFast</li>
                <li class="cursor-pointer select-none p-2 hover:bg-gray-200" @click="setMeal('lunch')">Lunch</li>
                <li class="cursor-pointer select-none p-2 hover:bg-gray-200" @click="setMeal('dinner')">Dinner</li>
                <li class="cursor-pointer select-none p-2 hover:bg-gray-200" @click="setMeal('dessert')">Dessert</li>
            </ul>
        </div>
        <input type="hidden" name="meal_time" id="meal_time" value="">



        <div class="">
            <label for="date" class="block text-sm text-gray-500 dark:text-gray-300">Date</label>
            <input type="date" id="date" placeholder="John Doe" class="block  mt-2 w-full placeholder-gray-400/70 dark:placeholder-gray-500 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />
        </div>
        <button class="modal-close-btn" id="modalCloseBtn">Close</button>
        {{--    Editor  --}}
        <div id="content"></div>
        <div class="btn-group">
            <div class="flex justify-end overflow-hidden bg-white border divide-x rounded-lg rtl:flex-row-reverse dark:bg-gray-900 dark:border-gray-700 dark:divide-gray-700">
                <button class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 transition-colors duration-200 sm:text-base sm:px-6 dark:hover:bg-gray-800 dark:text-gray-300 gap-x-3 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>

                    <span>Cancel</span>
                </button>

                <button class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 transition-colors duration-200 sm:text-base sm:px-6 dark:hover:bg-gray-800 dark:text-gray-300 gap-x-3 hover:bg-gray-100"
                        id="diary-save-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>
                    <span>Save</span>
                </button>
            </div>
        </div>
    </div>
    <div id="app-container">
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
    </div>
@endsection

@section('script')


    {{--    diary modal: SELECT   --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script  src="{{ asset('js/dashboard.js') }}"></script>
    {{--    jquery  --}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>


    {{--    editor js   --}}
    <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        async function uploadDiaryImage(formData) {
            try {
                return await axios.post('/diaries/image', formData, {
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
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
                    // formData.append("_method", "PATCH");
                    console.log(formData);

                    try {
                        console.log('upload start');
                        const res = await uploadDiaryImage(formData);
                        // const res = axios.patch('/diaries/saveImage', {
                        //     image: blob
                        // });

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

        $('#diary-save-btn').click(async function () {
            console.log('click');

            console.log(editor.getMarkdown());
            // console.log(typeof(editor.getMarkdown()));
            const data = {
                content: editor.getMarkdown(),
                meal_time: $('#meal_time').val(),
                date: $('#date').val()
            };
            console.log(data);

            try {
                const response = await axios.post(`/diaries`, data);
                console.log(response);
            } catch(e) {
                console.log(e);
            }
        });

        document.addEventListener("alpine:init", () => {
            Alpine.data("select", () => ({
                open: false,
                meal: "",

                toggle() {
                    this.open = !this.open;
                },

                setMeal(val) {
                    this.meal = val;
                    this.open = false;
                    this.getSelectedValue();
                },

                getSelectedValue() {
                    document.getElementById('meal_time').value = this.meal;
                    console.log(document.getElementById('meal_time').value);
                },
            }));
        });
    </script>
@endsection
