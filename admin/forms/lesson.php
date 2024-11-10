<div class="mb-3">
    <label for="">Course Name</label>
    <input type="text" name="course_name" value="<?php echo $data['name'] ?>" readonly id="" class="form-control">
</div>

<div class="mb-3">
    <label for="">Lesson Name</label>
    <input required type="text" name="name" id="" placeholder="leasson Name" class="form-control">
</div>

<div class="mb-3">
    <label for="">Lesson Description</label>
    <textarea required name="description" class="form-control" id="" rows="6" cols="30"></textarea>
</div>

<div class="mb-3">
    <label for="">Lesson Video</label>
    <input required type="file" name="video" id="" class="form-control">
</div>