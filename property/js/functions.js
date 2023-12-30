     //diaglog chat box
     function make_chat_dialog_box(to_user_id, to_user_name, type_name, location, property_id) {
        var modal_content = '<span>You have chat with ' + to_user_name + ' <br><br>' + location + '  (' + type_name + ') </span>';
        modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-topropertyid="' + property_id + '"  data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';
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
        $('#chat_modal').modal('hide');
    }

    //chat history
    function fetch_user_chat_history(to_user_id, property_id) {
        $.ajax({
            url: "includes/fetch_user_chat_history",
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
                url: "includes/insert_chat",
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
                url: "includes/remove_chat",
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

    $(document).on('submit', '#form_appointment', function(e){
        e.preventDefault();
        
        let property_id     = $('#prop_id').val()
        let appointment_date = $('#appointment_date').val();
        let appointment_time = $('#appointment_time').val();
        let message         = $('#message').val();

        $.ajax({
            url: 'includes/appointment_add',
            type: 'POST',
            data: {
                appointment_date  : appointment_date,
                appointment_time  : appointment_time,
                property_id       : property_id,
                message           : message
            },
            dataType: 'JSON',
            beforeSend: function() {

            }
        }).done(function(res) {
            if (res.res_success == 1) {
                alert('Successfully Set an Appointment');
                location.reload();
            } else {
                alert(res.res_message);
            }

        }).fail(function() {
            console.log('fail')
        })
    })


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
    
        $('#appointment_date').attr('min', minDate);
    });