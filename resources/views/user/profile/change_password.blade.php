@extends('user.master')
@section('title')
    Thay đổi mật khẩu
@endsection
@section('content')
    <div class="account-wrapper pt--40 pb--80 pt-md--30 pb-md--60">
        <div class="container">
            <div class="user-dashboard-tab">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-dashboard-tab__content tab-content">
                            <div class="tab-pane fade show active" id="accountdetails">
                                <div class="account-form bg--2">
                                    <form action="{{ route('profile.update_password') }}" class="form" method="post">
                                        @csrf
                                        <div class="form-row">
                                            <div class="col-12">
                                                <h4>THAY ĐỔI MẬT KHẨU</h4>
                                            </div>
                                        </div>
                                        <div class="form-row mb--20">
                                            <div class="col-12">
                                                <div class="form__group @error('current_password') has-error @enderror ">
                                                    <label for="cur_password" class="form__label">Mật khẩu cũ</label>
                                                    <input type="password" name="current_password" id="cur_password" class="form__input form__input--2">
                                                    @error('current_password')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mb--20">
                                            <div class="col-12">
                                                <div class="form__group @error('password') has-error @enderror">
                                                    <label for="password" class="form__label">Mật khẩu mới</label>
                                                    <input type="password" name="password" id="password" class="form__input form__input--2">
                                                    @error('password')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mb--20">
                                            <div class="col-12">
                                                <div class="form__group">
                                                    <label for="password_confirmation" class="form__label">Nhập lại mật khẩu</label>
                                                    <input type="password" name="password_confirmation" id="confirm_password" class="form__input form__input--2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-medium btn-style-2">Lưu</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
