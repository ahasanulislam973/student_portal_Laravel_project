<!DOCTYPE html>
<html>
<head>
    <title>student list</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>
<body>
<table class="table">
    <thead class="thead-dark">

    <tr>
        <th>Serial_No</th>
        <th>Student_name</th>
        <th>Courses</th>

    </tr>
    </thead>
    <tbody>
    @php
        $i=1;
    @endphp
    @foreach($courses as $course)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$course->name}}</td>
            <td>@foreach($courses->course as $item)

                    {{$item->course}}
                @endforeach
            </td>


        </tr>
    @endforeach
    </tbody>
</table>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
