<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax Crud operation</title>
    <link rel="stylesheet" href="{{ asset('css') }}/app.css">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
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
                                <input type="text" class="form-control" id="name" placeholder="Enter Name">
                                <span class="text-danger" id="nameError"></span>
                            </div><br>
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Job Position">
                                <span class="text-danger" id="titleError"></span>
                            </div><br>
                            <div class="form-group">
                                <label for="">Institute</label>
                                <input type="text" class="form-control" id="institute" placeholder="Institute Name">
                                <span class="text-danger" id="instituteError"></span>
                            </div><br>
                            <input type="hidden" id="id">
                            <button type="submit" id="addB" onclick="addDate()"
                                class="btn btn-primary btn-sm">Add</button>
                            <button type="submit" id="updateB" onclick="updateDate()"
                                class="btn btn-primary btn-sm">Update</button>


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
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // all data read Start
        function alldata() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "teacher/all",
                success: function(response) {
                    var data = ""
                    $.each(response, function(key, value) {

                        data = data + "<tr>"
                        data = data + "<td>" + value.id + "</td>"
                        data = data + "<td>" + value.name + "</td>"
                        data = data + "<td>" + value.title + "</td>"
                        data = data + "<td>" + value.institute + "</td>"
                        data = data + "<td>"
                        data = data +
                            "<button type='submit' onclick='editDate(" + value.id +
                            ")' class='btn btn-primary btn-sm mr-2'>edit</button>"
                        data = data +
                            "<button type='submit' onclick='deleteDate(" + value.id +
                            ")' class='btn btn-danger btn-sm mr-2'>delete</button>"
                        data = data + "</td>"
                        data = data + "</tr>"
                    })
                    $('tbody').html(data);
                }
            })
        }
        alldata();
        // all data read end

        //  data clear section start
        function clearDate() {
            $('#name').val('');
            $('#title').val('');
            $('#institute').val('');
            $('#nameError').text('');
            $('#titleError').text('');
            $('#instituteError').text('');
        }
        //  data clear section end

        // store data section start

        function addDate() {
            var name = $('#name').val();
            var title = $('#title').val();
            var institute = $('#institute').val();

            $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    name: name,
                    title: title,
                    institute: institute
                },
                url: "teacher/store",
                success: function(data) {
                    clearDate();
                    alldata();
                    console.log('successfully dada added');
                },
                error: function(error) {
                    $('#nameError').text(error.responseJSON.errors.name);
                    $('#titleError').text(error.responseJSON.errors.title);
                    $('#instituteError').text(error.responseJSON.errors.institute);
                }
            })
        }
        // add data section end


        // edit data section start
        function editDate(id) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "teacher/edit/" + id,
                success: function(data) {
                    $('#addTeacher').hide();
                    $('#updateTeacher').show();
                    $('#addB').hide();
                    $('#updateB').show();
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#title').val(data.title);
                    $('#institute').val(data.institute);

                    console.log(data);
                }
            })
        }
        //-------------------======= edit data section start ========---------
        //-------------------------- update data section start ---------------

        function updateDate() {
            var id = $('#id').val();
            var name = $('#name').val();
            var title = $('#title').val();
            var institute = $('#institute').val();
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    name: name,
                    title: title,
                    institute: institute
                },
                url: "teacher/update/" + id,
                success: function(data) {
                    $('#addTeacher').show();
                    $('#updateTeacher').hide();
                    $('#addB').show();
                    $('#updateB').hide();
                    clearDate();
                    alldata();
                    console.log(data);
                },
                error: function(error) {
                    $('#nameError').text(error.responseJSON.errors.name);
                    $('#titleError').text(error.responseJSON.errors.title);
                    $('#instituteError').text(error.responseJSON.errors.institute);
                }
            })


        }

        //--------------------------- update data section end------------------

        //--------------------------- delete data section start------------------

        function deleteDate(id) {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "teacher/destory/" + id,
                success: function(data) {
                    $('#addTeacher').show();
                    $('#updateTeacher').hide();
                    $('#addB').show();
                    $('#updateB').hide();
                    clearDate();
                    alldata();
                    console.log(deleted);
                }
            })
        }

        //--------------------------- delete data section end------------------
    </script>
</body>

</html>
