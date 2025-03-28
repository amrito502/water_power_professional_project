<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5" />
    <meta name="author" content="AdminKit" />
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web" />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="shortcut icon" href="https://waterpowermetal.com/media/system/20230514215457_Untitled%20design.jpg" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Waterpowermetal</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js"
        integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
</head>
<style>
    body {
        font-family: "Noto Sans", sans-serif;
    }

    .main_form {
        width: 340px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #ffffff;
        padding: 22px;
        border: 1px solid #ffffff;
    }

    .col_under_row {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 200px;
        flex-direction: column;
    }

    .login_cus_btn {
        height: 45px;
        background: #18A689;
        border: none;
        outline: none;
        color: #fff;
        font-size: 17px;
        transition: .4s;
    }

    .login_cus_btn:hover{
        color: #d5dfdd;
    }

    .form_logo {
        width: 200px;
        margin-bottom: 30px;
        margin-left: -17px;
    }

    . {}

    . {}
</style>
@yield('style')

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col_under_row">
                <img class="form_logo" src="{{ asset('img/logo.png') }}" alt="">
                <div class="main_form">
                   <form action="{{ url('login/store') }}" method="post">
                    @csrf
                    <div class="form w-100">
                        <!-- Branch Selection -->
                        <div class="form-group">
                            <select name="branch" class="form-control w-100 mb-3" required>
                                <option value="">Select Area/Branch</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Zone Selection -->
                        <div class="form-group">
                            <select name="zone" class="form-control w-100 mb-3" required>
                                <option value="">Select Zone</option>
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- User Selection (By Name) -->
                        <div class="form-group">
                            <select name="name" class="form-control w-100 mb-3" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Password Input -->
                        <div class="form-group">
                            <input type="password" class="form-control mb-4 w-100" name="password" placeholder="Password" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="w-100 text-center login_cus_btn">Login</button>
                        </div>
                        <a href="" style="margin-top: 10px !important;display: inline-block;">Forget Password!</a>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
