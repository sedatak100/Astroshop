<form action="" method="post">
    @csrf
    <input type="hidden" name="callback" value="confirm" />
<div class="panel">
    <div class="panel panel-heading">Hesap Bilgileri</div>
    <div class="panel panel-body">{!! config('payment_bank_transfer.info') !!}</div>
    <div class="panel panel-footer">Siparişinizin tamamlanabilmesi için yukarıdaki hesap bilgilerine ödeme yapmanız gerekmektedir.</div>
</div>
<button class="btn btn-default icon-left float-right"><span>Siparişi Onayla</span></button>
</form>