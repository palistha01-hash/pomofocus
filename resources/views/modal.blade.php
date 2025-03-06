<div id="backendModal" class="modal custom-modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" id="moveableDialog">
        <div class="modal-content" id="resizeableContent">
            <div class="modal-header modal-drag-handle">
                <h5 class="modal-title appOption-title ">Edit Employee</h5>
                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body formContainer">

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="buttons d-flex submit-section">
                    <div class="btn-container pr-lg-3 pr-0 pb-3 pb-lg-0">
                        <button type="button" class="btn cancel-modal-btn justify-content-center pq-reset-btn closeModal" data-dismiss="modal"
                        aria-label="Close">Cancel</button>
                    </div>
                    <div class="btn-container">
                        <button type="button" id="saveBtn" class="btn btn-primary  submit-btn mb-2 mb-md-0">Save</button>
                    </div>
                </div>
                <div id="lastUpdater" style="display:none" data-html="true" data-toggle="tooltip" data-placement="top">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
      <div class="flashMessage"></div>
    </div>
</div>
