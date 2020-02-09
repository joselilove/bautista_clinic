<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><span id="name-modal"></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Blood Pressure <span class="font-weight-bold" id="bp"></span> </p>
                <p>Cardiac Rate <span class="font-weight-bold" id="cr"></span> </p>
                <p>Respiratory Rate <span class="font-weight-bold" id="rr"></span> </p>
                <p>Weight <span class="font-weight-bold" id="w"></span> </p>
            </div>
            <div class='updateSchedule'>
                <?= $this->Form->create(
                    'Users',
                    [
                        'type' => 'post',
                        'onsubmit' => 'disableField()',
                    ]
                ) ?>

                <?= $this->Form->control(
                    'id',
                    [
                        'type' => 'hidden',
                        'class' => 'form-control',
                        'id' => 's_id',
                        'readonly'
                    ]
                ); ?>

                <label>Current Schecdule<span id="currentDate"></span></label>
                <?= $this->Form->control(
                    'rec_date',
                    [
                        'type' => 'text',
                        'class' => 'form-control',
                        'label' => '',
                        'id' => 'date-format',
                        'required',
                        'placeholder' => 'Set new schedule'
                    ]
                ); ?>
                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
                <?= $this->Form->end(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>