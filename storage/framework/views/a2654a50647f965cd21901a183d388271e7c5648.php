<div class="container">
  <div class="row fill">
    <div class="col-md-8 fill" id="containment">
      <img id="resize" src="<?php echo e(asset($img)); ?>" height="<?php echo e($height); ?>" width="<?php echo e($width); ?>">
    </div>
    <div class="col-md-4 fill">

      <table class="table table-compact table-striped">
        <thead></thead>
        <tbody>
          <?php if($scaled): ?>
          <tr>
            <td><?php echo e(Lang::get('laravel-filemanager::lfm.resize-ratio')); ?></td>
            <td><?php echo e(number_format($ratio, 2)); ?></td>
          </tr>
          <tr>
            <td><?php echo e(Lang::get('laravel-filemanager::lfm.resize-scaled')); ?></td>
            <td>
              <?php echo e(Lang::get('laravel-filemanager::lfm.resize-true')); ?>

            </td>
          </tr>
          <?php endif; ?>
          <tr>
            <td><?php echo e(Lang::get('laravel-filemanager::lfm.resize-old-height')); ?></td>
            <td><?php echo e($original_height); ?>px</td>
          </tr>
          <tr>
            <td><?php echo e(Lang::get('laravel-filemanager::lfm.resize-old-width')); ?></td>
            <td><?php echo e($original_width); ?>px</td>
          </tr>
          <tr>
            <td><?php echo e(Lang::get('laravel-filemanager::lfm.resize-new-height')); ?></td>
            <td><span id="height_display"></span></td>
          </tr>
          <tr>
            <td><?php echo e(Lang::get('laravel-filemanager::lfm.resize-new-width')); ?></td>
            <td><span id="width_display"></span></td>
          </tr>
        </tbody>
      </table>

      <button class="btn btn-primary" onclick="doResize()"><?php echo e(Lang::get('laravel-filemanager::lfm.btn-resize')); ?></button>
      <button class="btn btn-info" onclick="loadItems()"><?php echo e(Lang::get('laravel-filemanager::lfm.btn-cancel')); ?></button>

      <input type="hidden" name="ratio" value="<?php echo e($ratio); ?>"><br>
      <input type="hidden" name="scaled" value="<?php echo e($scaled); ?>"><br>
      <input type="hidden" id="original_height" name="original_height" value="<?php echo e($original_height); ?>"><br>
      <input type="hidden" id="original_width" name="original_width" value="<?php echo e($original_width); ?>"><br>
      <input type="hidden" id="height" name="height" value=""><br>
      <input type="hidden" id="width" name="width">

    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    $("#height_display").html($("#resize").height() + "px");
    $("#width_display").html($("#resize").width() + "px");

    $("#resize").resizable({
      aspectRatio: true,
      containment: "#containment",
      handles: "n, e, s, w, se, sw, ne, nw",
      resize: function (event, ui) {
        $("#width").val($("#resize").width());
        $("#height").val($("#resize").height());
        $("#height_display").html($("#resize").height() + "px");
        $("#width_display").html($("#resize").width() + "px");
      }
    });
  });

  function doResize() {
    $.ajax({
      type: "GET",
      dataType: "text",
      url: "<?php echo e(route('unisharp.lfm.performResize')); ?>",
      data: {
        img: '<?php echo e($img); ?>',
        working_dir: $("#working_dir").val(),
        dataX: $("#dataX").val(),
        dataY: $("#dataY").val(),
        dataHeight: $("#height").val(),
        dataWidth: $("#width").val()
      },
      cache: false
    }).done(function (data) {
      if (data == "OK") {
        loadItems();
      } else {
        notify(data);
      }
    });
  }
</script>
