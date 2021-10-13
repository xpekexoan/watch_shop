@extends('admin.master')
@section('title')
Tài khoản người dùng
@endsection
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex  align-items-center">
              <span class="card-title mr-3">Danh sách</span>
              <a href="{{ route('admin.user.create') }}" class="btn btn-success">Tạo mới</a>
            </div>
          </div>
          <div class="card-body pb-0">
            {{-- Search --}}
            <form method="GET" action="{{ route('admin.user.search') }}">
              <div class="form-row">
                {{-- ID --}}
                <div class="form-group col-md-1">
                  <label for="id">ID:</label>
                  <input type="text" class="form-control" id="id" name="id"
                    value="{{ isset($request['id']) ? $request['id'] : '' }}" autocomplete="off">
                </div>
                {{-- Name --}}
                <div class="form-group col-md-2">
                  <label for="name">Họ tên:</label>
                  <input type="text" class="form-control" id="name" name="name"
                    value="{{ isset($request['name']) ? $request['name'] : '' }}" autocomplete="off">
                </div>
                {{-- Email --}}
                <div class="form-group col-md-2">
                  <label for="email">Email:</label>
                  <input type="text" class="form-control" id="email" name="email"
                    value="{{ isset($request['email']) ? $request['email'] : '' }}" autocomplete="off">
                </div>
                {{-- Role --}}
                <div class="form-group col-md-2">
                  <label for="role">Vai trò:</label>
                  <select id="role" class="form-control" name="id_role">
                    <option value>Tất cả</option>
                    @if (isset($request['id_role']))
                      @foreach ($roles as $role)
                        @if ($role->id == $request['id_role'])
                          <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                        @else
                          <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                      @endforeach
                    @else
                      @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
                <button type="submit" class="btn btn-primary align-self-end mb-3 ml-3">Tìm kiếm</button>
              </div>
            </form>
          </div>

          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Họ tên</th>
                  <th scope="col">Email</th>
                  <th scope="col">Số điện thoại</th>
                  <th scope="col">Vai trò</th>
                  <th scope="col" width="15%">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $item)
                <tr>
                  <th>{{ $item->id }}</th>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->email }}</td>
                  <td>{{ $item->tel }}</td>
                  <td>{{ $item->role->name }}</td>
                  <td>
                    <div class="d-flex justify-content-center flex-wrap">
                      <a href="{{ route('admin.user.detail', ['id'=>$item->id]) }}"
                        class="btn btn-info mr-2">Xem</a>
                      @if ($item->status)
                      <a href="#"class="btn btn-danger btn-blocked" data-id="{{ $item->id }}">Khóa</a>
                      @else
                      <a href="#"class="btn btn-warning btn-actived" data-id="{{ $item->id }}">Kích hoạt</a>
                      @endif
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <div class="d-flex mt-4 justify-content-between">
              <div>
                <div class="dataTables_info">Total: {{ $users->total() }} entries</div>
              </div>
              <div>
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  {{ $users->links() }}
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

@section('script')
<script src="{{ asset('admin/dist/js/sweet-alert.js') }}"></script>
<script src="{{ asset('js/ajax.js') }}"></script>
<script>
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  $(function() {
    $('.btn-blocked').click(function(e){
      e.preventDefault();
      swal({
        title: "Bạn có chắc?",
        text: "Tài khoản này sẽ bị khóa?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          const URL = `{{ route('admin.user.block') }}/${$(this).data('id')}`
          ajax(url = URL, {}, 'put', function (result) {
            let message = result.message
            toastr.success(message);
            location.reload();
          }, function (err) {
            let message = err.responseJSON.message
            toastr.error(message);
          })
        }
      });
    })

    $('.btn-actived').click(function(e){
      e.preventDefault();
      swal({
        title: "Bạn có chắc?",
        text: "Tài khoản này sẽ kích hoạt?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          const URL = `{{ route('admin.user.active') }}/${$(this).data('id')}`
          ajax(url = URL, {}, 'put', function (result) {
            toastr.success(result);
            location.reload();
          }, function (err) {
            let message = err.responseJSON.message
            toastr.error(message);
          })
        }
      });
    })
  })
  
</script>
@endsection