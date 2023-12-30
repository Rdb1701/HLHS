<?php
include '../header.php';
include 'requests/requests.php';
?>

<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>Item Requests</h1>
    </i>
    <div style="flex: 1;"></div>

    <?php
$query = "SELECT * FROM tbl_borrow_transaction WHERE user_id = '".$_SESSION['user']['user_id']."'
AND borrow_status = '4'
";
$result = $db->query($query);
if (!$result->num_rows) {
?>
    <button class="btn btn-sm btn-rasied btn-primary fw-bold" onclick="add_item()"><i class="fa fa-clipboard"></i> ITEM TRANSACTION SLIP</button>
    <?php 
}else{
?>
 <button class="btn btn-sm btn-rasied btn-primary fw-bold" onclick="add_item()" disabled><i class="fa fa-clipboard"></i> ITEM TRANSACTION SLIP</button>

<?php
}
?>


</h5>

<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <form action="list.php" method="post">
                <table class="table" id="dataTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Items</th>
                            <th class="text-center">Borrow Code</th>
                            <th class="text-center">Date to Borrow</th>
                            <th class="text-center">Date to Return</th>
                            <th class="text-center">Date Borrowed</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($requests) {
                            foreach ($requests as $req) {
                        ?>
                          <?php
                        if($req['status'] == '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">Warning to Return</span>'){
                            echo '<script>alert("Please Return an Item to ICT OFFICE.")</script>';
                        }
                        ?>
                                <tr class="text-dark">
                                    <td class="text-center">Serial: <?php echo $req['serial']; ?><br> <?php echo $req['model']; ?> - <?php echo $req['category']; ?></td>
                                    <td class="text-center "><?php echo $req['borrow_code']; ?></td>
                                    <td class="text-center "><?php echo $req['date_to_borrow']; ?></td>
                                    <td class="text-center "><?php echo $req['date_to_return']; ?></td>
                                    <td class="text-center "><?php echo $req['date_borrowed']; ?></td>
                                    <td class="text-center "><?php echo $req['status']; ?></td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr class="text-center">
                                <td class="text-start text-danger" colspan="11">No Record Found</td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<?php
include '../footer.php';
include 'modals/request_modal.php';
?>

<script>
    function add_item() {
        $('#borrow_modal').modal({
            backdrop: 'static',
            keyboard: false
        }, 'show');
        $('#borrow_modal').modal('show');
    }

    $(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var minDate= year + '-' + month + '-' + day;

    $('#date_to_borrow').attr('min', minDate);
    $('#date_to_return').attr('min', minDate);
});




    $(document).ready(function() {

        $('#form_borrow').submit(function(e) {
            e.preventDefault();

            let item_id = $('#add_item').val();
            let date_to_borrow = $('#date_to_borrow').val();
            let date_to_return = $('#date_to_return').val();

            $.ajax({
                url: 'requests/request_add.php',
                type: 'POST',
                data: {
                    item_id : item_id,
                    date_to_borrow: date_to_borrow,
                    date_to_return: date_to_return
                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                   alert('Successfully Request an Item!');
                   location.reload();
             
                } else {
                    alert(res.res_message);
                }
            }).fail(function() {
                console.log('Fail!');
            });

        })

        //DOCUMENT READY
    })
</script>