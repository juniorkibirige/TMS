<?php
session_start();
if (isset($_COOKIE['return'])) {
    echo '<script>notifyMe("' . $_SESSION['fName'] . '");</script>';
    setcookie("return", '', time() - 60 * 60 * 24 * 30, '/', 'tms.lan', true, true);
}
?>
<link rel="stylesheet" href="//cdn.tms-dist.lan:433/styles/css/tenant.min.css">
<div class="tcontainer">
    <div id="sidebar" class="col-lg-6 col-md-6 col-xs-6">
        <div class="sidebar-header lactive">
            <a id="dash" href="javascript:void(0)" style="float:left;" onclick="$('.sidebar-header').addClass('lactive')">
                <div id="icon" style="float:left;position:relative">
                    DBrd
                </div>
                <div id="text" style="float:left;position:relative;">Dashboard</div>
            </a>
            <div class="tractor retract">
                < </div> <div class="tractor expand" style="display:none;">
                    >
            </div>
        </div>
        <div class="sidebar-separator"></div>
        <div class="sidebar-content">
            <ul style="list-style:none;">
                <li class="s-content pay">
                    <a class="s-text" href="javascript:void(0)" id="pay" onclick='$(this.parent).addClass("lactive")'>
                        <span id="icon">
                            PD
                        </span>
                        <span id="text">Payment Details</span>
                    </a>
                </li>
                <li class="s-content arr">
                    <a class="s-text" href="javascript:void(0)" id="arrears">
                        <span id="icon">
                            RA
                        </span>
                        <span id="text">
                            Rent Arrears
                        </span>
                    </a>
                </li>
                <li class="s-content complaints">
                    <a class="s-text" href="javascript:void(0)" id="complaints">
                        <span id="icon">
                            C
                        </span>
                        <span id="text">Complaints</span>
                    </a>
                </li>
                <li class="s-content">
                    <a class="s-text" href="#">
                        <span id="icon">
                            TC
                        </span>
                        <span id="text">Test Content</span>
                    </a>
                </li>
                <li class="s-content">
                    <a class="s-text" href="#">
                        <span id="icon">
                            TC
                        </span>
                        <span id="text">Test Content</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div id="scontent" id="content" class="col-lg-6 col-md-6 col-xs-6">
        <div class="dashboard" style="display:block">Dashboard data</div>
        <div class="paydet" style="display:none">Payment Details</div>
        <div class="rentarrears" style="display:none">Rent Arrears</div>
        <div class="complnts" style="display:none">Complaints Page</div>
        <div class="ed" style="display:none"></div>
    </div>
</div>
<script>
    LD();
    $(".tractor.retract").click(function() {
        $(".tractor.retract").css({
            display: "none"
        });
        $(".tractor.expand").css({
            display: "block"
        });
        collapse();
    });
    $(".tractor.expand").click(function() {
        $(".tractor.retract").css({
            display: "block"
        });
        $(".tractor.expand").css({
            display: "none"
        });
        expand();
    });
    var dash = document.getElementById("dash"),
        pay_det = document.getElementById("pay"),
        arrears = document.getElementById("arrears"),
        complaints = document.getElementById("complaints");
    dash.addEventListener("click", _ => {
        $(".dash").addClass("lactive");
        $(".pay").removeClass("lactive");
        $(".arr").removeClass("lactive");
        $('.complaints').removeClass('lactive');
        $(".dashboard").css({
            "display": "block"
        });
        $(".paydet").css({
            "display": "none"
        });
        $(".rentarrears").css({
            "display": "none"
        });
        $('.complnts').css({
            "display": "none"
        });
        LD();
    });
    pay_det.addEventListener("click", _ => {
        $(".pay").addClass("lactive");
        $(".arr").removeClass("lactive");
        $('.sidebar-header').removeClass('lactive');
        $('.complaints').removeClass('lactive');
        $(".paydet").css({
            "display": "block"
        });
        $(".dashboard").css({
            "display": "none"
        });
        $(".rentarrears").css({
            "display": "none"
        });
        $('.complnts').css({
            "display": "none"
        });
        PD();
    });
    arrears.addEventListener("click", _ => {
        $(".pay").removeClass("lactive");
        $(".arr").addClass("lactive");
        $('.sidebar-header').removeClass('lactive');
        $('.complaints').removeClass('lactive');
        $(".rentarrears").css({
            "display": "block"
        });
        $(".dashboard").css({
            "display": "none"
        });
        $(".paydet").css({
            "display": "none"
        });
        $('.complnts').css({
            "display": "none"
        });
    });
    complaints.addEventListener("click", _ => {
        $(".pay").removeClass("lactive");
        $(".arr").removeClass("lactive");
        $('.sidebar-header').removeClass('lactive');
        $('.complaints').addClass('lactive');
        $(".rentarrears").css({
            "display": "none"
        });
        $(".dashboard").css({
            "display": "none"
        });
        $(".paydet").css({
            "display": "none"
        });
        $('.complnts').css({
            "display": "block"
        });
    });
</script>