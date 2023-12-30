<?php
include "../header.php";
?>

<h5 class="d-flex" style="margin-bottom: 15px;">
    <i class="bx" style="margin-right: 8px;">
        <h1>Customer Chats</h1>
    </i>
    <div style="flex: 1;"></div>
    <!-- <button class="btn btn-md btn-success" onclick="add_user()"><i class="bx bx-user-plus"></i>Add User</button> -->
</h5>
<div class="card radius-10">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="myTable">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Customer Name</th>
                        <th class="text-center">Property Type</th>
                        <th class="text-center">Property Location</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- CONTENT -->
                </tbody>
            </table>
        </div>
    </div>
</div>


<!----------------------------------------------- MODAL -------------------------------------------------->
<!-- Show CHAT Modal -->
<div class="modal fade" id="chat2_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CHAT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal_user">

            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<?php
include "../footer.php";
?>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#myTable').DataTable({
            ajax: 'chat/chats', // API endpoint to fetch data
            columns: [{
                    data: [0],
                    "className": "text-center"
                },
                {
                    data: [1],
                    "className": "text-center"
                },
                {
                    data: [2],
                    "className": "text-center"
                },
                {
                    data: [3],
                    "className": "text-center"
                },
            ]
        });
    })

    $(document).ready(function() {
        setInterval(function() {

            update_chat_history_data();

        }, 5000);
    })

    //diaglog chat box
    function make_chat_dialog_box(to_user_id, to_user_name, type_name, location, property_id) {
        var modal_content = '<span>You have chat with ' + to_user_name + ' <br><br>' + location + '  (' + type_name + ') </span>';
        modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-topropertyid="' + property_id + '" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';
        modal_content += fetch_user_chat_history(to_user_id, property_id);
        modal_content += '</div>';
        modal_content += '<div class="form-group">';
        modal_content += '<textarea rows="3" placeholder = "Type something..." name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id + '" class="form-control chat_message"></textarea>';
        modal_content += '</div><div class="form-group" align="right"><br>';
        modal_content += '<button type="button" name="send_chat" onclick = "send_chat(' + to_user_id + ', ' + property_id + ')" id="' + to_user_id + '" class="btn btn-info send_chat">Send</button></div></div>';
        $('.modal_user').html(modal_content);
        $('#chat_message_' + to_user_id).emojioneArea({
            pickerPosition: "top",
            tonesStyle: "bullet"
        });
        $('#chat2_modal').modal({
            backdrop: 'static',
            keyboard: false
        }, 'show');
        $('#chat2_modal').modal('show');
    }

    //chat
    function chat(to_user_id, to_user_name, type_name, location, property_id) {
        make_chat_dialog_box(to_user_id, to_user_name, type_name, location, property_id);

    }

    //chat history
    function fetch_user_chat_history(to_user_id, property_id) {
        $.ajax({
            url: "chat/fetch_user_chat_history",
            method: "POST",
            data: {
                to_user_id: to_user_id,
                property_id: property_id
            },
            success: function(data) {
                $('#chat_history_' + to_user_id).html(data);
            }
        })
    }
    //update chat history
    function update_chat_history_data() {
        $('.chat_history').each(function() {
            var to_user_id = $(this).data('touserid');
            var my_property_id = $(this).data('topropertyid');
            fetch_user_chat_history(to_user_id, my_property_id);
        });
    }

    function send_chat(to_user_id, property_id) {
        var chat_message = $.trim($('#chat_message_' + to_user_id).val());
        if (chat_message != '') {
            $.ajax({
                url: "chat/insert_chat",
                method: "POST",
                data: {
                    to_user_id: to_user_id,
                    chat_message: chat_message,
                    property_id: property_id
                },
                success: function(data) {
                    //$('#chat_message_'+to_user_id).val('');
                    var element = $('#chat_message_' + to_user_id).emojioneArea();
                    element[0].emojioneArea.setText('');
                    $('#chat_history_' + to_user_id).html(data);
                }
            })
        } else {
            alert('Type something');
        }

    }

    //REMOVE CHAT
    $(document).on('click', '.remove_chat', function() {
        var chat_id = $(this).attr('id');
        if (confirm("Are you sure you want to remove this chat?")) {
            $.ajax({
                url: "chat/remove_chat",
                method: "POST",
                data: {
                    chat_id: chat_id
                },
                success: function(data) {
                    update_chat_history_data();
                }
            })
        }
    });

    function delete_c(seller_id, property_id){
        if (confirm("Are you sure you want to remove this chat?")) {
        $.ajax({
            url: 'chat/delete_chat',
            type: 'POST',
            data: {
                user_id     : seller_id,
                property_id : property_id
    
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
    
</script>