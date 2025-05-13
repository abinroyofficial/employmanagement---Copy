<div class="w3-top w3-bar w3-white w3-padding w3-card w3-wide">
    <a href="/home" class="w3-bar-item w3-button">EMPLOY 365</a>


    <div class="w3-right w3-hide-small">

        @can('view permission')
        <a href="{{ route('permissions.index') }}" class="w3-bar-item w3-button">permissions</a>
        @endcan
        @can('all_attendece')
        <a href="/attendence-all" class="w3-bar-item w3-button">all attendece</a>
        @endcan
        @can('all_employ')
        <a href="/emp_details" class="w3-bar-item w3-button">employ details</a>
        @endcan

        @can('basic')
        @can('create task')
        <a href="/task" class="w3-bar-item w3-button">Tasks</a>
        @endcan
        @can('user task')
        <a href="/view_task" class="w3-bar-item w3-button">view task</a>
        @endcan
        <a href="/salary/{{Auth::user()->id}}" class="w3-bar-item w3-button">salary</a>
        <a href="/attendence-request" class="w3-bar-item w3-button">attendence request</a>
        <a href="/attendence/{{Auth::user()->id}}" class="w3-bar-item w3-button">attendence</a>
        <a href="/view-profile/{{Auth::user()->id}}" class="w3-bar-item w3-button">Profile</a>
        @endcan
        @can('team list')
        <a href="/my-team/{{Auth::user()->id}}" class="w3-bar-item w3-button">My team</a>
        @endcan
        @can('team request')
        <a href="/my-team-requests/{{Auth::user()->id}}" class="w3-bar-item w3-button">team Requests</a>
        @endcan
        <a href="{{ route('logout') }}" class="w3-bar-item w3-button">logout</a>
        <a href="/profile" class="w3-bar-item w3-button">{{ Auth::user()->name }}</a>
    </div>
</div>
