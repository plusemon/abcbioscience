


    /*
    |------------------------------------------------
    | payment method
    |-----------------------------------------
    */
        $(document).on('change','.payment_method_id_class',function() {
            var method_id = ($(this).val());
            if(method_id == 1)
            {
                $('.payment_account_div').hide();
                $('.card_div').hide();
                $('.cheque_div').hide();
                $('.bank_transfer_div').hide();
                $('.custom_payment_div').hide();
                $('.from_mobile_banking_account_div').hide();
            }
            else if(method_id == 2)
            {
                $('.payment_account_div').show();
                $('.card_div').hide();
                $('.cheque_div').hide();
                $('.bank_transfer_div').hide();
                $('.custom_payment_div').hide();
                $('.from_mobile_banking_account_div').hide();
            }
            else if(method_id == 3)
            {
                $('.payment_account_div').show();
                $('.card_div').hide();
                $('.cheque_div').show();
                $('.bank_transfer_div').hide();
                $('.custom_payment_div').hide();
                $('.from_mobile_banking_account_div').hide();
            }
            else if(method_id == 4)  //mobile banking
            {
                $('.payment_account_div').show();
                $('.from_mobile_banking_account_div').show();
                $('.card_div').hide();
                $('.cheque_div').hide();
                $('.bank_transfer_div').hide();
                $('.custom_payment_div').hide();
            }
            else if(method_id == 5)
            {
                $('.payment_account_div').show();
                $('.card_div').hide();
                $('.cheque_div').hide();
                $('.bank_transfer_div').show();
                $('.custom_payment_div').hide();
                $('.from_mobile_banking_account_div').hide();
            }
            else if(method_id == 5)
            {
                $('.payment_account_div').show();
                $('.card_div').hide();
                $('.cheque_div').hide();
                $('.bank_transfer_div').hide();
                $('.custom_payment_div').hide();
            }
            else if(method_id == 6)
            {
                $('.payment_account_div').show();
                $('.card_div').show();
                $('.cheque_div').hide();
                $('.bank_transfer_div').hide();
                $('.custom_payment_div').hide();
                $('.from_mobile_banking_account_div').hide();
            }
            else if(method_id == 7)
            {
                $('.payment_account_div').show();
                $('.custom_payment_div').show();
                $('.card_div').hide();
                $('.cheque_div').hide();
                $('.bank_transfer_div').hide();
                $('.from_mobile_banking_account_div').hide();
            }
            else if(method_id == 8)
            {
                $('.payment_account_div').show();
                $('.custom_payment_div').hide();
                $('.card_div').hide();
                $('.cheque_div').hide();
                $('.bank_transfer_div').hide();
                $('.from_mobile_banking_account_div').hide();
            }
            else{
                $('.payment_account_div').hide();
                $('.card_div').hide();
                $('.cheque_div').hide();
                $('.bank_transfer_div').hide();
                $('.custom_payment_div').hide();
                $('.from_mobile_banking_account_div').hide();
            }
        });
    /*
    |-----------------------------
    | payment method End
    |------------------------------------------------------------
    */


    /*
    |----------------------------------------------------------
    | get bank account by  payment method id by ajax call
    |------------------------------------------------
    */
        $(document).on('change','.payment_method_id_class',function(){
            var id = $(this).val();
            var url = $('.getAccountByPaymentMethod').val(); 
            $.ajax({
                    url: url,
                    type: "GET",
                    data:{id:id},
                    datatype:"JSON",
                    beforeSend:function(){
                        //$('.loading').fadeIn();
                    },
                    success: function(response){
                        $('.bank_id_class').html(response);
                    },
                    complete:function(){
                        //$('.loading').fadeOut();
                    },
                });
        });
    /*
    |---------------------------------------------
    | get bank account by  payment method id by ajax call
    |-------------------------------------------------------------
    */








    $(document).on('keyup','.payment_amount',function(){
        var paid_amount = nanCheck(parseFloat($('.paid_amount').val()));
        var pay_now     = nanCheck(parseFloat($(this).val()));
        var due_amount  = (paid_amount  - pay_now).toFixed(2) ;
        $('.total_due_amount_after_payment_class').val(due_amount);
    });

    $(document).on('change','.payment_method_id_class',function(){
        var id = $(this).val();
        $('.submitButton').attr('disabled','disabled');
        if(id)
        {
            $('.submitButton').removeAttr('disabled','disabled');
        }else{
            $('.submitButton').attr('disabled','disabled');
        }
    });









    /*
    |-----------------------------------------------------------------
    | Nan Check
    |-------------------------------------------------------------
    */
        function nanCheck(val)
        {
            var nanResult = 0;
            if(isNaN(val)) {
                nanResult = 0;
            }
            else{
                nanResult = val;
            }
            return nanResult;
        }
    /*
    |-----------------------------------------------------------------
    | Nan Check
    |-------------------------------------------------------------
    */
