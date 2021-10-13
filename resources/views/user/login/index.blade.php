@extends('user.master')
@section('title')
    Đăng nhập
@endsection
@section('content')
    <div class="login-register-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-md--40">
                    <h2 class="heading-secondary mb--30">Đăng nhập</h2>
                    <div class="login-reg-box p-4 bg--2">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form__group mb--20 @error('email') has-error @enderror" ><label class="form__label" for="username_email">
                                    Email <span>*</span></label>
                                <input type="text" name="email" id="email" class="form__input form__input--2" value="{{ old('email') }}">
                                @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form__group mb--20 @error('password') has-error @enderror" >
                                <label class="form__label" for="password">Mật khẩu
                                    <span>*</span></label>
                                <input type="password" name="password" id="password" class="form__input form__input--2" value="{{ old('password') }}">
                                @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form__group">
                                <div class="">
                                    <input type="checkbox" name="sessionStore" id="sessionStore" class="form__checkbox">
                                    <label for="sessionStore" class="form__checkbox--label">Nhớ tài khoản</label>
                                </div>
                                <button type="submit" class="btn btn-5 btn-style-1 color-1">Đăng nhập</button>
                               
                            </div>
                            <a href="" class="forgot-pass">Quên mật khẩu ?</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

