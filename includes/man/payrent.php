<script src="//cdn.tms-dist.lan:433/styles/js/payrent.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/font-awesome/css/all.css">
<?php session_start(); ?>
<div class="payrent">
    <div class="pr_header">
        <center><strong>Payment Processing Page</strong></center>
    </div>
    <div class="pr_content">
        You are required to fill in the form in order to complete the payment process.<br>
        <hr>
        <div class="container" style="padding: 0px 20px!important">
            <div class="row">
                <div class="col-xs-12 col-md-7 col-lg-12">
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading display-table" style="width:100%">
                            <div class="row display-tr">
                                <h3 class="panel-title display-td tms-center">
                                    Payment Details
                                </h3>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form id="payment-form" class="payment-form" role="form" method="post" action="/action/process_payment">
                                <div class="row">
                                    <div class="col-xs-3 col-sm-6">
                                        <div class="form-group">
                                            <label for="receiptNo" style="font-size: 12px">Receipt No: <span class="alert-error rNo" style="color:red"></span></label>
                                            <div class="form-group" style="position: relative">
                                                <input type="text" name="rNo" class="form-control" placeholder="Receipt No"  onfocus="($('.fa.rNo').hide())" autocomplete="false" required="required" autofocus="autofocus">
                                                <i class="fa fa-check rNo" style="color: #5da454; position: absolute; right: 8px; top:10px" aria-hidden="hidden"></i>
                                                <i class="fa fa-times rNo" style="color: red; position: absolute; right: 8px; top:10px" aria-hidden="hidden"></i>
                                                <i class="fa fa-spinner fa-pulse rNo" style="color: grey; position: absolute; right: 8px; top:10px" aria-hidden="hidden"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-9 col-sm-6">
                                        <div class="form-group">
                                            <label for="datePd:">Date Paid:</label>
                                            <div class="input-group date" id="dtp">
                                                <input type="text" name="datePd" class="form-control" autocomplete="date" required="required">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-7 col-lg-12">
                                        <div class="form-group">
                                            <label for="tenName">Tenant Name: <span class="alert-error name" style="color:red"></span></label>
                                            <div class="row">
                                                <div class="col-xs-6 col-md-6 col-lg-6">
                                                    <div class="form-group" style="position:relative">
                                                        <input type="text" name="fName" class="form-control col-xs-6 col-md-6 col-lg-6" onfocus="($('.fa.fName').hide())" placeholder="First Name" required="required">
                                                        <i class="fa fa-check fName" style="color: #5da454; position: absolute; right: 8px; top:10px" aria-hidden="hidden"></i>
                                                        <i class="fa fa-times fName" style="color: red; position: absolute; right: 8px; top:10px" aria-hidden="hidden"></i>
                                                        <i class="fa fa-spinner fa-pulse fName" style="color: grey; position: absolute; right: 8px; top:10px" aria-hidden="hidden"></i>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-md-6 col-lg-6">
                                                    <div class="form-group" style="position:relative">
                                                        <input type="text" name="lName" class="form-control col-xs-6 col-md-6 col-lg-6" onfocus="($('.fa.lName').hide())" placeholder="Last Name" required="required">
                                                        <i class="fa fa-check lName" style="color: #5da454; position: absolute; right: 8px; top:10px" aria-hidden="hidden"></i>
                                                        <i class="fa fa-times lName" style="color: red; position: absolute; right: 8px; top:10px" aria-hidden="hidden"></i>
                                                        <i class="fa fa-spinner fa-pulse lName" style="color: grey; position: absolute; right: 8px; top:10px" aria-hidden="hidden"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tID">Tenant Identification:</label>
                                            <input type="text" class="form-control" name="tID" placeholder="Enter tenant names above:" required="required" readonly>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-7 col-lg-12">
                                        <div class="row">
                                            <div class="col-xs-4 col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <label for="hNo">House Number:</label>
                                                    <input type="text" name="hNo" class="form-control" placeholder="House Number" required="required" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <label for="hLc">House Location</label>
                                                    <input type="text" class="form-control" placeholder="House Location" required="required" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-xs-4 col-md-4 col-lg-4">
                                                <div class="form-group">
                                                    <label for="rpm">Rent per Month:</label>
                                                    <input type="text" name="rpm" class="form-control" placeholder="Rent Per Month" required="required" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-7 col-lg-12">
                                        <div class="form-group">
                                            <label for="amtPd">Amount Paid:</label>
                                            <input type="text" name="amtPd" onfocus="CheckName(this.parentNode.parentNode.parentNode)" placeholder="Amount Paid" required="required" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-7 col-lg-12">
                                        <div class="form-group">
                                            <label for="admin">Added by:</label>
                                            <input type="text" class="form-control" value="<?php echo $_SESSION['fName'] . ' ' . $_SESSION['lName']; ?>" disabled readonly>
                                            <input type="text" name="admin" value="<?php echo $_SESSION['id']; ?>" aria-hidden="hidden" hidden="hidden">
                                        </div>
                                    </div>
                                    <div class="row button">
                                        <div class="col-xs-11" style="margin-left:21px">
                                            <button class="btn btn-success btn-lg btn-block" type="submit" disabled>Add Payment</button>
                                        </div>
                                    </div>
                                    <div class="row" style="display:none;">
                                        <div class="col-xs-12">
                                            <p class="payment-errors"></p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* CSS for Credit Card Payment form */
    .credit-card-box .panel-title {
        display: inline;
        font-weight: bold;
    }

    .credit-card-box .form-control.error {
        border-color: red;
        outline: 0;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
    }

    .credit-card-box label.error {
        font-weight: bold;
        color: red;
        padding: 2px 8px;
        margin-top: 2px;
    }

    .credit-card-box .payment-errors {
        font-weight: bold;
        color: red;
        padding: 2px 8px;
        margin-top: 2px;
    }

    .credit-card-box label {
        display: block;
    }

    /* The old "center div vertically" hack */
    .credit-card-box .display-table {
        display: table;
    }

    .credit-card-box .display-tr {
        display: table-row;
    }

    .credit-card-box .display-td {
        display: table-cell;
        vertical-align: middle;
        width: 50%;
    }

    /* Just looks nicer */
    .credit-card-box .panel-heading img {
        min-width: 180px;
    }
</style>
<script>
    $.getScript('//cdn.tms-dist.lan:433/styles/js/moment.min.js', ()=>{
        console.log("Moment loaded")
        $.getScript('//cdn.tms-dist.lan:433/styles/bdtp/js/bootstrap-datetimepicker.min.js', ()=>{
            console.log("Date-Time Picker Plugin Loaded")
        })
    })
</script>
</script>
<script>
    dtp = () => {
        if (typeof moment == 'undefined') {
            setTimeout(dtp, 1000)
        } else {
            $('#dtp').datetimepicker({
                viewMode: 'years',
            })
        }
    }
    dtp()
</script>