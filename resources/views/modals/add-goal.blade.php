<div class="modal fade" id="addGoalModal" tabindex="-1" role="dialog" aria-labelledby="failModalLabel"
     aria-hidden="true">
    <input type="hidden" id="modalDate">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="failModalLabel">Add reward</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('goals.store') }}" method="POST">
                <div class="modal-body">
                    <label>Reward</label>
                    <input name="reward" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-hover" data-dismiss="modal">Close</button>
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn bg-blue-custom btn-hover text-white">Confirm</button>
                </div>
            </form>
        </div>
    </div>
    @dump($date)
</div>
