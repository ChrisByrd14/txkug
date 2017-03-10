<ul class="c-content-recent-posts-1">
    @if(count($links))
        @foreach($links as $link)
            <li>
                <div class="c-image">
                    {{--<img src="assets/base/img/content/stock/09.jpg" alt="" class="img-responsive"> --}}
                    {!! Form::open(['route' => [ 'members.community-links.votes.store', $link->id ]]) !!}
                        <button class="btn btn-link fa-stack fa-3x" style="top: -.4em;">
                            <i class="fa {{ (Auth::check() && Auth::user()->votedFor($link)) ? 'fa-heart c-theme-color' : 'fa-heart c-font-grey-3' }} fa-stack-2x"></i>
                            <span class="fa-stack-1x fa-inverse c-font-13" style="margin-top: .5em;">{{ $link->votes->count() }}</span>
                        </button>
                    {!! Form::close() !!}
                </div>
                <div class="c-post">
                    <a href="{{ $link->link }}" target="_blank">{{ $link->title }}</a>
                    <div class="small">
                        <a href="\members\community-links\{{ $link->channel->slug }}">
                            <span class="c-font-{{ $link->channel->color }} c-font-uppercase c-font-bold"> {{ $link->channel->title }} </span>
                        </a>
                        &nbsp;<i class="fa fa-circle c-font-10 c-font-grey"></i>&nbsp;
                        {{ $link->updated_at->diffForHumans() }} by <a href="/members/{{ $link->creator->slug }}">{{ $link->creator->name }}</a>
                    </div>
                </div>
            </li>
        @endforeach
    @else
        <li>No Community Links have been submitted yet.</li>
    @endif
</ul>