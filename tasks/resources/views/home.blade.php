@include('header');

@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show">
    <strong>Ooops!</strong>{{ session()->get('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show">
        <strong>Success!</strong> {{ session()->get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
<section class="welcome p-t-10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title-4">Welcome 
                    <span>{{ Auth::user()->name}}</span>
                </h1>
                <hr class="line-seprate">
            </div>
        </div>
    </div>
</section>
<!-- END WELCOME-->

<!-- STATISTIC-->
<section class="statistic statistic2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--green">
                    <h2 class="number">{{$usera}}</h2>
                    <span class="desc">Pending tasks</span>
                    <div class="icon">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--orange">
                    <h2 class="number">{{$complited1}}</h2>
                    <span class="desc">Completed tasks</span>
                    <div class="icon">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--blue">
                    <h2 class="number">{{$half}}</h2>
                    <span class="desc">Half done tasks</span>
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--red">
                    <h2 class="number">{{$members}}</h2>
                    <span class="desc">Assignable members</span>
                    <div class="icon">
                        <i class="zmdi zmdi-money"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END STATISTIC-->

<section class="p-t-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35">Data Table</h3>
               
                <button class="au-btn au-btn-icon au-btn--green au-btn--small" id="addButton">
                    <i class="zmdi zmdi-plus"></i>add Task
                </button>
                <div class="table-responsive table-responsive-data2">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>Description</th>
                                <th>Urgency</th>
                                <th>Due Date</th>
                                <th>Assigned To</th>
                                <th>Comments</th>
                                <th>Status</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($kioko as $task)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $task->taskname }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->urgency == 1 ? 'High' : 'Low' }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->comments }}</td>
                                <td>
                                    @if($task->status == 0)
                                        Pending
                                    @elseif($task->status == 2)
                                        Half done
                                    @else
                                        Complete
                                    @endif
                                </td>
                                <td>
                                   @php $ida = $task->id; @endphp
    <a href="/edittasks?id={{$task->ida}}">edit</a> || 
    <i style="color:red">
        <a onclick="return confirm('Are you sure you want to delete this task?');" href="/deletetasks?id={{$task->ida}}" style="color:red">Delete</a>|| 
        <a href="/assigntask?id={{$task->ida}}" style="color:green">Re assign</a>
    </i>
</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="popupForm" class="popup-form">
    <button class="close-btn" style="position: absolute; top: 10px; right: 10px; font-size: 20px; background: red; border: none; cursor: pointer; color: #555;">&times;</button>
    <h2>Add Task</h2>
   
                                            
    <form action="/createtask" method="post" novalidate="novalidate">
        <input  type="hidden" name="_token" value="{{csrf_token()}}" >
        <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Task name</label>
            <input id="cc-pament" name="taskname" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
        </div>
        <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Description</label>
            <input id="cc-pament" name="description" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
        </div>
        <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Comment</label>
            <input id="cc-pament" name="comments" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
        </div>
        <div class="form-group">
            <label for="cc-number" class="control-label mb-1">Assigned to</label>
            <select id="group" name="assigned_to" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" required>
                <option value="">select who to assign to</option>
                 @foreach($us as $usersd)
        @if($usersd->status == 1)

        <option value="{{ $usersd->id }}">{{ $usersd->name }}</option>
        @else
            <option value="{{ $usersd->id }}" disabled>{{ $usersd->name }} (Inactive)</option>
        @endif
    @endforeach
                
            </select>
            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
        </div>
        <div class="form-group">
            <label for="cc-number" class="control-label mb-1">Urgency</label>
            <select id="group" name="urgency" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" required>
                <option value="">Urgency</option>
                <option value="1"> High</option>
                <option value="2" >Low </option>
            </select>
            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
        </div>
        <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Due Date</label>
            <input id="cc-pament" name="due_date" type="date" class="form-control" aria-required="true" aria-invalid="false" required>
        </div>
        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
            <span id="payment-button-amount">ADD TASK</span>
            <span id="payment-button-sending" style="display:none;">registering…</span>
        </button>
    </form>
</div>



<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });

    $(document).ready(function() {
        // Check if flash messages container exists
        if ($('#flash-messages').length) {
            // Loop through each flash message
            $('#flash-messages').children().each(function() {
                // Fade in flash message
                $(this).fadeIn();

                // Set a timeout to fade out the flash message after 5 seconds
                setTimeout(() => {
                    $(this).fadeOut();
                }, 5000);
            });
        }
    });
</script>

@include('footer');
