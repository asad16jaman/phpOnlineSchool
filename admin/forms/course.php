<div class="mb-3">
    <label for="">Name</label>
    <input required type="text" name="name" value="<?php echo $edit ? $data['name'] : "" ?>" id="" class="form-control">
</div>
<div class="mb-3">
    <label for="">Author</label>
    <input required type="text" name="author" value="<?php echo $edit ? $data['author'] : "" ?>" id="" class="form-control">
</div>
<div class="mb-3">
    <label for="">Duration</label>
    <input required type="text" name="duration" value="<?php echo $edit ? $data['duration'] : "" ?>" id="" class="form-control">
</div>
<div class="mb-3">
    <label for="">Original Price</label>
    <input required type="text" name="price" value="<?php echo $edit ? $data['price'] : "" ?>" id="" class="form-control">
</div>
<div class="mb-3">
    <label for="">Selling Price</label>
    <input required type="text" name="sell_price" value="<?php echo $edit ? $data['sell_price'] : "" ?>" id="" class="form-control">
</div>
<div class="mb-3">
    <label for="">Description</label>
    <textarea required class="form-control" name="description" id="" cols="30" rows="10"><?php echo $edit ? $data['description'] : "" ?></textarea>
</div>
<div class="mb-3">
    <label for="">Thumbnail</label>
    <input <?php echo !$edit ? 'required' : "" ?> type="file" name="img" id="" class="form-control">
    <?php if($edit){ ?>
    <img class="mt-2" src="./_assets/crs_thum/<?php echo $data['img'] ?>" width="100px" alt="">
    <?php }?>
</div>

//is-invalid