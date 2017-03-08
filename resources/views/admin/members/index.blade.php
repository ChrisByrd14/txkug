@extends('layouts.app')

@section('header_scripts')
    <link href="{{ asset('assets/plugins/datatables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@stop

@section('content')

    @component('sections.breadcrumbs')
        @slot('title')
            Members
        @endslot
    @endcomponent

    @component('layouts.admin-layout')

        @slot('content')

            <div class="c-content-title-1">
                <h3 class="c-font-uppercase c-font-bold">Member Directory</h3>
            </div>
            <div class="c-content-divider c-divider-sm c-theme-bg"></div>

            <table id="users-table" class="table table-hover table-striped display responsive nowrap" cellspacing="0" width="100%">
                <thead class="c-theme-bg">
                <tr>
                    <th colspan='2' class="all c-font-white">Name</th>
                    <th class="min-tablet c-font-white c-center">Role</th>
                    <th class="min-tablet  c-font-white c-center">Joined</th>
                    <th class="min-tablet c-font-white c-center">Attendance</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($members as $member)
                    <tr>
                        <td>
                            <img class="img-circle c-margin-r-40" src="{{ $member->slack_avatar_32 }}">
                        </td>
                        <td>
                            <a href="{{ route('admin.members.show', $member->slug) }}">{{ $member->last_name }}, {{ $member->first_name }}</a>
                        </td>
                        <td class="c-center">{{ title_case($member->role->name ) }}</td>
                        <td class="c-center">
                            {{ $member->created_at->format('m-d-Y') }}
                        </td>
                        <td class="c-center">
                            {{ $member->attendance->count() }}
                        </td>
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
            $('#users-table').DataTable({
                order: [[ 0, "asc" ]],
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@stop

