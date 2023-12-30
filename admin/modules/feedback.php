<?php
include "../header.php";
?>

<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>Feedback</h1>
    </i>
 
</h5>

<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <form action="list.php" method="post">
                <table class="table" id="myTable">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Feedbacks</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                                <!-- CONTENT -->
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>


<?php
include "../footer.php";
?>
<script>

function delete_feedback(feedback_id){
        if (confirm("Are you sure you want to remove feedback?")) {
        $.ajax({
            url: 'feedbacks/feedback_delete',
            type: 'POST',
            data: {
                feedback_id     : feedback_id

            },
            dataType: 'JSON',
            beforeSend: function() {
    
            }
          }).done(function(res) {
            if (res.res_success == 1) {
              alert('Successfully Deleted');
           location.reload();
            } else {
              alert(res.res_message);
            }
          }).fail(function() {
            console.log("FAIL");
          })
        }
    }

         $(document).ready(function() {
        // Initialize DataTable
        var table = $('#myTable').DataTable({
            ajax: 'feedbacks/feedback', // API endpoint to fetch data
            columns: [{
                    data: [0],
                    "className": "text-center"
                },
                {
                    data: [1],
                    "className": "text-center"
                }
            ]
        });

    })
</script>
