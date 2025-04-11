<div class="w3-top w3-bar w3-white w3-padding w3-card w3-wide">
    <a href="/home" class="w3-bar-item w3-button">EMPLOY 365</a>


    <div class="w3-right w3-hide-small">
        
        
        @can('create task')
        <a href="/add_task/{{Auth::user()->id}}" class="w3-bar-item w3-button">add task</a>
        <a href="/view_task" class="w3-bar-item w3-button">view task</a>
        @endcan
        <a href="{{ route('dashboard') }}" class="w3-bar-item w3-button">back</a>
       
        
        

        
    </div>
</div>