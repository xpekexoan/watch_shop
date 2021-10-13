@extends('admin.master')
@section('title')
Quản lý sản phẩm
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
                    <p class="card-title mr-3">Chi tiết sản phẩm</p>
                    <a href="{{ route('admin.product.create') }}" class="btn btn-success">Tạo mới</a>
                  </div>
                </div>

                <div class="card-body">
                  <form method="POST" action="{{ route('admin.product.update', ['id' => $product->id]) }}" enctype="multipart/form-data" id="form-product">
                    @csrf
                    @method('put')
                    <div class="form-row">
                      {{-- Name --}}
                      <div class="form-group col-md-3">
                        <label>ID</label>
                        <input type="text" class="form-control" value="{{ $product->id }}" disabled>
                      </div>

                      <div class="form-group col-md-3">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                          <option value="1">Hiển thị</option>
                          <option value="0" @if (!$product->status) selected @endif>Ẩn</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>
                    <div class="form-row">
                      {{-- Name --}}
                      <div class="form-group col-md-3">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                          name="name" value="{{ old('name') ?? $product->name }}" required>
                        @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>

                      <div class="form-group col-md-3">
                        <label for="price">Giá</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                          name="price" value="{{ number_format(old('price') ?? $product->price) }}" data-type="currency" placeholder="đ" required>
                        @error('price')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      {{-- Warranty --}}
                      <div class="form-group col-md-3">
                        <label for="warranty">Thời gian bảo hành</label>
                        <input type="number" class="form-control @error('warranty') is-invalid @enderror" id="warranty" name="warranty"
                          value="{{ old('warranty') ?? $product->warranty }}" placeholder="tháng" required>
                        @error('warranty')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>

                    <div class="form-row">
                      {{-- Thumbnail --}}
                      <div class="form-group col-md-6">
                        <label for="file1">Hình ảnh chính</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input name="image" type="file"
                              class="custom-file-input @error('image') is-invalid @enderror" id="file1" accept="image/*" required>
                            <label class="custom-file-label" for="file1">Choose file</label>
                          </div>
                        </div>
                        @error('image')
                        <div class="invalid-feedback d-block">
                          {{ $message }}
                        </div>
                        @enderror
                        <div id="preview-image1" class="preview-image preview-product d-flex flex-wrap">
                          <div class="contain-image">
                            <img src="{{ asset('storage/'.$product->image) }}" class="image" alt="">
                          </div>
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <label for="file2">Các hình ảnh bổ sung:</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input name="image_detail[]" type="file" class="custom-file-input 
                            @error('image_detail.*') is-invalid @enderror" id="file2" multiple accept="image/*">
                            <label class="custom-file-label" for="file2">Choose file</label>
                          </div>
                        </div>
                        @error('image_details.*')
                        <div class="invalid-feedback d-block">
                          {{ $message }}
                        </div>
                        @enderror
                        <div id="preview-image2" class="preview-image preview-product d-flex flex-wrap">
                          @foreach ($product->image_detail as $item)
                          <div class="contain-image">
                            <img src="{{ asset('storage/'.$item) }}" class="image" alt="">
                          </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-row">
                      {{-- Category --}}
                      <div class="form-group col-md-3">
                        <label for="category">Danh mục</label>
                        <select id="category" class="form-control @error('id_category') is-invalid @enderror" name="id_category">
                          @foreach ($categories as $item)
                            @if ($item->id == $product->category->id)
                              <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                            @else
                              <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endif
                          @endforeach
                        </select>
                        @error('id_category')
                        <div class="invalid-feedback d-block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      
                      {{-- Brand --}}
                      <div class="form-group col-md-3">
                        <label for="brand">Thương hiệu</label>
                        <select id="brand" class="form-control @error('id_cat_sub') is-invalid @enderror" name="id_brand">
                          @foreach ($brands as $item)
                            @if ($item->id == $product->brand->id)
                              <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                            @else
                              <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endif
                          @endforeach
                        </select>
                        @error('id_brand')
                        <div class="invalid-feedback d-block">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>


                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="chongnuoc">Chống nước</label>
                        <input type="text" class="form-control @error('chongnuoc') is-invalid @enderror" id="chongnuoc" name="chongnuoc"
                          value="{{ old('chongnuoc') ?? $product->chongnuoc }}">
                        @error('chongnuoc')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="chatlieukinh">Chất liệu kính</label>
                        <input type="text" class="form-control @error('chatlieukinh') is-invalid @enderror" id="chatlieukinh" name="chatlieukinh"
                          value="{{ old('chatlieukinh') ?? $product->chatlieukinh }}">
                        @error('chatlieukinh')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="chatlieuday">Chất liệu dây</label>
                        <input type="text" class="form-control @error('chatlieuday') is-invalid @enderror" id="chatlieuday" name="chatlieuday"
                          value="{{ old('chatlieuday') ?? $product->chatlieuday }}">
                        @error('chatlieuday')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="chatlieuvo">Chất liệu vỏ</label>
                        <input type="text" class="form-control @error('chatlieuvo') is-invalid @enderror" id="chatlieuvo" name="chatlieuvo"
                          value="{{ old('chatlieuvo') ?? $product->chatlieuvo }}">
                        @error('chatlieuvo')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Bảng màu</label>
                      <button class="btn btn-default" id="btn-add">+</button>

                      <table class="table" id="table-color">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Màu</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá cộng thêm</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($product->colors as $item)
                            <tr class="color">
                              <th scope="row">{{$loop->index + 1}}</th>
                              <td>
                                <div class="form-group">
                                  <select id="color" class="form-control" name="color[{{ $loop->index }}][id_color]" required>
                                    @foreach ($colors as $itemColor)
                                      @if ($item->id_color == $itemColor->id)
                                        <option value="{{ $itemColor->id }}" selected>{{ $itemColor->name }}</option>
                                      @else
                                        <option value="{{ $itemColor->id }}">{{ $itemColor->name }}</option>
                                      @endif
                                    @endforeach
                                  </select>
                                </div>
                              </td>
                              <td>
                                <input type="number" class="form-control w-50" id="qtyColor" name="color[{{ $loop->index }}][qty]" 
                                  min="1000" required value="{{ $item->qty }}">
                              </td>
                              <td>
                                <input type="text" class="form-control w-50" id="priceColor" name="color[{{ $loop->index }}][price_plus]"
                                  data-type="currency" value="{{ number_format($item->price_plus) }}" min="0" required>
                              </td>
                              <td>
                                <a href="#" onclick="remove(this,event)"><i class="fas fa-trash"></i></a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                    <div class="form-group">
                      <label for="description">Mô tả</label>
                      <textarea class="form-control" id="description" rows="4" name="description">
                        {{ old('description') ?? $product->description }}
                      </textarea>
                    </div>

                  <button type="submit" class="btn btn-primary pr-4 pl-4" id="btn-submit">Lưu</button>
                </form>

                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
  {{-- Modal Supplier --}}
</section>
@endsection

@section('link_css')
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('admin/js/preview-image.js') }}"></script>
<script src="{{ asset('admin/js/currency.js') }}"></script>
<script src="{{ asset('js/ajax.js') }}"></script>
<script>
  $(function () {
    $('#description').summernote({
      minHeight: 250,
      maxHeight: 500,
    })

    imagePreview('#file1');
    imagePreview('#file2');
    bsCustomFileInput.init();

    var arrColor = []

    $('#btn-add').click(function(e) {
      e.preventDefault()
      loadColor()
    })
    setFormatCurrency()

    $('#btn-submit').click(function(e) {
      e.preventDefault()
      let arrColor = []
      let colors = $('tr.color').each(function() {
        arrColor.push($(this).find('select[name$="[id_color]"]').val())
      })
      let checkUnique = arrColor.every(function(item, index, self) {
        return self.indexOf(item) === index;
      })

      if (colors.length == 0) {
        toastr.error('Vui lòng chọn màu cho sản phẩm!');
        return;
      }

      if (!checkUnique) {
        toastr.error('Không được chọn trùng màu trên sản phẩm!');
        return;
      }
      $('#form-product').submit()
    })
  })

  function remove(elm, e) {
    e.preventDefault()
    $(elm).closest('tr').remove()
  }

  function loadColor() {
    const URL = `{{ route('admin.color.all') }}`
    ajax(URL, {}, 'GET', function(result) {
      let stt = $('#table-color > tbody > tr').length + 1
      let optionString = result.map(function(item) {
        return `<option value="${item.id}">${item.name}</option>`
      }).join('')
      let row = `<tr class="color">
                    <th scope="row">${stt}</th>
                    <td>
                      <div class="form-group">
                        <select id="color" class="form-control" name="color[${stt-1}][id_color]" required>
                          ${optionString}
                        </select>
                      </div>
                    </td>
                    <td>
                      <input type="number" class="form-control w-50" id="qtyColor" name="color[${stt-1}][qty]" 
                        min="1000" required>
                    </td>
                    <td>
                      <input type="text" class="form-control w-50" id="priceColor" name="color[${stt-1}][price_plus]"
                        data-type="currency" value="0" min="0" required>
                    </td>
                    <td>
                      <a href="#" onclick="remove(this,event)"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>`
      $('#table-color').append(row)
      setFormatCurrency()
    })
  }
  function setFormatCurrency() {
    $("input[data-type='currency']").on({
      'input propertychange': function () {
        var currency = $(this).val()
        $(this).val(currency.replaceAll(/\.|\,/g,""))
        formatCurrency($(this));
      },
      blur: function () {
        var currency = $(this).val()
        $(this).val(currency.replaceAll(/\.|\,/g,""))
        formatCurrency($(this), "blur");
      },
      focus: function () {
        $(this).select();
      }
    });
    $("#form-product").submit(function() {
      $("input[data-type='currency']").each(function() {
        $(this).val($(this).val().replaceAll(",",""))
      });
    })
  }
</script>
@stack('js')
@endsection
