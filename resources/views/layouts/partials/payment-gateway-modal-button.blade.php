<button onclick="bkash_init('{{ $amount }}','{{ $invoice_no }}')" class="btn btn-success nowrap" data-toggle="modal"
        data-target="#paymentGatewaysModal">
    <i class="fa fa-money-bill"></i>
    {{ $btn_text ?? '$btn_text' }}
</button>
