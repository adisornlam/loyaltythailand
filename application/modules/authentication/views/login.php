<link href="<?php echo base_url(); ?>assets/backend/css/plugins/social-buttons.css" rel="stylesheet" />
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">เข้าสู่ระบบ</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-7">
        <?php echo (isset($msg) ? $msg : NULL); ?>   
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo $info->long_desc; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" id="form-login">
                    <div id="showerror"></div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="email" class="form-control" name="identity" id="identity" placeholder="อีเมล์">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" value="1"> จำรหัสผ่าน
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8">
                            <button type="button" id="btnLogin" class="btn btn-primary">เข้าสู่ระบบ</button>
                        </div>
                        <div class="col-lg-4 text-right">
                            <a href="javascript:;" class="text-warning link_dialog" rel="authentication/auth/forgotpassword" title="ลืมรหัสผ่าน">ลืมรหัสผ่าน</a>
                        </div>
                    </div>
                </form> 
                <a href="javascript:;" id="btnFBLogin" class="btn btn-block btn-social btn-facebook">
                    <i class="fa fa-facebook"></i> Sign in with Facebook
                </a>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/backend/js/jquery.form.js"></script>
<script type="text/javascript">
    $('#btnLogin').click(function() {
        $(this).attr('disabled', 'disabled');
        $(this).after('&nbsp;<span id="spinner_loading"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...</span>');
        web_login();
    });

    $("#form-login").keypress(function(e) {
        if ((e.keyCode == 13) && ($('input[name="password"]').is(':focus'))) {
            e.preventDefault();
            web_login();
        }
    });

    function web_login() {
        $.ajax({
            type: "post",
            url: base_url + index_page + 'authentication/result_auth/login',
            data: $('#form-login input:not(#btnLogin)').serializeArray(),
            cache: false,
            async: false,
            dataType: 'json',
            success: function(result) {
                try {
                    if (result.error.status === false) {
                        $('form #showerror').empty();
                        $('#btnLogin').removeAttr('disabled');
                        $('#spinner_loading').hide();
                        $('form #showerror').html('<div class="alert alert-danger" role="alert">' + result.error.message + '</div>');
                    } else {
                        window.location.href = 'https://www.jib.co.th/ws/index.php/';
                    }
                } catch (e) {
                    alert('Exception while request..');
                }
            }
        });
    }
    window.fbAsyncInit = function() {
        FB.init({
            appId: '<?php echo $this->config->item('appID'); ?>',
            cookie: true,
            status: true,
            xfbml: true,
            oauth: true
        });
    };
    (function(d) {
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement('script');
        js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    }(document));

    $('#btnFBLogin').click(function() {
        FB.login(function(response) {
            if (response.status === 'connected') {
                FB.api('/me', function(response) {
                    console.log(response);
                    $.ajax({
                        type: "post",
                        url: base_url + index_page + 'authentication/result_auth/fb_reg',
                        cache: false,
                        data: {
                            fb_id: response.id,
                            first_name: response.first_name,
                            last_name: response.last_name,
                            link: response.link,
                            gender: response.gender,
                            email: response.email
                        },
                        success: function(result) {
                            try {
                                var as = JSON.parse(result);
                                if (as.error.status === true) {
                                    window.location.href = as.error.redirect;
                                } else {
                                    alert('Error');
                                }
                            } catch (e) {
                                alert('Exception while request..2');
                            }
                        },
                        error: function(e) {
                            alert('Error while request..');
                        }
                    });
                });
            } else if (response.status === 'not_authorized') {

            } else {

            }
        }, {scope: 'public_profile,email'});
        return false;
    });

    function showResponse(response, statusText, xhr, $form) {
        var as = JSON.parse(response);
        if (as.error.status == false) {
            $('form #showerror').empty();
            $('#btnLogin').removeAttr('disabled');
            $('#spinner_loading').hide();
            $('form #showerror').html('<div class="alert alert-danger" role="alert">' + as.error.message + '</div>');
        } else {
            window.location.href = base_url + index_page;
        }
    }
</script>