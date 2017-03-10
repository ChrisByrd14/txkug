@extends('layouts.app')

@section('header_scripts')
    <link href="{{ asset('assets/plugins/datatables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@stop

@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            Community Links
        @endslot
    @endcomponent

    @component('layouts.admin-layout')
        @slot('content')
            <div class="c-content-title-1">
                <h3 class="c-font-uppercase c-font-bold">Community Links</h3>
            </div>
            <div class="c-content-divider c-divider-sm c-theme-bg"></div>

            <table id="community-links-table" class="table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
                <thead class="c-theme-bg">
                    <tr>
                        <th class="c-font-white c-center">Channel</th>
                        <th class="c-font-white">Title</th>
                        <th class="c-font-white c-center">Approved</th>
                        <th class="c-font-white">Link</th>
                        <th class="c-font-white">Contributor</th>
                        <th class="c-font-white">Submitted</th>
                    </tr>
                </thead>
            <tbody>
            @foreach ($links as $link)
                <tr>
                    <td>{{ $link->channel->title }}</td>
                    <td>{{ $link->title }}</td>
                    <td class="c-center">
                        @if ( $link->approved  == 1 )
                            <input type="checkbox" id="link-approved" data-size="mini" value="{{ $link->id }}" checked="checked" >
                        @else
                            <input type="checkbox" id="link-approved" data-size="mini" value="{{ $link->id }}">
                        @endif
                    </td>
                    <td><a href="{{ $link->link }}" target="_blank">{{ $link->link }}</a></td>
                    <td>{{ title_case($link->creator->name) }}</td>
                    <td>{{ $link->updated_at->format('m-d-Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endslot
    @endcomponent

@stop

@section('footer_scripts')
    <script src="{{ asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/datatables/media/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/datatables/extensions/Responsive/js/responsive.bootstrap.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#community-links-table').DataTable({
                order: [[ 3, "asc" ]],
                lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],
                responsive: true,
                autoWidth: false
            });

            $("[id='link-approved']")
                .bootstrapSwitch({
                    onColor: 'primary',
                    onText: 'Yes',
                    offColor: 'danger',
                    offText: 'No'
                })
                .on('switchChange.bootstrapSwitch', function(event, state) {
                    console.log(this.value + ' ' + state);

                    if (state == true) {
                        var link_status = 1;
                    } else {
                        var link_status = 0;
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        method: 'POST',
                        url: '{{ route('api.approve-community-link') }}',
                        data: {'link_id': this.value, 'approved': link_status },
                    });
                });
        });
    </script>
@stop

