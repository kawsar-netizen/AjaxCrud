<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax Crud operation</title>
    <link rel="stylesheet" href="{{ asset('css') }}/app.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div style="padding:30px;"></div>
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Teacher</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Institute</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                        <td>1</td>
                                        <td>Kawser</td>
                                        <td>Developer</td>
                                        <td>Digital Decoder Ltd.</td>
                                        <td>

                                            <button type="submit" class="btn btn-primary btn-sm">edit</button>
                                            <button type="submit" class="btn btn-danger btn-sm">delete</button>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <span id="addTeacher">Add New Teacher</span>
                            <span id="updateTeacher">Update Teacher</span>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" class="form-control" placeholder="Enter Name">
                            </div><br>
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control" placeholder="Enter Name">
                            </div><br>
                            <div class="form-group">
                                <label for="">Institute</label>
                                <input type="text" class="form-control" placeholder="Enter Name">
                            </div><br>

                            <button type="submit" id="addB" class="btn btn-primary btn-sm">Add</button>
                            <button type="submit" id="updateB" class="btn btn-primary btn-sm">Update</button>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#addTeacher').show();
        $('#updateTeacher').hide();
        $('#addB').show();
        $('#updateB').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta [name="csrf-token"]').attr('content')
            }

        })

        function alldata() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "teacher/all",
                success: function(response) {
                    var data = ""
                    $.each(response, function(key, value) {

                        data = data + "<tr>"
                        data = data + "<td>"+value.id+"</td>"
                        data = data + "<td>"+value.name+"</td>"
                        data = data + "<td>"+value.title+"</td>"
                        data = data + "<td>"+value.institute+"</td>"
                        data = data + "<td>"
                        data = data + "<button type='submit' class='btn btn-primary btn-sm mr-2'>edit</button>"
                        data = data + "<button type='submit' class='btn btn-danger btn-sm mr-2'>delete</button>"
                        data = data + "</td>"
                        data = data + "</tr>"
                    })
                    $('tbody').html(data);
                }
            })
        }
        alldata();
    </script>
</body>

</html>
