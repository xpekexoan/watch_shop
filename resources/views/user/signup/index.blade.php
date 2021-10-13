@extends('user.master')
@section('title')
    Đăng ký tài khoản
@endsection
@section('content')
    <div class="login-register-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="heading-secondary mb--30">Đăng ký</h2>
                    <div class="login-reg-box p-4 bg--2">
                        <form action="{{ route('signup') }}" method="post">
                            @csrf
                            <div class="form__group mb--20 @error('name') has-error @enderror" ><label class="form__label" for="name">
                                    Họ tên <span>*</span></label><input type="text" name="name" id="name" class="form__input form__input--2" value="{{ old('name') }}">
                                @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form__group mb--20 @error('tel') has-error @enderror"><label class="form__label" for="register_email">
                                    Số điện thoại <span>*</span></label><input type="number" name="tel" id="register_email" class="form__input form__input--2" value="{{ old('tel') }}">
                                @error('tel')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form__group mb--20 @error('email') has-error @enderror"><label class="form__label" for="register_email">
                                    Email <span>*</span></label><input type="text" name="email" id="register_email" class="form__input form__input--2" value="{{ old('email') }}">
                                @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form__group mb--20 @error('password') has-error @enderror"><label class="form__label" for="register_password">Mật khẩu <span>*</span></label><input
                                    type="password" name="password" id="password"
                                    class="form__input form__input--2">
                                @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form__group mb--20 @error('password') has-error @enderror"><label class="form__label" for="register_password">Nhập lại mật khẩu <span>*</span></label><input
                                    type="password" name="password_confirmation" id="password"
                                    class="form__input form__input--2">
                            </div>
                            <div class="form__group"><button type="submit" class="btn btn-5 btn-style-2">Đăng ký</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
