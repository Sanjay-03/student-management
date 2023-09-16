<form action="" id="{{ $id }}" autocomplete="off">
    @csrf
    <input type="hidden" name="id" value="">
    <div class="mb-3">
        <label for="student_name" class="form-label">Name</label>
        <input type="text" class="form-control" name="student_name" required>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" name="address" required rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="student_class" class="form-label">Class</label>
        <input type="text" class="form-control" name="student_class" required>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
