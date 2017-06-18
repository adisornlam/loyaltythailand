<div class="row">

    <div class="col-md-8">

        <!-- Classic Heading -->
        <h4 class="classic-title"><span>Contact Us</span></h4>

        <!-- Start Contact Form -->
        <div id="contact-form" class="contatct-form">
            <div class="loader"></div>
            <form action="mail.php" class="contactForm" name="cform" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <label for="name">Name<span class="required">*</span></label>
                        <span class="name-missing">Please enter your name</span>  
                        <input id="name" name="name" type="text" value="" size="30">
                    </div>
                    <div class="col-md-4">
                        <label for="e-mail">Email<span class="required">*</span></label>
                        <span class="email-missing">Please enter a valid e-mail</span> 
                        <input id="e-mail" name="email" type="text" value="" size="30">
                    </div>
                    <div class="col-md-4">
                        <label for="url">Website</label>
                        <input id="url" name="url" type="text" value="" size="30">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="message">Add Your Comment</label>
                        <span class="message-missing">Say something!</span>
                        <textarea id="message" name="message" cols="45" rows="10"></textarea>
                        <input type="submit" name="submit" class="button" id="submit_btn" value="Send Message">
                    </div>
                </div>
            </form>
        </div>
        <!-- End Contact Form -->

    </div>

    <div class="col-md-4">

        <!-- Classic Heading -->
        <h4 class="classic-title"><span>Information</span></h4>
        <!-- Divider -->
        <div class="hr1" style="margin-bottom:10px;"></div>

        <!-- Info - Icons List -->
        <ul class="icons-list">
            <li><i class="fa fa-globe">  </i> <strong>Address:</strong> 600/441-3 หมู่.14 ถนนพหลโยธิน ต.คูคต อ.ลำลูกกา ทุมธานี 12130</li>
            <li><i class="fa fa-envelope-o"></i> <strong>Email:</strong> info.att@arcoaerotech.com</li>
            <li><i class="fa fa-mobile"></i> <strong>Phone:</strong> 02-5367660-1</li>
        </ul>

        <!-- Divider -->
        <div class="hr1" style="margin-bottom:15px;"></div>

        <!-- Classic Heading -->
        <h4 class="classic-title"><span>Working Hours</span></h4>

        <!-- Info - List -->
        <ul class="list-unstyled">
            <li><strong>Monday - Friday</strong> - 9am to 5pm</li>
            <li><strong>Saturday</strong> - 9am to 2pm</li>
            <li><strong>Sunday</strong> - Closed</li>
        </ul>

    </div>

</div>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.form.js"></script>
<script type="text/javascript">
    $(function () {
        var options = {
            url: base_url + index_page + 'contact/result_contact/add',
            success: showResponse
        };
        $('#btnSave').click(function () {
            $('#form-add').ajaxSubmit(options);
            return false;
        });

        function showResponse(response, statusText, xhr, $form) {
            var as = JSON.parse(response);
            if (as.error.status === false) {
                $('form label, input').removeClass('alert');
                $.each(as.error.message, function (key, value) {
                    $('#' + key).addClass('alert');
                    $('.' + key).addClass('alert');
                });
            } else {
                alert('ส่งข้อมูลสำเร็จแล้ว');
                window.location.href = base_url + index_page;
            }
        }
    });
</script>