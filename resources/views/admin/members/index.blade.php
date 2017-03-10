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
                    <th class="min-tablet c-font-white c-center">Admin</th>
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
                        <td class="c-center">
                            @if ( $member->hasRole('administrator') )
                                <input type="checkbox" id="user-role-id-{{ $member->id }}" onChange="setUserRole({{ $member->id }});" checked="checked" >
                            @else
                                <input type="checkbox" id="user-role-id-{{ $member->id }}" onChange="setUserRole({{ $member->id }});" >
                            @endif
                        </td>
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

        function setUserRole(id) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var chkBox = document.getElementById('user-role-id-' + id);

            if ( chkBox.checked) {
                var user_has_role = 'administrator';
            }
            else {
                var user_has_role = 'member';
            }
//            console.log(user_has_role);

            $.ajax({
                method: 'POST',
                url: '{{ route('api.set-role') }}',
                data: {'id': id, 'role_name': user_has_role },
            });

        }

        $(document).ready(function() {

            $('#users-table').DataTable({
                order: [[ 0, "asc" ]],
                responsive: true,
                autoWidth: false
            });

            {{--$("[id='has-role']")--}}
                {{--.bootstrapSwitch({--}}
                    {{--onColor: 'danger',--}}
                    {{--onText: 'Admin',--}}
                    {{--offColor: 'primary',--}}
                    {{--offText: 'User'--}}
                {{--})--}}
                {{--.on('switchChange.bootstrapSwitch', function(event, state) {--}}
                    {{--console.log(this.value + ' ' + state);--}}

                    {{--if (state == true) {--}}
                        {{--var role_id = 2;--}}
                    {{--} else {--}}
                        {{--var role_id = 1;--}}
                    {{--}--}}

                    {{--$.ajaxSetup({--}}
                        {{--headers: {--}}
                            {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                        {{--}--}}
                    {{--});--}}

                    {{--$.ajax({--}}
                        {{--method: 'POST',--}}
                        {{--url: '{{ route('api.set-role') }}',--}}
                        {{--data: {'user_id': this.value, 'role_id': role_id },--}}
                    {{--});--}}
                {{--});--}}
            });
    </script>
@stop

