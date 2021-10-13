@switch($item->status)
  @case($OrderClass::CONFIRMING)
    <span class="text-primary">Đang chờ xử lý</span>
    @break
  @case($OrderClass::DELIVERING)
    <span class="text-warning">Đang giao hàng</span>
    @break
  @case($OrderClass::DELIVERED)
    <span class="text-success">Đã nhận hàng</span>
    @break
  @default
    <span class="text-danger">Đã hủy</span>
@endswitch