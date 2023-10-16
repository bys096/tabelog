@extends('footer')

@section('style')
    {{--    dashboard css   --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    {{--    editor css  --}}
    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
    <link rel="stylesheet" href="https://nhn.github.io/tui.editor/latest/dist/cdn/theme/toastui-editor-dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/showdown@2.0.1/dist/showdown.min.js"></script>

    <style>
        .top-100 {top: 100%}
        .bottom-100 {bottom: 100%}
        .max-h-select {
            max-height: 300px;
        }
        .main-content .toastui-editor-toolbar {
            display: none;
        }
    </style>
@endsection

@section('content')
    {{--    Diary追加Modal    --}}
    <div class="modal-container">
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

            <div class="hash-tags">
                {{--    badge   --}}
                <div id="badges-container">

                </div>

                {{--    HashTags Input    --}}
                <div class="flex-auto flex flex-col items-end h-14">
                    <div class="flex flex-col items-center relative">
                        <div class="w-full  svelte-1l8159u">
                            <div class="my-2 bg-white p-1 flex border border-gray-200 rounded svelte-1l8159u">
                                <div class="flex flex-auto flex-wrap"></div>
                                <input id="tagInput" value="Javascript" class="p-1 px-2 appearance-none outline-none w-full text-gray-800  svelte-1l8159u">
                                <div id="tagInputClearBtn">
                                    <button class="cursor-pointer w-6 h-full flex items-center text-gray-400 outline-none focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                                {{--    Drop Up Button  --}}
                                <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u" id="dropUpBtn">
                                    <button class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up w-4 h-4">
                                            <polyline points="18 15 12 9 6 15"></polyline>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        {{--    HashTags Add Example    --}}
                        <div class="absolute shadow top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj tag-example">
                            <div class="flex flex-col w-full">
                                <div onclick="clickHashTagExample()" class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100" style="">
                                    <div class="flex w-full items-center p-2 pl-2 border-transparent bg-white border-l-2 relative hover:bg-teal-600 hover:text-teal-100 hover:border-teal-600">
                                        <div class="w-full items-center flex">
                                            <div class="mx-2 leading-6">Python </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cursor-pointer w-full border-gray-100 border-b hover:bg-teal-100 " style="">
                                    <div class="flex w-full items-center p-2 pl-2 border-transparent bg-white border-l-2 relative hover:bg-teal-600 hover:text-teal-100 border-teal-600">
                                        <div class="w-full items-center flex">
                                            <div class="mx-2 leading-6  ">Javascript </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cursor-pointer w-full border-gray-100 rounded-b hover:bg-teal-100 " style="">
                                    <div class="flex w-full items-center p-2 pl-2 border-transparent bg-white border-l-2 relative  hover:bg-teal-600 hover:text-teal-100 hover:border-teal-600">
                                        <div class="w-full items-center flex">
                                            <div class="mx-2 leading-6  ">Ruby </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <form action="{{ route('diary.save') }}" id="diarySubmitForm" method="post">
                <input type="hidden" name="meal_time" id="meal_time" value="">
                <input type="hidden" name="content" id="contentInput">
                <input type="hidden" name="hashTagList" id="hashTagList">
                <div class="">
                    {{--                <label for="date" class="block text-sm text-gray-500 dark:text-gray-300">Date</label>--}}
                    <input type="date" name="date" id="date" placeholder="John Doe" class="block  mt-2 w-full placeholder-gray-400/70 dark:placeholder-gray-500 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300" />

                </div>
            </form>

{{--            <button class="modal-close-btn" id="modalCloseBtn">Close</button>--}}

            {{--    Editor  --}}
                <div id="content"></div>
            <div class="btn-group">
                <div class="flex justify-end overflow-hidden bg-white border divide-x rounded-lg rtl:flex-row-reverse dark:bg-gray-900 dark:border-gray-700 dark:divide-gray-700">
                    {{--                    <button onclick="axios.get('{{ route('test2') }}')"--}}
                    <button onclick="toggleDiaryModal();"
                            class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 transition-colors duration-200 sm:text-base sm:px-6 dark:hover:bg-gray-800 dark:text-gray-300 gap-x-3 hover:bg-gray-100">
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

                {{--    Diary List  --}}
                <div class="main-content">
                    @foreach($diarySegments as $segment)
                        <div class="card card-{{ $loop->iteration }} card-img" onclick="showEditor({{ $loop->iteration }}, {{ $segment }})">
                            <div class="diary-date">{{ $segment->meal_time }} 日記</div>
                            <div class="segment-content hidden" id="segment-content-{{ $loop->iteration }}">
{{--                                    {{ $segment->content }}--}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{--    Pagination  --}}
        <div class="pagination-container">
        <div class="flex pagination">
            {{--    First Page  --}}
            @if($diarySegments->onFirstPage() === true)
                <a href="#" class="px-4 py-2 mx-1 text-gray-500 capitalize bg-white rounded-md cursor-not-allowed dark:bg-gray-800 dark:text-gray-600">
                    <div class="flex items-center -mx-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-1 rtl:-scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                        </svg>

                        <span class="mx-1">
                        previous
                    </span>
                    </div>
                </a>
            @else
                <a href="{{ $diarySegments->previousPageUrl() }}" class="px-4 py-2 mx-1 text-gray-700 capitalize bg-white rounded-md dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
                    <div class="flex items-center -mx-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-1 rtl:-scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                        </svg>
                        <span class="mx-1">
                            previous
                        </span>
                    </div>
                </a>
            @endif

            @for($i = 1; $i <= $diarySegments->lastPage(); $i++)
                <a href="{{ $diarySegments->url($i) }}" class="hidden px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md sm:inline dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
                    {{ $i }}
                </a>
            @endfor

            {{--    Last Page   --}}
            @if($diarySegments->onLastPage())
                <a href="{{ $diarySegments->nextPageUrl() }}" class="px-4 py-2 mx-1 text-gray-500 cursor-not-allowed transition-colors duration-300 transform bg-white rounded-md dark:bg-gray-800 dark:text-gray-200">
                    <div class="flex items-center -mx-1">
                    <span class="mx-1" >
                        Next
                    </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-1 rtl:-scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </div>
                </a>
            @else
                <a href="{{ $diarySegments->nextPageUrl() }}" class="px-4 py-2 mx-1 text-gray-700 transition-colors duration-300 transform bg-white rounded-md dark:bg-gray-800 dark:text-gray-200 hover:bg-blue-500 dark:hover:bg-blue-500 hover:text-white dark:hover:text-gray-200">
                    <div class="flex items-center -mx-1">
                    <span class="mx-1" >
                        Next
                    </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-1 rtl:-scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </div>
                </a>

            @endif
        </div>
    </div>
    </div>




@endsection

@section('script')






    {{--    diary modal: SELECT   --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script  src="{{ asset('js/dashboard_segments.js') }}"></script>
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
            height: '60vh',                        // 에디터 영역의 높이 값 (OOOpx || auto)
            // width: '80vw',
            initialEditType: 'markdown',            // 최초로 보여줄 에디터 타입 (markdown || wysiwyg)
            // initialValue: '내용을 입력해 주세요.',     // 내용의 초기 값으로, 반드시 마크다운 문자열 형태여야 함
            previewStyle: 'vertical',                // 마크다운 프리뷰 스타일 (tab || vertical),
            placeholder: '内容を入力してください。',
            hideModeSwitch: true,
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

        function toggleDiaryModal() {
            const diaryAddModal = $('#createModal');

            if (diaryAddModal.css('visibility') === 'hidden') {
                diaryAddModal.css('visibility', 'visible');
                diaryAddModal.attr('style', 'z-index: 1200 !important');
            } else {
                // diaryAddModal.style.setProperty('visibility', 'hidden', 'important');
                diaryAddModal.attr('style', 'visibility: hidden !important');
                // diaryAddModal.css('visibility', 'hidden');

                diaryAddModal.css('z-index', '-1');
            }
        }
        // $('#modalCloseBtn').click(toggleDiaryModal);

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

        $('#diary-save-btn').click(async function () {
            console.log('click');
            console.log(arr);
            $('#contentInput').val(editor.getMarkdown());
            $('#hashTagList').val(JSON.stringify(arr));
            const form = document.getElementById('diarySubmitForm');
            form.submit();
        });

        function dropUp() {
            const toggleElement = document.querySelector('.tag-example');
            toggleElement.classList.toggle('hidden');
        }
        $('#dropUpBtn').click(dropUp);



        function clickHashTagExample() {
            console.log('a');
            alert('a');
        }

        // Tag Clear Button click
        $('#tagInputClearBtn').click(function () {
            const toggleElement = document.querySelector('.tag-example');
            $('#tagInput').val("");
            if (!toggleElement.classList.contains('hidden')) {
                toggleElement.classList.toggle('hidden');
            }
        })

        let arr = [];
        let badgeIndex = 0;
        $('#tagInput').keypress(function (e) {
            let inputText = $('#tagInput').val();
            if(e.keyCode && e.keyCode == 13){
                const badgeHTML = `
                <span id="badge-${badgeIndex}" class="inline-flex items-center px-2 py-1 mr-2 text-sm font-medium text-purple-800 bg-purple-100 rounded dark:bg-purple-900 dark:text-purple-300">
                    <span id="badge-text-${badgeIndex}">${inputText}</span>
                    <button onclick="removeBadge('${badgeIndex}')" type="button" class="inline-flex items-center p-1 ml-2 text-sm text-purple-400 bg-transparent rounded-sm hover:bg-purple-200 hover:text-purple-900 dark:hover:bg-purple-800 dark:hover:text-purple-300" data-dismiss-target="#badge-dismiss-purple" aria-label="Remove">
                        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Remove badge</span>
                    </button>
                </span>
                `;
                document.getElementById('badges-container').innerHTML += badgeHTML;
                badgeIndex++;
                arr.push(inputText);
            }
        });

        function removeBadge(badgeIndex) {
            const badgeElement = document.getElementById(`badge-${badgeIndex}`);
            const badgeText = badgeElement.querySelector(`#badge-text-${badgeIndex}`).innerText;
            console.log(badgeElement)
            console.log(`text: ${badgeText}`);
            // alert(`${badgeId}, ${badgeText}`);
            if (badgeElement) {
                badgeElement.remove();
                arr = arr.filter(item => item !== badgeText);
                console.log('삭제 후 arr');
                console.log(arr);
            }
            // arr.remove(`badge-${badgeIndex}`);
        }
        $('document').ready(function () {
            console.log('ready');
            console.log(@json($diarySegments));
            console.log(`total record: {{ $diarySegments->total() }}`)
            console.log(`current page: {{ $diarySegments->currentPage() }}`)
            console.log(`total page: {{ $diarySegments->lastPage() }}`)
            console.log(`next page url: {{ $diarySegments->nextPageUrl() }}`)
            console.log(`previous page url: {{ $diarySegments->previousPageUrl() }}`)
        });

        function showEditor(iter, segment) {
            console.log(`iter: ` + iter);
            // alert('a');
            const text = segment.content;
            const viewer = new toastui.Editor({
                el: document.querySelector(`#segment-content-${iter}`), // 에디터를 적용할 요소 (컨테이너)
                height: '100%',                        // 에디터 영역의 높이 값 (OOOpx || auto)
                // width: '80vw',
                initialEditType: 'wysiwyg',            // 최초로 보여줄 에디터 타입 (markdown || wysiwyg)
                initialValue: text,     // 내용의 초기 값으로, 반드시 마크다운 문자열 형태여야 함
                previewStyle: 'vertical',                // 마크다운 프리뷰 스타일 (tab || vertical),
                placeholder: '内容を入力してください。',
                // theme: 'dark',
                hideModeSwitch: true,
                toolbarItems: [],

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
            // console.log(editor.height);
        }

    </script>
@endsection
