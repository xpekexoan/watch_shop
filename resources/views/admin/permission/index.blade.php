@extends('admin.master') 
@section('title') 
Phân quyền hệ thống
@endsection
@section('content')
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header p-3">
						<ul class="nav nav-pills">
							@foreach ($roles as $item)
							<li class="nav-item">
								<a class="nav-link" id="tab-{{$item->id}}"
									href="{{ route('admin.permission.index', ['id_role' => $item->id]) }}">
									{{$item->name}}
								</a>
							</li>
							@endforeach
						</ul>
					</div>
					<div class="card-body">
						<div class="tab-content">
							<form action="{{ route('admin.permission.update', ['id_role' => $id_role]) }}" method="post">
								<div class="contain-permission" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
									@csrf @method('put')
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="check-all"
											{{ $permissions->where('id_role', '!=', null)->count() == $permissions->count() ? 'checked' : '' }} />
										<label class="form-check-label" for="check-all">
											Tất cả
										</label>
									</div>
									@foreach ($permissions as $item)
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="{{ $item->id }}"
											id="permission-{{$item->id}}" name="permission[]" {{ $item->id_permission	? 'checked' : '' }}>
										<label class="form-check-label" for="permission-{{$item->id}}">
											{{ $item->description }}
										</label>
									</div>
									@endforeach
								</div>
								<button type="submit" class="btn btn-primary">
									Lưu
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('script')
<script>
	$(function () {
 		id_role = {{ $id_role }}
		count = {{ $permissions-> count() }}
 		$(`#tab-${id_role}`).addClass('active')

		$('#check-all').change(function () {
			let status = $(this).is(':checked')
			$(this).parent().siblings().find('input[name="permission[]"]').prop('checked', status)
		})
		$('input[name="permission[]"]').change(function () {
			count_checked = $('input[name="permission[]"]:checked').length
			if (count_checked == count) {
				$('#check-all').prop('checked', true)
			}
			else {
				$('#check-all').prop('checked', false)
			}
		})
	})
</script>
@endsection