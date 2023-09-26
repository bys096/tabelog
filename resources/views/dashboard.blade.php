<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>食べログ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="app">
    <div class="sidebar">
        <div class="user">
            <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2360&q=80" alt="user photo" class="user-photo">
            <div class="user-name">Alexander</div>
            <div class="user-mail">alexander@email.com</div>
        </div>
        <div class="sidebar-menu">
            <a href="#" class="sidebar-menu__link active">Design</a>
            <a href="#" class="sidebar-menu__link">Barbeque</a>
            <a href="#" class="sidebar-menu__link">Productivity</a>
            <a href="#" class="sidebar-menu__link">Workout</a>
            <a href="#" class="sidebar-menu__link">Book</a>
            <a href="#" class="sidebar-menu__link">Snack</a>
        </div>
        <label class="toggle">
            <input type="checkbox">
            <span class="slider"></span>
        </label>
    </div>
    <div class="main">
        <div class="main-header">
            <div class="main-header__title">Productivity</div>
{{--            <div class="main-header__avatars">--}}
{{--                <button class="add-button"><svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>--}}
{{--                    </svg></button>--}}
{{--            </div>--}}
            <button class="main-header__add">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg>
            </button>
        </div>

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
<!-- partial -->
<script  src="{{ asset('js/dashboard.js') }}"></script>

</body>
</html>
