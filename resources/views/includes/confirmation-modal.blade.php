<div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-labelledby="ConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <form id="confirmationDelForm" method="POST">            
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="smallBody">
                <div>
                    <!-- the result to be displayed apply here -->
                    @csrf
                    @method('DELETE')
                    <h5 class="text-center">Are you sure you want to delete <p id="name" class="font-weight-bold p-3"> </p> ?</h5>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Confirm</button>
            </div>
        </form>
        </div>
    </div>
</div>