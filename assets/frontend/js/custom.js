/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
    $.validator.setDefaults({
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else if (element.parent('.radio-inline').length) {
                error.insertAfter(element.parent().parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
});

function genModal(p)
{
    if (p.type === 'confirm_print')
    {
        $('#myModal .modal-footer').show();
        $('#myModal .modal-title, #myModal .modal-body').empty();
        $('#myModal .modal-footer #button-close, #button-confirm, #button-print').show();
        $('#myModal .modal-footer #button-ok').hide();
        $('#myModal .modal-title').html(p.title);
        $('#myModal .modal-body').html('<div class="text-center">' + p.text + '</div>');
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: true
        });
    } else if (p.type === 'alert')
    {
        $('#myModal .modal-title, #myModal .modal-body').empty();
        $('#myModal .modal-footer').hide();
        $('#myModal .modal-title').html(p.title);
        $('#myModal .modal-body').html(p.text);
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: true
        });
    } else if (p.type === 'info1')
    {
        $('#myModal .modal-title, #myModal .modal-body').empty();
        $('#myModal .modal-footer #button-ok, #button-confirm, #button-print').hide();
        $('#myModal .modal-footer #button-close').show();
        $('#myModal .modal-title').html(p.title);
        $('#myModal .modal-body').html(p.text);
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: true
        });
    } else if (p.type === 'info')
    {
        $('#myModal .modal-title, #myModal .modal-body').empty();
        $('#myModal .modal-footer #button-close, #button-confirm, #button-print').hide();
        $('#myModal .modal-footer #button-ok').show();
        $('#myModal .modal-title').html(p.title);
        $('#myModal .modal-body').html(p.text);
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: true
        });
    } else if (p.type === 'confirm') {
        $('#myModal .modal-footer').show();
        $('#myModal .modal-title, #myModal .modal-body').empty();
        $('#myModal .modal-footer #button-close, #button-confirm').show();
        $('#myModal .modal-footer #button-ok, #button-print').hide();
        $('#myModal .modal-title').html(p.title);
        $('#myModal .modal-body').html('<div class="text-center">' + p.text + '</div>');
        $('#myModal').modal({
            backdrop: 'static',
            keyboard: true
        });
    } else {
        $.ajax({
            type: "get",
            url: site_url + p.url,
            data: p.v,
            cache: false,
            dataType: 'html',
            success: function (result) {
                try {
                    $('#myModal .modal-title, #myModal .modal-body').empty();
                    $('#myModal .modal-footer').hide();
                    $('#myModal .modal-title').html(p.title);
                    $('#myModal .modal-body').html(result);
                    $('#myModal').modal({
                        backdrop: 'static',
                        keyboard: true,
                        width: '680px'
                    });
                } catch (e) {
                    alert('Exception while request..');
                }
            },
            error: function (e) {
                alert('Error while request..');
            }
        });
    }
}