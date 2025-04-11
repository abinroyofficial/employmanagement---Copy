<div class="w3-top w3-bar w3-white w3-padding w3-card w3-wide">
    <a href="/home" class="w3-bar-item w3-button">EMPLOY 365</a>


    <div class="w3-right w3-hide-small">

@can('basic')
        <a href="/leave/{{ Auth::user()->id }}" class="w3-bar-item w3-button">Leave</a>
        <a href="/wfh/{{ Auth::user()->id }}" class="w3-bar-item w3-button">work from home</a>
        <a href="/regulization/{{ Auth::user()->id }}" class="w3-bar-item w3-button">absenteeism Regulization</a>
        <a href="/leave-balance/{{ Auth::user()->id }}" class="w3-bar-item w3-button">leave balance</a>
        <a href="/show-request/{{ Auth::user()->id }}" class="w3-bar-item w3-button">view request</a>
        <a href="{{ route('dashboard') }}" class="w3-bar-item w3-button">back</a>



@endcan
    </div>
</div>
