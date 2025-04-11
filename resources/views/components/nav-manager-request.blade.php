<div class="w3-top w3-bar w3-white w3-padding w3-card w3-wide">
    <a href="/home" class="w3-bar-item w3-button">EMPLOY 365</a>


    <div class="w3-right w3-hide-small">
        
        
        @can('team request')
        <a href="/my-team-requests/{{Auth::user()->id}}" class="w3-bar-item w3-button">leave request</a>
        <a href="/my-team-requests-wfh/{{Auth::user()->id}}" class="w3-bar-item w3-button">work from home </a>
        <a href="/my-team-requests-regulisation/{{Auth::user()->id}}" class="w3-bar-item w3-button">regulization</a>
        
        <a href="{{ route('dashboard') }}" class="w3-bar-item w3-button">back</a>
        
        @endcan
        
    </div>
</div>