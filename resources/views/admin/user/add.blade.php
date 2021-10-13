@extends('admin.master')
@section('title')
Tài khoản người dùng
@endsection
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div>
                    <p class="card-title mr-3">Tạo mới</p>
                  </div>
                </div>

                <div class="card-body">
                  <form method="POST" action="{{ route('admin.user.create') }}">
                    @csrf
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="name">Họ tên:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                          name="name" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>

                      <div class="form-group col-md-6">
                        <label for="tel">Số điện thoại:</label>
                        <input type="text" class="form-control @error('tel') is-invalid @enderror" id="tel" name="tel"
                          value="{{ old('tel') }}" maxlength="10">
                        @error('tel')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                          name="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                          id="password" name="password">
                        @error('password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="province">Thành phố:</label>
                        <select id="province" class="form-control select2 @error('id_province') is-invalid @enderror"
                          name="id_province">
                        </select>
                        @error('id_province')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="district">Quận/Huyện:</label>
                        <select id="district" class="form-control select2 @error('id_district') is-invalid @enderror"
                          name="id_district" disabled>
                        </select>
                        @error('id_district')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-6">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                          name="address" value="{{ old('address') }}">
                        @error('address')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="role">Vai trò:</label>
                        <select id="role" class="form-control  @error('id_role') is-invalid @enderror" name="id_role">
                          @foreach ($roles as $role)
                          @if ($role->id == $id_cus)
                          <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                          @else
                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                          @endif
                          @endforeach
                        </select>
                        @error('id_role')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pr-4 pl-4 ">Lưu</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</section>
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
    //Initialize Select2 Elements
    $('.select2').select2();

    const URL_PROVINCE = "{{ route('api.province') }}"
    const URL_DISTRICT = "{{ route('api.district') }}"

    ajax(url = URL_PROVINCE, {}, 'GET', function (result) {
      strElmOptions = getOptionProvince(result)
      $('#province').html(strElmOptions)
      id_province = "{{ old('id_province') }}"
      if (id_province)
      {
        $(`#province > option[value=${id_province}]`).attr("selected", "selected")
        loadDistrict(id_province);
      }
    })

    $('#province').change(function () {
      loadDistrict(this.value);
    })

    function loadDistrict(id_province)
    {
      $('#district').removeAttr('disabled')
      ajax(url = URL_DISTRICT, { id_province : id_province }, 'GET', function (result) {
        strElmOptions = getOptionDistrict(result)
        $('#district').html(strElmOptions)
        id_district = "{{ old('id_district') }}"
        if (id_district) {
          $(`#district > option[value=${id_district}]`).attr("selected", "selected")
        }
      })
    }
  })

</script>
@endsection
