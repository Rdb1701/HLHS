<?php
include '../header.php';
include 'service_request/service.php';
?>
<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>Sevice Requests</h1>
    </i>
    <div style="flex: 1;"></div>
    <button class="btn btn-sm btn-rasied btn-primary fw-bold" onclick="service_modal()"><i class="fa fa-wrench"></i> REQUEST SERVICE</button>
</h5>

<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <form action="list.php" method="post">
                <table class="table" id="dataTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Priority Number</th>
                            <th class="text-center">Transaction Code</th>
                            <th class="text-center">Concern</th>
                            <th class="text-center">Date to Service</th>
                            <th class="text-center">Status</th>
                  
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($requests_service) {
                            foreach ($requests_service as $req) {
                        ?>
                                <tr class="text-dark">
                                    <td class="text-center ">0<?php echo $req['other_transaction_id']; ?></td>
                                    <td class="text-center "><?php echo $req['transaction_code']; ?></td>
                                    <td class="text-center "><?php echo $req['concern']; ?></td>
                                    <td class="text-center "><?php echo $req['date_to_service']; ?></td>
                                    <td class="text-center "><?php echo $req['ot_status']?></td>
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
include 'modals/request_service.php';
?>

<script>
    function service_modal(){
        $('#service_modal').modal({
            backdrop: 'static',
            keyboard: false
        }, 'show');
        $('#service_modal').modal('show');
    }

    $(document).ready(function(){

        $('#form_service').submit(function(e){
            e.preventDefault();

            let add_service = $('#add_service').val();
            let add_concern = $('#add_concern').val();

            let errors = new Array();
            let input = "Please Input";

            if (add_service == '') {
                errors.push('Service');
            }
            if (add_concern == '') {
                errors.push('Concern');
            }
            if (errors.length > 0) {
                let error = '';
                $.each(errors, function(key, value) {
                    if (error == '') {
                        error += '• ' + value;
                    } else {
                        error += '\n• ' + value;
                    }
                });
                alert(input + '\n' + error);
            } else {
                $.ajax({
                url: 'service_request/service_add.php',
                type: 'POST',
                data: {
                    add_service :add_service,
                    add_concern: add_concern
               
                },
                dataType: 'JSON',
                beforeSend: function() {

                }
            }).done(function(res) {
                if (res.res_success == 1) {
                   alert('Successfully Request a Service For Maintenance');
                   location.reload();
             
                } else {
                    alert(res.res_message);
                }
            }).fail(function() {
                console.log('Fail!');
            });


            }
           
        })


    })
</script>