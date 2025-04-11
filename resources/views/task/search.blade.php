@foreach ($task_details as $task)
    <div class="task-items" data-task-id="{{ $task->id }}">
        <p style="color:grey;font-size:20px ;text-transform: uppercase" id="task_name_search">
            <strong>{{ $task->task_name }}</strong></p>
        <p id="task_description_search">{{ $task->task_description }}</p>
        @if ($task->user_id == Auth::user()->id)
            <p style="color: red ; font-size:10px">assigned to me</p>
        @endif

    </div>
@endforeach
