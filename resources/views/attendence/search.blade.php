@foreach ($Users as $user)
<div class="task-items" data-user-id="{{ $user->id }}">
    <p style="color:grey;font-size:20px ;" id="task_name_search">
        <strong>{{ $user->name }}</strong>
    </p>
</div>
@endforeach
