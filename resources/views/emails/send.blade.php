@component('mail::message')
# Introduction

Dear {{$email->email}},

<div>Mã vé của bạn là : {{$email->ticket_code}}<br></div>
<div>Người đặt : {{$email->customer_name}}<br></div>
<div>Ngày khởi hành :{{\Carbon\Carbon::parse($buse->date_active)->format('d/m/Y')}} <br></div>
<div>Bắt đầu : {{$buse->detailAddressStart}}, {{$buse->startDistrict_name}}, {{$buse->startWard_name}}, {{$buse->startPointName}}<br></div>
<div>Điểm đến : {{$buse->detailAddressEnd}}, {{$buse->endDistrict_name}}, {{$buse->endWard_name}}, {{$buse->endPointName}}<br></div>
<div>Thời gian : {{\Carbon\Carbon::parse($buse->start_time)->format('d/m/Y')}}<br></div>
<div>Giá : {{number_format($email->totalPrice)}}<br></div>
<div>Hình thức thanh toán : {{$email->paymentMethod}}<br></div>
@if ($email->status == 'DONE')
<div>Tình trạng thanh toán: Đã Hoàn Thành<br></div>
@elseif ($email->status == 'WAITING_ACTIVE')
<div>Tình trạng thanh toán: Chưa Thanh Toán<br></div>
@elseif ($email->status == 'ACTIVED')
<div>Tình trạng thanh toán: Đã Thanh Toán<br></div>
@elseif ($email->status == 'REJECTED')
<div>Tình trạng thanh toán: Đã Huỷ<br></div>
@elseif ($email->status == 'DEPOSIT')
<div>Tình trạng thanh toán: Đặt cọc<br></div>
@endif
<div>Ghi chú : {{$email->description}}<br></div>
<div>Số ghế : {{$email->quantity}}<br></div>

<div>** Quý khách xin vui lòng đến trước 15-30 phút !!!</div>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
