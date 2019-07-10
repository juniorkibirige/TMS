<link rel="stylesheet" href="https://cdn.tms-dist.lan:433/styles/css/custom.css" type="text/css" />
<?php session_start();
include('db.inc.php');
$sql = 'select * from accounts where confirm = 0';
$sql = mysqli_query($con, $sql);
if (!$sql) {
    die('Error: ' . mysqli_error($con));
} else {
    if (mysqli_num_rows($sql) == 0) {
        echo '<div id="no_verify" class="container contain alert alert-info tms-center col-md-12" style="margin-top:50px">
        No users to verify at this moment.</div>';
    } else {
        ?>
        <div id="ver_det" class="col-md-12 col-xs-12" style="">
            <table border="1" class="col-xs-12 col-md-12 col-lg-12" style="">
                <th colspan=4 style="font-size:20px; color:antiquewhite;text-align:center">Users to be verified
                </th>
                <tr class="tms-center" colspan=4>
                    <th class="tms-center" style="color:darkslategrey;width:auto">National ID Number</th>
                    <th class="tms-center" style="color:darkslategrey;width:auto">Username</th>
                    <th class="tms-center" style="color:darkslategrey;width:auto">Level</th>
                    <th class="tms-center" style="color:darkslategrey;width:auto">Verify</th>
                </tr><?php
                        while ($result = mysqli_fetch_assoc($sql)) {
                            $id = $result['id']; ?>
                    <tr class="tms-center">
                        <td><?php echo $result['NIN']; ?></td>
                        <td><?php echo $result['username']; ?></td>
                        <td><?php
                            if ($result['level'] == 1) echo 'Manager';
                            else if ($result['level'] == 2) echo 'Cashier';
                            else if ($result['level'] == 3) echo 'Trainer';
                            else if ($result['level'] == 4) echo 'Clientele';
                            else echo 'Unknown level';
                            ?></td>
                        <td>
                            <input type="checkbox" name="id" onclick="verify(<?php echo $id; ?>)">
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div id="status"></div>
    <?php
}
}
echo "<script>
$('#no_verify').ready(function(){
    var div = document.getElementById('verify');
    div.style.display = 'block';
});

$('#no_verify').ready(function() {
    $('#no_verify').css({
        'width': 100 + '%'
    });
});
</script>";
?>