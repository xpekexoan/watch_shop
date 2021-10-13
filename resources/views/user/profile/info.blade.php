@extends('user.master')
@section('title')
    Cập nhật thông tin
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
                                    <form action="{{ route('profile.info') }}" method="post" class="form">
                                        @method('put')
                                        @csrf
                                        <div class="form-row mb--20">
                                            <div class="col-md-6 mb-sm--20">
                                                <div class="form__group @error('name') has-error @enderror">
                                                    <label for="account_fname" class="form__label">Tên</label>
                                                    <input type="text" name="name" id="name" class="form__input form__input--2" value="{{ $user->name }}">
                                                    @error('name')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6" >
                                                <div class="form__group @error('tel') has-error @enderror">
                                                    <label for="account_lname" class="form__label">Số điện thoại</label>
                                                    <input type="number" name="tel" id="tel" class="form__input form__input--2" value="{{ $user->tel }}">
                                                    @error('tel')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mb--20">
                                            <div class="col-md-6">
                                                <div class="form__group @error('email') has-error @enderror">
                                                    <label for="user_email" class="form__label">Email Address</label>
                                                    <input type="email" name="user_email" id="user_email" class="form__input form__input--2" disabled value="{{ $user->email }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mb--20">
                                            <div class="col-md-6">
                                                <div class="form__group">
                                                    <label for="province" @error('id_province') has-error @enderror>Thành phố</label>
                                                    <select class="form__input form__input--2" id="province" name="id_province"></select>
                                                    @error('id_province')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form__group @error('id_district') has-error @enderror">
                                                    <label for="district">Quận huyện</label>
                                                    <select class="form__input form__input--2" name="id_district" id="district">
                                                    </select>
                                                    @error('id_district')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row mb--20">
                                            <div class="col-md-6">
                                                <div class="form__group @error('address') has-error @enderror">
                                                    <label for="account_lname" class="form__label">Địa chỉ</label>
                                                    <input type="text" name="address" id="account_lname" class="form__input form__input--2" value="{{ $user->address }}">
                                                    @error('address')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
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
@section('link_css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('script')
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script src="{{ asset('admin/js/province-district.js') }}"></script>
    <script>
        $(function () {
            id_district = '{{ $user->district ? $user->district->id : '' }}'
            id_province = '{{ $user->district ? $user->district->province->id  : ''}}'
            //Initialize Select2 Elements
            $('.select2').select2()

            const URL_PROVINCE = "{{ route('api.province') }}"
            const URL_DISTRICT = "{{ route('api.district') }}"
            ajax(url = URL_PROVINCE, {}, 'GET', function (result) {
                strElmOptions = getOptionProvince(result);
                $('#province').html(strElmOptions);
                // Get province of user
                $('#province>option[value="' + id_province + '"]').attr("selected", "selected")
            })

            if (id_province) {
                ajax(url = URL_DISTRICT, { id_province : id_province }, 'GET', function (result) {
                    strElmOptions = getOptionDistrict(result);
                    $('#district').html(strElmOptions);
                    // Get district of user
                    $('#district>option[value="' + id_district + '"]').attr("selected", "selected")
                })
            }

            $('#province').change(function () {
                ajax(url = URL_DISTRICT, { id_province : this.value }, 'GET', function (result) {
                    strElmOptions = getOptionDistrict(result);
                    $('#district').html(strElmOptions);
                })
            })
        })
    </script>
@endsection
