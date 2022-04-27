 <!-- Modal -->
 <div class="modal fade" id="paymentGatewaysModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
      aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Select Payment Method</h5>
                 <button type="button" class="btn" data-dismiss="modal" aria-label="Close">X</button>
             </div>
             <div class="modal-body">
                 <h1 id="Loading" class="text-center p-5">Please wait..</h1>
                 <button class="btn border" style="display: none" id="bKash_button">
                     <img width="100" src="{{ asset('public/images/website/Bkash-logo.png') }}" alt="">
                 </button>
             </div>
         </div>
     </div>
 </div>
