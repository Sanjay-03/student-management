@extends('layouts.app')

@section('content')
    <div class="my-2 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold">Student Data</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
    </div>
    {{-- student list start --}}
    <div class="card p-2 mt-4">
        <table class="table text-center table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Address</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr id="row_{{ $student['id'] }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student['name'] }}</td>
                        <td>{{ $student['class'] }}</td>
                        <td>{{ $student['address'] }}</td>
                        <td>{{ $student['created_at'] }}</td>
                        <td>{{ $student['updated_at'] ?? 'N/A' }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary"
                                onclick="editData({{ $student['id'] }})">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="deleteData({{ $student['id'] }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- student add modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Add Student Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('layouts.student-modal', ['id' => 'addStudenForm'])
                </div>
            </div>
        </div>
    </div>

    {{-- student edit modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Student Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="resetForm()"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('layouts.student-modal', ['id' => 'editStudenForm'])
                </div>
            </div>
        </div>
    </div>

    <script>
        const studentData = @json($students);
        var singleStudentData;

        const editData = (id) => {
            singleStudentData = studentData.find(e => e.id == id);
            console.log(singleStudentData);
            $('input[name="id"]').val(singleStudentData['id']);
            $('input[name="student_name"]').val(singleStudentData['name']);
            $('textarea[name="address"]').text(singleStudentData['address']);
            $('input[name="student_class"]').val(singleStudentData['class']);
            $('#editModal').modal('show');
        }

        $('form#addStudenForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ url('/add') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res['status'] == 'OK') {
                        location.reload();
                        alert(res['msg'])
                    } else {
                        alert(res['msg'])
                    }
                }
            })
        });

        $('form#editStudenForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ url('/edit') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res['status'] == 'OK') {
                        location.reload();
                        alert(res['msg'])
                    } else {
                        alert(res['msg'])
                    }
                }
            })
        });

        const deleteData = (id) => {
            $.ajax({
                type: "GET",
                url: "{{ url('/delete') }}/" + id,
                success: function(res) {
                    if (res['status'] == 'OK') {
                        $(`#row_${id}`).remove();
                        alert(res['msg'])
                    } else {
                        alert(res['msg'])
                    }
                }
            })
        }

        const resetForm = () => {
            $('form#addStudenForm').trigger('reset');
            $('textarea[name="address"]').text("")
        }
    </script>
@endsection
