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
                  <div class="d-flex  align-items-center">
                    <span class="card-title mr-2">Chi tiết</span>
                    <a href="{{ route('admin.user.reset_password',  ['id'=> $user->id]) }}"
                      class="btn btn-secondary mr-2">Đặt lại mật khẩu</a>
                    <a href="{{ route('admin.user.create') }}" class="btn btn-success">Tạo mới</a>
                  </div>
                </div>

                <div class="card-body">
                  <form method="POST" action="{{ route('admin.user.update', ['id'=> $user->id]) }}">
                    @csrf
                    @method('put')
                    <div class="form-row">
                      {{-- ID --}}
                      <div class="form-group col-md-3">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{ $user->id }}" disabled>
                      </div>
                      {{-- Created at --}}
                      <div class="form-group col-md-3">
                        <label for="created_at">Thời gian tạo mới</label>
                        <input type="text" class="form-control" id="created_at" name="created_at"
                          value="{{ $user->created_at }}" disabled>
                      </div>
                    </div>
                    <div class="form-row">
                      {{-- Name --}}
                      <div class="form-group col-md-6">
                        <label for="name">Họ tên</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                          name="name" value="{{old('name') ? old('name') : $user->name}}">
                        @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      {{-- Phone number --}}
                      <div class="form-group col-md-6">
                        <label for="tel">Số điện thoại</label>
                        <input type="text" class="form-control @error('tel') is-invalid @enderror" id="tel" name="tel"
                          value="{{old('tel') ? old('tel') : $user->tel}}" maxlength="10">
                        @error('tel')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-row">
                      {{-- Email --}}
                      <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                          name="email" value="{{ $user->email }}" disabled>
                      </div>
                    </div>
                    <div class="form-row">
                      {{-- Province --}}
                      <div class="form-group col-md-3">
                        <label for="province">Tỉnh/Thành phố</label>
                        <select id="province" class="form-control select2 @error('id_province') is-invalid @enderror"
                          name="id_province">
                        </select>
                        @error('id_province')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      {{-- District --}}
                      <div class="form-group col-md-3">
                        <label for="district">Quận/Huyện</label>
                        <select id="district" class="form-control select2 @error('id_district') is-invalid @enderror"
                          name="id_district">
                        </select>
                        @error('id_district')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      {{-- Address --}}
                      <div class="form-group col-md-6">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                          name="address" value="{{old('address') ? old('address') : $user->address}}">
                          @error('address')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                      </div>
                    </div>
                    <div class="form-row">
                      {{-- Role --}}
                      <div class="form-group col-md-3">
                        <label for="role">Vai trò</label>
                        <select id="role" class="form-control @error('id_role') is-invalid @enderror" name="id_role">
                          @foreach ($roles as $role)
                          @if ($role->id == $user->role->id)
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
                      {{-- Status --}}
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  @stack('modal')
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
@stack('js')
@endsection