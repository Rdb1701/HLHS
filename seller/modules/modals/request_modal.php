<?php

$sql = "
SELECT its.*, i.item_id, i.model, c.category_desc
FROM tbl_item_stock as its
LEFT JOIN tbl_items as i ON i.item_id = its.item_id
LEFT JOIN tbl_category as c ON c.category_id = i.category_id
WHERE its.quantity != '0'";
$result = $db->query($sql);

$opt1 = "<select class='form-control' name='type' id = 'add_item'>";
$opt1 .= "<option value='' selected hidden>Select Item</option>";
while ($row = $result->fetch_assoc()) {

  $item_status= "";
  if($row['item_status'] == 0){
    $item_status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">Old</span>';
  }
  if($row['item_status'] == 1){
    $item_status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">New</span>';
  }
  if($row['item_status'] == 2){
    $item_status = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">Damage</span>';
  }

  $opt1 .= "<option value='" . $row['item_stock_id'] . "'>" . $row['category_desc'] . " - " . $row['model'] .' '.$item_status. " [" . $row['quantity'] ." in stock]</option>";
}
$opt1 .= "</select>";

?>

<!--BORROW MODAL -->
<div class="modal fade" id="borrow_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Item Transaction Slip</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      <form id="form_borrow">
        <div class="modal-body mx-4">
          <div class="md-form">
            <label data-error="wrong" data-success="right">Items<span class="text-danger">*</span></label>
            <?php echo $opt1; ?>
          </div><br>
    
          <div class="md-form">
            <label data-error="wrong" data-success="right">Date to Borrow</label>
            <span class="text-danger">*</span></label>
            <input type="date" class="form-control validate" id="date_to_borrow" required >
          </div><br>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Date to Return</label>
            <span class="text-danger">*</span></label>
            <input type="date" class="form-control validate" id="date_to_return" required >
          </div>
  
          <div class="text-center mt-3">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>


  <script>

var countImage = 1;
var countDocument = 1;

function remove(id, type) {

    $('#' + type + id).remove()

}

$(document).ready(function() {
    $('#reg_province_id').on('change', function() {
        let selectedProvince = $("#reg_province_id option:selected").val();
        $.ajax({
            type: "POST",
            url: "properties/city",
            dataType: 'html',
            data: {
                province_id: selectedProvince
            }
        }).done(function(data) {
            $('#reg_city_id').html(data);
        });
    });

    $('#reg_city_id').on('change', function() {
        let selectedCity = $("#reg_city_id option:selected").val();
        $.ajax({
            type: "POST",
            url: "properties/barangay",
            dataType: 'html',
            data: {
                city_id: selectedCity
            }
        }).done(function(response) {
            $('#reg_barangay_id').html(response);
        });
    });

});


$(document).on('click', '#btnImage', function() {
    countImage++
    html = ''
    html += '<tr id="rowReport' + countImage + '">'
    html += '<td class="text-left"><input type="file" name="new_image[]" id="" class="form-control" required></td>'
    html += '<td class="text-center">'
    html += '<button type="button" onclick="remove(' + countImage + ', \'rowReport\')" class="btn btn-danger btn-raised btn-sm ml-2">'
    html += '<i class="nav-icon bx bx-trash"></i>'
    html += '</button>'
    html += '</td>'
    html += '</tr>'
    $('#newImage').append(html)
})

$(document).on('click', '#btnDocument', function() {
    countDocument++
    html = ''
    html += '<tr id="rowDocument' + countDocument + '">'
    html += '<td class="text-left"><input type="file" name="new_document[]" id="" class="form-control" required></td>'
    html += '<td class="text-center">'
    html += '<button type="button" onclick="remove(' + countDocument + ', \'rowDocument\')" class="btn btn-danger btn-raised btn-sm ml-2">'
    html += '<i class="nav-icon bx bx-trash"></i>'
    html += '</button>'
    html += '</td>'
    html += '</tr>'
    $('#newDocument').append(html)
})
</script>
