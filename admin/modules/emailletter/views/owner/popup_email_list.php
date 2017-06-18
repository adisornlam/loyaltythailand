<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Email list</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>
    <body>
      <div class="container">
        <h3>Email Group List</h3>
        <p>เลือกอีเมล์ที่ต้องการจะส่ง</p>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-striped">
              <thead> 
                <tr>
                  <th>#</th> 
                  <th>Parent Name</th> 
                  <th>Email</th> 
                </tr>
              </thead>
              <tbody> 
                <?php foreach($group->result() as $item){ ?>
                <tr>
                <td colspan="4"><?php echo $item->title; ?></td>
                </tr>
                <?php foreach($this->Student_model->get_std_branch($item->id)->result() as $item2){ ?>
                <tr> 
                  <th scope="row"><input type="checkbox" name="email" value="<?php echo $item2->email; ?>" /></th> 
                  <td><?php echo $item2->parent_first_name." ".$item2->parent_last_name; ?></td> 
                  <td><?php echo $item2->email; ?></td> 
                </tr> 
                <?php } ?>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script type="text/javascript">
        function closeit() {
          if (window.opener != null && !window.opener.closed) {
            var email_to = window.opener.document.getElementById("email_to");
            email_to.value = document.getElementById("ddlNames").value;
          }
          window.close();
        }
      </script>
    </body>
    </html>