<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>食べログ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,600' rel='stylesheet' type='text/css'><link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="back">
    <canvas id="canvas" class="canvas-back"></canvas>
    <div class="backRight">
    </div>
    <div class="backLeft">
    </div>
</div>

<div id="slideBox">
    <div class="topLayer">
        <div class="left">
            <div class="content">
                <h2>Sign Up</h2>
                <form id="form-signup" method="post" action="/users" onsubmit="return false;">
                    @csrf
                    <div class="form-element form-stack">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email">
                        <div class="form-element form-submit">

                            <button id="email-check" class="signup" name="emailCheck">Check</button>
                            <span id="email-check-result" class="email-check-false"></span>
                        </div>
                    </div>
                    <div class="form-element form-stack">
                        <label for="username-signup" class="form-label">Username</label>
                        <input id="username-signup" type="text" name="username">
                    </div>
                    <div class="form-element form-stack">
                        <label for="password-signup" class="form-label">Password</label>
                        <input id="password-signup" type="password" name="password">
                    </div>
                    <div class="form-element form-checkbox">
                        <input id="confirm-terms" type="checkbox" name="confirm" value="yes" class="checkbox">
                        <label for="confirm-terms">I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                    </div>
                    <div class="form-element form-submit">
                        <button id="signUp" class="signup" type="submit" name="signup">Sign up</button>
                        <button id="goLeft" class="signup off">Log In</button>
                    </div>
                    <input id="ischeck" type="hidden" name="isCheck" value="false">
                </form>
            </div>
        </div>
        <div class="right">
            <div class="content">
                <h2>Login</h2>
                <form id="form-login" method="post" onsubmit="return false;">
                    @csrf
                    <div class="form-element form-stack">
                        <label for="username-login" class="form-label">Email</label>
                        <input id="username-login" type="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="form-element form-stack">
                        <label for="password-login" class="form-label">Password</label>
                        <input id="password-login" type="password" name="password">
                    </div>
                    @error('email_error')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @if($errors->first('email'))
{{--                        @foreach($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                    @endif
                    <div class="form-element form-submit">
                        <button id="logIn" class="login" type="submit" name="login">Log In</button>
                        <button id="goRight" class="login off" name="signup">Sign Up</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!--

Remixed from "Sliding Login Form" Codepen by
C-Rodg (github.com/C-Rodg)
https://codepen.io/crodg/pen/yNKxej

Remixed from "Paper.js - Animated Shapes Header" Codepen by
Connor Hubeny (@cooper_hu)
https://codepen.io/cooper_hu/pen/ybxoev

Custom Checkbox based on the blog post by
Mik Ted (@inserthtml):
https://www.inserthtml.com/2012/06/custom-form-radio-checkbox/

HTML5 Form Validation based on the blog post by
Thoriq Firdaus (@tfirdaus):
https://webdesign.tutsplus.com/tutorials/
html5-form-validation-with-the-pattern-attribute--cms-25145

-->
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/paper.js/0.11.3/paper-full.min.js'></script><script  src="{{ asset('js/login.js') }}"></script>
<script>

    // register form submit
    $('#signUp').click(function () {
        if ($('#ischeck').val() == 'true') {
            const form = document.getElementById('form-signup');
            form.action = '/users';
            form.submit();
            alert('회원 가입이 완료 되셨습니다!');
        } else {
            alert('EMAIL 중복 체크를 완료해주세요!');
        }
    });

    // login form submit
    $('#logIn').click(function () {
        const form = document.getElementById('form-login');
        form.action = '/auth/login';
        form.submit();
        console.log('login 제출');
    })


    // email check btn click
    $('#email-check').click(function () {
        // alert('중복체크');
        let emailValue = $('#email').val();
        const url = '{{ route('email.check') }}';
        $.ajax({
            type: "POST",
            url: url,
            success: function (response) {
                const isExist = response.result;
                console.log(response);
                if(isExist == 'true') {
                    $('#email-check-result').addClass('email-check-false');
                    $('#email-check-result').removeClass('email-check-true');
                    $('#ischeck').val('false');
                    $('#email-check-result').text("이미 사용 중인 이메일입니다.");
                }
                else {
                    $('#email-check-result').addClass('email-check-true');
                    $('#email-check-result').removeClass('email-check-false');
                    $('#ischeck').val('true');
                    $('#email-check-result').text("사용 가능한 이메일입니다.");
                }
            },
            data: {
                email: emailValue
            }
        })
    });
</script>
</body>
</html>
