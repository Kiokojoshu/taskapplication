@include('header');
<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
           body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .form-group {
            flex: 1;
            margin-right: 10px;
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .item-row-template {
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .remove-item {
            background-color: #ff0000;
            color: #fff;
            border: none;
            padding: 6px; /* Adjust the button's height */
            cursor: pointer;
            margin-left: 10px;
            border-radius: 5px; 
            height: 100%;
            /* Add border-radius for a better look */
        }

        .remove-item:hover {
            background-color: #cc0000;
        }

        #add-item {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
        }

        .submit-button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="row m-t-30">
    <div class="col-md-12">
        <div class="container">
            <h1>Edit Tasks</h1>
            @if(session()->has('error'))
            <div class="msg">
                {{ session()->get('error') }}
            </div>
            @endif
            @if(session()->has('message'))
            <div class="error">
                {{ session()->get('message') }}
            </div>
            @endif
            <form action="/edittasks" method="post" >
                @csrf
              
                <input type="hidden" name="code" value="{{request()->id}}">

                  @foreach($kioko1 as $user2)
                <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Task name</label>
            <input id="cc-pament" name="taskname" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$user2->taskname}}" required>
        </div>
        <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Description</label>
            <input id="cc-pament" name="description" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$user2->description}}" required>
        </div>
        <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Comment</label>
            <input id="cc-pament" name="comments" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$user2->comments}}" required>
        </div>

         <div class="form-group">
            <label for="cc-number" class="control-label mb-1">Assigned to </label>
            <select id="group" name="assigned_to" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" required>
                <option value="{{ $user2->id }}">{{$user2->name}}</option>

               @foreach($option as $user3) 
                
        @if($user3->status == 1)


        <option value="{{ $user3->id }}">{{ $user3->name }}</option>
        @else
            <option value="{{ $user3->id }}" disabled>{{ $user3->name }} (Inactive)</option>
        @endif
  
               @endforeach 
            </select>
            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
        </div>
        
               
        
        <div class="form-group">
            <label for="cc-number" class="control-label mb-1">Urgency</label>
            <select id="group" name="urgency" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error" required>
                <option value="{{$user2->urgency}}">{{ $user2->urgency == 1 ? 'High' : 'Low' }}</option>
                <option value="1"> High</option>
                <option value="2" >Low </option>
            </select>
            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
        </div>
        <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Due Date</label>
            <input id="cc-pament" name="due_date" type="date" class="form-control" aria-required="true" aria-invalid="false" value="{{$user2->due_date}}" required>
        </div>
                @endforeach

               
               
               
              
                <button type="submit" class="submit-button">Submit</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        // Function to add a new invoice item row
        $("#add-item").click(function () {
            // Create a new row
            var newRow = $(".item-row-template").clone();
            newRow.removeClass("item-row-template"); // Remove the template class
            newRow.show(); // Make it visible

            // Reset input values for the newly added row
            $("input[type='text']", newRow).val("");
            $("input[type='number']", newRow).val("");

            // Append the new row to the invoice items container
            $("#invoice-items").append(newRow);

            // Add a click event to remove the new row if needed
            $(".remove-item", newRow).click(function () {
                newRow.remove();
            });
        });

        // Function to remove an existing row
        $(".remove-item").click(function () {
            $(this).closest(".item-row").remove();
        });
    });
</script>



</body>
</html>
@include('footer');
