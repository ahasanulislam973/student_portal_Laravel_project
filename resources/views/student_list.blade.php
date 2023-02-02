<!DOCTYPE html>
<html>
<head>
    <title>student list</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin-top:20px">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Student List</h2>

            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif
            @if(Session::has('fail'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('fail')}}
                </div>
            @endif
            <div class="col-12 text-left mt-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Add Student
                </button>
                <button type="button" class="btn btn-primary addcoursebtn text-right">
                    Add Course
                </button>
            </div>

        </div>

        <form method="get" action="{{url('student_list')}}">
            <div class="row my-3">
                <div class="col-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" class="form-control"
                           value="<?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>" placeholder="Name"
                           name="name">
                </div>
                <div class="col-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" id="email" class="form-control"
                           value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>" placeholder="Email"
                           name="email">
                </div>
                <div class="col-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" id="phone" class="form-control" placeholder="Phone"
                           value="<?php echo isset($_GET['phone']) ? $_GET['phone'] : ''; ?>" name="phone">
                </div>
                <div class="col-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address" class="form-control" placeholder="Address"
                           value="<?php echo isset($_GET['address']) ? $_GET['address'] : ''; ?>" name="address">
                </div>
                <div class="col-12 text-right mt-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{'student_list'}}" class="btn btn-danger" role="button"
                       aria-pressed="true">Clear</a>
                </div>
            </div>
        </form>

        <table class="table">
            <thead class="thead-dark">

            <tr>
                <th>Serial_No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>

            </tr>
            </thead>
            <tbody>
            @php
                $i=1;
            @endphp
            @foreach($students as $stu)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$stu->name}}</td>
                    <td>{{$stu->email}}</td>
                    <td>{{$stu->phone}}</td>
                    <td>{{$stu->address}}</td>

                    <td>
                        <button type="button" value="{{$stu->id}}" class="btn btn-primary updatebtn btn-sm">Update
                        </button>
                        |
                        <button type="button" value="{{$stu->id}}" class="btn btn-danger deletebtn btn-sm">Delete
                        </button>
                        |
                        <button type="button" value="{{$stu->id}}" class="btn btn-primary viewcoursebtn btn-sm my-3">
                            View Course
                        </button>
                        |
                        <button type="button" value="{{$stu->id}}" class="btn btn-primary assigncoursebtn btn-sm">Assign
                            Course
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

</div>
{{-- Add Modal--}}
<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center float-right" id="exampleModalLabel">Add Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('save_student')}}" method="post">
                <div class="modal-body">

                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Enter name" value="{{old('name')}}">

                        @error('name')

                        <strong class="text-danger" role="alert">
                            {{$message}}
                        </strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="Enter email" value="{{old('email')}}">

                        @error('email')

                        <strong class="text-danger" role="alert">
                            {{$message}}
                        </strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                               placeholder="Enter phone" value="{{old('phone')}}">

                        @error('phone')

                        <strong class="text-danger" role="alert">
                            {{$message}}
                        </strong>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address"
                                  placeholder="Enter name">{{old('address')}}</textarea>

                        @error('address')

                        <strong class="text-danger" role="alert">
                            {{$message}}
                        </strong>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">

                    <p class="text-danger" id="feedback"></p>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--Close Add Modal--}}

{{--Delete Modal--}}
<div class="modal fade " id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="stu_id" id="stu_id"/>
                <h5>Are you sure to Delete?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="deletedetails()">Delete</button>
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                <input type="hidden" id="deleteid">
            </div>
        </div>
    </div>
</div>
{{--Close Delete Modal--}}

{{--Update Modal--}}
<div class="modal fade " id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog " role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('update_students')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="updateid" name="id">
                    <div class="form-group ">
                        <label for="updatename">Name</label>
                        <input type="text" class="form-control" id="updatename" name="name">
                    </div>
                    <div class="form-group ">
                        <label for="updateemail">Email</label>
                        <input type="text" class="form-control" value="" id="updateemail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="updatephone">Phone</label>
                        <input type="text" class="form-control" value="" id="updatephone" name="phone">
                    </div>
                    <div class="form-group ">
                        <label for="updateaddress">Address</label>
                        <textarea class="form-control" id="updateaddress" name="address" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>
{{--Close Update Modal--}}
{{--Add course Modal--}}
<div class="modal fade " id="addcoursemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Add course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('save_course')}}" method="post">
                <div class="modal-body">
                    <input type="hidden" id="addstuid" name="id">
                    @csrf
                    <div class="form-group">
                        <label for="coursename">Course</label>
                        <input type="text" id="coursename" class="form-control" name="coursename"/>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>
{{--Close Add course Modal--}}

{{--view course Modal--}}
<div class="modal fade " id="viewcoursemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog " role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Courses</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @csrf
            <div class="modal-body">
                <div class="form-group ">

                    <table class="table">
                        <thead class="thead-dark">

                        <tr>

                            <th>Course_id</th>
                            <th>Course</th>

                        </tr>
                        </thead>
                        <tbody id="info">

                        </tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="closeviewmodal()">Close</button>

            </div>

        </div>
    </div>
</div>
{{--Close view course Modal--}}

{{--Assign course Modal--}}
<div class="modal fade " id="assigncoursemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Assign course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('assign_course')}}" method="post">
                <div class="modal-body">
                    <input type="hidden" id="studentid" name="studentid">
                    @csrf
                    <div class="form-group">
                        <label for="address">Course</label>
                        <select class="form-control" name="assigncourseid" id="assigncourseid">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{$course->id}}">{{$course->course_name}}</option>
                            @endforeach
                        </select>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Assign</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>
{{--Close Assign course Modal--}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>

<script>


    $(document).ready(function () {
        //Delete
        $(document).on('click', '.deletebtn', function () {
            var stu_id = $(this).val();
            $('#deleteid').val(stu_id);
            $('#deletemodal').modal('show')

        });

//    UPDATE

        $(document).on('click', '.updatebtn', function () {
            var stu_id = $(this).val();
            $('#updatemodal').modal('show')

            $.ajax({
                method: "GET",
                url: '/edit_student/' + stu_id,
                success: function (response) {
                    $('#updateid').val(response.student.id);
                    $('#updatename').val(response.student.name);
                    $('#updatephone').val(response.student.phone);
                    $('#updateemail').val(response.student.email);
                    $('#updateaddress').val(response.student.address);
                }
            });
        });

        //    Add course
        $(document).on('click', '.addcoursebtn', function () {
            var s_id = $(this).val();
            // $('#addstuid').val(s_id);
            $('#addcoursemodal').modal('show')

        });

        //view course
        $(document).on('click', '.viewcoursebtn', function () {
            var id = $(this).val();
            $('#viewcoursemodal').modal('show')

            $.ajax({
                method: "GET",
                url: '/view_course/' + id,
                success: function (response) {
                    $('#coursename_view').val(response.viewcourse);
                    var details = response.viewcourse;

                    $.each(details, function (data) {

                        $("#info").append("<tr>" + "<td>" + response.viewcourse[data].id + "</td><td>" + response.viewcourse[data].course.course_name + "</td>" + "</tr");
                    });
                }
            });
        });

        //    Assign course
        $(document).on('click', '.assigncoursebtn', function () {
            var s_id = $(this).val();
            $('#studentid').val(s_id);
            $('#assigncoursemodal').modal('show')

        });

    });

    function deletedetails() {
        var hiddendata = $('#deleteid').val();
        $.ajax({
            method: "GET",
            url: '/delete_student/' + hiddendata,
            success: function (response) {

                $('#deletemodal').modal('hide');
                window.location.reload();
            }
        });
    }

    function closeviewmodal() {
        $('#viewcoursemodal').modal('hide')
        window.location.reload();
    }
</script>
</body>
</html>
