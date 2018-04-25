<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Loan Repayment Calculator</title>

  <!-- Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script>

  // Defensive programming
  // Validate user inputs
  function Validate_Form(){
    var valid = true;
    var Message = "";
    var LoanAmount = document.forms["LoanForm"]["LoanAmount"].value;
    if (LoanAmount == "") {
      //alert("Please enter a value for the Loan Amount");
      Message = Message + "Please enter a value for the Loan Amount\n";
      valid = false;

    }
    else if ( isNaN(parseFloat(LoanAmount)) == true)  {
      Message = Message + "Loan Amount must be a number\n";
      valid = false;
    }

    if (document.forms["LoanForm"]["StartDate"].value == "") {
      Message = Message + "Please enter a value for the Start Date\n"
      //alert("Please enter a value for the Start Date");
      valid = false;

    }
    var InstallmentAmount = document.forms["LoanForm"]["InstallmentAmount"].value;
    if (InstallmentAmount == "") {
      //alert("Please enter a value for the Loan Amount");
      Message = Message + "Please enter a value for the Installment Amount\n";
      valid = false;

    }
    else if ( isNaN(parseFloat(InstallmentAmount)) == true)  {
      Message = Message + "Installment Amount must be a number\n";
      valid = false;
    }

    if (valid == false) {
      alert (Message);
      return valid;
    }


  }

  </script>
  <!-- style some specific details as I wished -->

  <style media="screen">

  header.masthead .overlay {
    position: absolute;
    height: 100%;
    width: 100%;
  }

  header.masthead{
    position: relative;
    background-color: #097bff;
    height: 100%;
    padding-top: 8rem;
    padding-bottom: 8rem;
  }

  .masth{
    position: relative;
    background-color: #097bff;
    height: 100%;
    padding-bottom: 8rem;
  }

  .Date{
    border-radius: 5px;
    padding-top: 4px;
    padding-bottom: 4px;
    padding-left: 20px;
    padding-right: 20px;
  }
  </style>

</head>


<body>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <header class="masthead text-white text-center" >
    <div class="overlay"></div>


    <form method="post" action="" name = "LoanForm" onsubmit="return Validate_Form()">
      <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
        <h2>How long will it take to pay off my loan?</h2>
        <br>
        <div class="container">


          <div class="form-group row">
            <label for="formGroupExampleInput" class="col-sm-6 col-form-label">Start Date</label>
            <div class="col-sm-4">
              <input type="date" name="StartDate" class="Date" id="formGroupExampleInput">
            </div>
          </div>

          <div class="form-group row">
            <label for="formGroupExampleInput" class="col-sm-6 col-form-label">Loan Amount</label>
            <div class="col-sm-4">
              <input type="text" name="LoanAmount" class="form-control" id="formGroupExampleInput" placeholder="Loan amount">
            </div>
          </div>

          <div class="form-group row">
            <label for="formGroupExampleInput" class="col-sm-6 col-form-label">Installment amount</label>
            <div class="col-sm-4">
              <input type="text" name="InstallmentAmount" class="form-control" id="formGroupExampleInput" placeholder="Installment amount">
            </div>
          </div>

          <div class="form-group row">
            <label for="formGroupExampleInput" class="col-sm-6 col-form-label">Interest Rate</label>
            <div class="col-sm-4">
              <select class="form-control" name="Interest">
                <option value = 1>1.00 %</option>
                <option value = 1.25>1.25 %</option>
                <option value = 1.5>1.50 %</option>
                <option value = 1.75>1.75 %</option>
                <option value = 2>2.00 %</option>
                <option value = 2.25>2.25 %</option>
                <option value = 2.5>2.50 %</option>
                <option value = 2.75>2.75 %</option>
                <option value = 3 selected>3.00 %</option>
                <option value = 3.25>3.25 %</option>
                <option value = 3.5>3.50 %</option>
                <option value = 3.75>3.75 %</option>
                <option value = 4>4.00 %</option>
                <option value = 4.25>4.25 %</option>
                <option value = 1.75>4.75 %</option>
                <option value = 5>5.00 %</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="formGroupExampleInput" class="col-sm-6 col-form-label">Installment interval</label>
            <div class="col-sm-4">
              <select class="form-control" name="InstallmentInterval">
                <option value="D">Daily</option>
                <option value="W">Weekly</option>
                <option value="M" selected>Monthly</option>
              </select>
            </div>
          </div>
          <br>
          <button type="submit" name="submit" class="btn btn-success">Calculate</button>

        </div>

      </div>

    </form>

  </header>


  <?php
  if(isset($_POST['submit'])) {
    ?>

    <!-- ceil to round by excess the Installment (# of months) -->
    <!-- Get input from the user -->
    <?php
    $balance = (float) $_POST['LoanAmount'];
    $startDate=$_POST['StartDate'];
    $installmentAmount=$_POST['InstallmentAmount'];
    $interest=$_POST['Interest'];
    $installmentInterval=$_POST['InstallmentInterval'];
    $interval_date = $startDate;

    // Get Installment Interval
    switch ($installmentInterval){
      case "M":
      $i = ($interest/100)/12;
      $d = " + 1 month";
      break;

      case "W":
      $i = ($interest/100)/52;
      $d = " + 1 week";
      break;

      case "D":
      $i = ($interest/100)/365;
      $d = " + 1 day";
      break;
    }

    // Get Installment(how many months are required to repay the loan)
    $Installment = ceil((($i * $_POST['LoanAmount']) + $_POST['LoanAmount'])/($_POST['InstallmentAmount']))

    ?>

    <div class="masth text-white text-center" >
      <div class="overlay"></div>

      <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
        <h2>Schedule payment:</h2>
        <br>
        <div class="container">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Balance</th>
                <th scope="col">Interest</th>
                <th scope="col">Principal</th>
                <th scope="col">Amount</th>
                <th scope="col">Estimated payoff Date</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php
                for($month = 0; $month < $Installment; $month++) {
                  $interest = $balance * $_POST['Interest'] / 1200;
                  $principal = $_POST['InstallmentAmount'] - $interest;
                  $interval_date = date('Y-m-d', strtotime($interval_date. $d));
                  ?>
                  <tr>
                    <td><?php echo $month + 1 ?></td>
                    <td><?php echo "$". number_format($balance, 2) ?></td>
                    <td><?php echo "$". number_format($interest, 2) ?></td>
                    <?php if ($_POST['InstallmentAmount'] < $balance) {
                      ?>
                      <td><?php echo "$". number_format($principal, 2) ?></td>
                      <td><?php echo "$". number_format($_POST['InstallmentAmount'], 2) ?></td>
                    <?php } else { ?>
                      <td><?php echo "$". number_format($balance - $interest, 2) ?></td>
                      <td><?php echo "$". number_format($balance, 2) ?></td>

                    <?php } ?>

                    <?php  $dayofweek = date('w', strtotime($interval_date));
                      if ($dayofweek == 6) {
                        $interval_date = date('Y-m-d', strtotime($interval_date. '+ 2 DAYS'));
                      }
                      if ($dayofweek == 0) {
                        $interval_date = date('Y-m-d', strtotime($interval_date. '+ 1 DAY'));
                      }
                    ?>

                    <td><?php echo $interval_date ?></td>
                  </tr>
                  <?php
                  $balance -= $principal;
                }
                ?>

              </tr>
            </tbody>

          </table>

        </div>

      </div>

    </div>

  <?php } ?>
</body>
</html>
