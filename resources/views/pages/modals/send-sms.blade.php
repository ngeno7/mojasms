<div class="modal fade" id="sendMessageModal" 
    data-bs-backdrop="static" data-bs-keyboard="false" 
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Send SMS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="form-send-sms" method="POST" action="{{ route('send-sms') }}" class="row">
            @csrf
            <div class="col-12">
                <label for="grid-phone-no" class="form-label">Phone No:</label>
                <input type="number" required 
                    class="form-control form-control-sm" 
                    value="254751148166"
                    name="phone" id="grid-phone-no">
            </div>
            <div class="col-12">
                <label for="grid-message" class="form-label"></label>
                <textarea name="message" id="grid-message" 
                    cols="30" rows="2" 
                    class="form-control form-control-sm">Hello World</textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" 
            class="btn btn-sm btn-secondary" 
            data-bs-dismiss="modal">Close</button>
        <button type="submit" 
            form="form-send-sms" 
            class="btn btn-sm btn-primary">Send SMS</button>
      </div>
    </div>
  </div>
</div>