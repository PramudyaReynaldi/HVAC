<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>DMS | Login</title>

        <link rel="stylesheet" href="{{ asset('css/sb-admin-2.min.css') }}">
    </head>
    <body>
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="container">
                <div class="row justify-content-center">
        
                    <div class="col-xl-10 col-lg-12 col-md-9">
        
                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                        <img src="{{ asset('images/login-background.jpg') }}" alt="" class="w-100">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                            </div>

                                            <form class="user">
                                                <div class="form-group">
                                                    <input 
                                                        type="email"
                                                        name="email"
                                                        class="form-control form-control-user"
                                                        id="email" 
                                                        aria-describedby="emailHelp"
                                                        placeholder="Enter Email Address..."
                                                        value="{{ old('email') }}"
                                                        required autofocus
                                                    />
                                                </div>

                                                <div class="form-group">
                                                    <input 
                                                        type="password" 
                                                        class="form-control form-control-user"
                                                        id="password" 
                                                        placeholder="Password"
                                                        name="password"
                                                        required
                                                    />
                                                </div>

                                                <button type="button" id="loginBtn" class="btn btn-primary btn-user btn-block">
                                                    Login
                                                </button>
                                                <hr>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert2@11.js')}}"></script>

        <script>
            $(document).ready(function() {
                $('#loginBtn').click(function() {

                    const email = $('#email').val();
                    const password = $('#password').val();
                    const token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: "POST",
                        url: "{{ route('login') }}",
                        data: {
                            email: email,
                            password: password,
                            _token: token
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Login Successful',
                                    text: 'You will be redirected to the dashboard.',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href = "/";
                                });
                            } else {
                                Swal.fire({
                                    title: 'Login Failed',
                                    text: response.message,
                                    icon: 'error',
                                });
                            }
                        },
                        error: function(xhr) {
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                Swal.fire({
                                    title: 'Login Failed',
                                    text: 'Please check your credentials and try again.',
                                    icon: 'error',
                                });
                            } else {
                                Swal.fire({
                                    title: 'An error occurred',
                                    text: 'Please try again later.',
                                    icon: 'error',
                                });
                            }
                        }
                    });
                });
            })
        </script>
    </body>
</html>
