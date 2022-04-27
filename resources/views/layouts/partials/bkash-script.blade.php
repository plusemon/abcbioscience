 <script id="myScript" src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js">
 </script>
 <script>
     var id_token = '';
     var paymentID = '';

     $(document).ready(function() {
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': "{{ csrf_token() }}",
             }
         });


     })

     function bkash_init(amount, invoice_no) {

         $.post("{{ route('token') }}").done(function(res) {
             if (res && res.id_token != null) {
                 console.info('Bkash Merchant account authorized, now you can make payment');
                 id_token = res.id_token;

                 bkash_init2(amount, invoice_no);

                 $('#Loading').fadeOut(function() {
                     $('#bKash_button').fadeIn()
                 });;

             }
         });

     }

     function bkash_init2(amount, invoice_no) {
         bKash.init({
             paymentMode: 'checkout',
             //fixed value ‘checkout’ 
             //paymentRequest format: {amount: AMOUNT, intent: INTENT} 
             //intent options 
             //1) ‘sale’ – immediate transaction (2 API calls) 
             //2) ‘authorization’ – deferred transaction (3 API calls) 
             paymentRequest: {
                 amount, //max two decimal points allowed 
                 intent: 'sale'
             },
             createRequest: function(request) {
                 //request object is basically the paymentRequest object, automatically pushed by the script in createRequest method 

                 $('#bKash_button').fadeOut(function() {
                     $('#Loading').fadeIn()
                 });;

                 $.post("{{ route('createpayment') }}", {
                     id_token,
                     invoice_no
                 }).done(function(data) {
                     if (data && data.paymentID != null) {
                         paymentID = data.paymentID;
                         bKash.create().onSuccess(data);
                         //pass the whole response data in bKash.create().onSucess() method as a parameter 
                     } else {
                         bKash.create().onError();
                     }
                 })
             },
             executeRequestOnAuthorization: function() {
                 $.post("{{ route('executepayment') }}", {
                     id_token,
                     paymentID
                 }).done(function(data) {
                     console.log('Payment successfull:', data)
                     if (data && data.paymentID != null) {
                         $('#paymentGatewaysModal').modal('hide');
                         toastr.success('Payment has been received', 'Thank you');
                         window.location.reload()

                     } else {
                         bKash.execute().onError();
                     }
                 })

             }
         });

         $('#bKash_button').attr('disabled', false);
     }
 </script>
