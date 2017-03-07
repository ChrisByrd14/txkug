<div class="modal fade c-content-login-form" id="slackInviteRequestModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content c-square">
            <div class="modal-header c-no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="slackInviteRequest">TXKUG Slack Team Invite Request</h4>
            </div>
            <div class="modal-body">
                <p>TXKUG uses Slack to communicate and network with members.</p>

                @include('errors.error')

                {!! Form::open(['route' => ['api.slack-invite-request'], 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::text('name', null, ['class' => 'form-control input-lg c-square', 'placeholder' => 'Name']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::text('email', null, ['class' => 'form-control input-lg c-square', 'placeholder' => 'Email']) !!}
                    </div>
                    <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                    <div class="form-group">
                        <button type="button" class="btn c-btn-blue " data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn c-theme-btn pull-right">Submit</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>