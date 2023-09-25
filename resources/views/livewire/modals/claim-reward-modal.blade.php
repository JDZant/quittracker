<div class="modal fade" id="claimReward" tabindex="-1" role="dialog" aria-labelledby="claimReward" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="claimReward">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Congratulations! You have unlocked a reward!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button wire:click="claim()" class="btn btn-danger">Claim</button>
            </div>
        </div>
    </div>
</div>
