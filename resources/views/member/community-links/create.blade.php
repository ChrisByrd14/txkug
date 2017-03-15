<h3 class="c-font-uppercase c-font-bold">Contribute a Link</h3>

<div class="panel panel-default">
    <div class="panel-body">
        <form method="post" action="/members/community-links">
            {{ csrf_field() }}

            <div class="form-group {{ $errors->has('channel_id') ? 'has-error' : '' }}">
                <select class="form-control" name="channel_id">
                    <option selected disabled>Select a Channel ...</option>
                    @foreach ($channels as $channel)
                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                            <i class="fa fa-square"></i> {{ $channel->title }}
                        </option>
                    @endforeach
                </select>
                {!! $errors->first('channel_id', '<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <input type="text"
                       class="form-control"
                       name="title" id="title"
                       placeholder="What is the title of your link?"
                       value="{{ old('title') }}"
                       required>

                {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
                <input type="text"
                       class="form-control"
                       name="link" id="link"
                       placeholder="What is the URL?"
                       value="{{ old('link') }}"
                       required>

                {!! $errors->first('link', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Contribute Link</button>
            </div>
        </form>
    </div>
</div>
