<?php
define('ROOT_DIR', '');
require_once(ROOT_DIR . 'includes/loader.php');
require_once(ROOT_DIR . 'includes/partials/header.php');

$resultAsset = Asset::getAsset($user->DepartmentId);

?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />

<div style="background-color:whitesmoke; padding:10px;">
    <h3 style="text-align:center;"><?php echo $user->DepartmentDesc . ' Department Asset Management' ?></h3>
    <div>
        <table id="tblAsset">
            <thead>
                <th>Tag</th>
                <th>Description</th>
                <th>Category</th>
                <th>Assign To</th>
                <th></th>
            </thead>
            <tbody>
                <?php if (!empty($resultAsset)) { ?>
                    <?php foreach ($resultAsset as $row) {
                        if (($row['AssignToUserId'] == 0 || $row['AssignToUserId'] == $user->UserId) && $row['Status'] == 'Ready') { ?>
                            <tr>
                                <td><?php echo $row['Tag']; ?></td>
                                <td><?php echo $row['Description']; ?></td>
                                <td><?php echo $row['Category']; ?></td>
                                <?php
                                if ($row['AssignToUserId'] == $user->UserId) {
                                    echo '<td>' . $row['FirstName'] . ' ' . $row['LastName'] . '</td>';
                                    echo '<td><button type="button" class="btn btn-warning updateAMBtn">Return</button></td>';
                                } else {
                                    echo '<td>Available</td>';
                                    echo '<td><button type="button" class="btn btn-primary updateAMBtn">Request</button></td>';
                                }
                                ?>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tblAsset').DataTable({
            order: [
                [3, 'desc']
            ]
        });

        var tableU = $('#tblAsset').DataTable();

        $('#tblAsset tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                tableU.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
    });
</script>
<?php require_once(ROOT_DIR . 'includes/partials/footer.php'); ?>