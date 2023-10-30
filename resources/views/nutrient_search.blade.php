@extends('footer')

@section('style')
    {{--    dashboard css   --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    {{--    editor css  --}}
    <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
    <link rel="stylesheet" href="https://nhn.github.io/tui.editor/latest/dist/cdn/theme/toastui-editor-dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        .top-100 {top: 100%}
        .bottom-100 {bottom: 100%}
        .max-h-select {
            max-height: 300px;
        }
    </style>
@endsection

@section('content')
    <div id="app-container">
        <div class="app">
            <div class="sidebar">
                <div class="user">
                    <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2360&q=80" alt="user photo" class="user-photo">
                    <div class="user-name">{{ $user->name }}</div>
                    <div class="user-mail">{{ $user->email }}</div>
                </div>
                <div class="sidebar-menu">
                    <a href="{{ route('diary.index') }}" class="sidebar-menu__link">Dairy</a>
                    <a href="#" class="sidebar-menu__link">통계</a>
                    <a href="{{ route('nutrient.search') }}" class="sidebar-menu__link active">성분 검색</a>
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
                    <div class="main-header__title">성분 검색</div>
                    {{--            <div class="main-header__avatars">--}}
                    {{--                <button class="add-button"><svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">--}}
                    {{--                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>--}}
                    {{--                    </svg></button>--}}
                    {{--            </div>--}}

                </div>

            </div>
        </div>
    </div>




@endsection

@section('script')


    {{--    diary modal: SELECT   --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{--    jquery  --}}
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>



    <script>
        function dropUp() {
            const toggleElement = document.querySelector('.tag-example');
            toggleElement.classList.toggle('hidden');
        }
        $('#dropUpBtn').click(dropUp);



        function clickHashTagExample() {
            console.log('a');
            alert('a');
        }



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


        $('document').ready(function () {
            console.log('ready');

        });

    </script>
@endsection
