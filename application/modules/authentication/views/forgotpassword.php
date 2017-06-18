    <div class="inner-bg">
      <div class="container">
        <div class="row">
          <div class="col-sm-7 text">
            <h1>โรงเรียนกวดวิชา KDC อาจารย์อรภัย</h1>
            <h2>"ลงทุนในการศึกษาวันนี้ เพื่อชีวิตดีดีในวันหน้า"</h2>
            <div class="description">
             <p>โรงเรียนกวดวิชาเเห่งเดียวในย่านบางเขน-รามอินทรา/มีนบุรี-ลาดพร้าว-บางนา/กรุงเทพฝั่งตะวันตก-ฝั่งธนบุรี ที่มีความพร้อมเปิดสอนโดย อาจารย์จริงประจำวิชา จบวุฒิสายตรง ปริญญาโท จากมหาวิทยาลัยที่มีชื่อเสียงในเเละต่างประเทศ เช่น จุฬาลงกรณ์ เกษตรศาสตร์ ประสานมิตร ฯลฯ</p>
           </div>
         </div>
         <div class="col-sm-5 form-box">
           <div class="form-top">
            <div class="form-top-left">
              <h3>ลืมรัหสผ่าน</h3>
              <p>หากต้องการสมัครสมาชิก <a href="<?php echo base_url().index_page(); ?>register">คลิกที่นี่</a></p>
            </div>
            <div class="form-top-right">
             <i class="fa fa-pencil"></i>
           </div>
         </div>
         <div class="form-bottom">
           <form role="form" action="" id="form-forgotpassword" method="post" class="registration-form">
             <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <input type="email" name="email" class="form-control required" placeholder="Email">
                </div>
              </div>
            </div>
            <button type="button" id="btnLogin" class="btn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
             ส่งข้อมูล</button>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>
 <script type="text/javascript">
   $(function(){
    var options = {
      url: site_url + 'authentication/check_forgotpassword',
      success: showResponse
    };
    $('#btnLogin').click(function () {
      if ($("#form-forgotpassword").valid()) {
        $(this).addClass('disabled', 'disabled');
        $(this).after('&nbsp;<span id="spinner_loading"><i class="fa fa-spinner fa-spin"></i>&nbsp;&nbsp;Loading...</span>');
        $('#form-forgotpassword').ajaxSubmit(options);
        return false;
      }
    });
  });

   function showResponse(response, statusText, xhr, $form) {
    var as = JSON.parse(response);
    if (as.error.status === false) {
      var data = {
        title: 'Message',
        type: 'info1',
        text: as.error.message_info
      };
      genModal(data);
      $('#btnLogin').removeClass('disabled');
      $("#spinner_loading").remove();
    } else {
      location.href = site_url;
    }
  }
</script>