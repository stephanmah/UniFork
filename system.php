<?php
define('ROOT_DIR', '');
require_once(ROOT_DIR.'includes/loader.php');
require_once(ROOT_DIR.'includes/partials/header.php');

$resultAM = AccessManagement::GetAllAccess(null,null);
$resultDept = System::getDepartment();
$resultRole = System::getRole();
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />

<div style="border: 1px solid lightgrey; padding: 10px; background-color:aliceblue; height:100%;">

<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="AccessManagement" >
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <h5>Access Management Setting</h5>
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
       
      <div>
        <table id="tblAM">
            <thead>
                <th>Department Code</th>
                <th>Department Description</th>
                <th>RoleCode</th>
                <th>Role Description</th>
                <th>Access Level Code</th>
                <th>Access Level Description</th>
                <th>App Code</th>
                <th>App Description</th>
            </thead>
            <tbody>
                <?php if(!empty($resultAM)) { ?>
                    <?php foreach($resultAM as $row) { ?>
                        <tr>
                            <td><?php echo $row['DepartmentCode']; ?></td>
                            <td><?php echo $row['DepartmentDesc']; ?></td>
                            <td><?php echo $row['RoleCode']; ?></td>
                            <td><?php echo $row['RoleDesc']; ?></td>
                            <td><?php echo $row['AccessLevelCode']; ?></td>
                            <td><?php echo $row['AccessLevelDesc']; ?></td>
                            <td><?php echo $row['AppCode']; ?></td>
                            <td><?php echo $row['AppDesc']; ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
            <tfoot>
                    <tr>
                        <th>Access:</th>
                        <th>Department Description</th>
                        <th></th>
                        <th>Role Description</th>
                        <th></th>
                        <th>Access Level Description</th>
                        <th></th>
                        <th>App Description</th>
                    </tr>
                </tfoot>
        </table>
        </div>

      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
      <h5>System Tables</h5>
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
      <div>
            <h6>Department Table</h6>
            <table id="tblDept">
                <thead>
                    <th>Department Id</th>
                    <th>Department Code</th>
                    <th>Department Description</th>

                </thead>
                <tbody>
                    <?php if(!empty($resultDept)) { ?>
                        <?php foreach($resultDept as $row) { ?>
                            <tr>
                                <td><?php echo $row['DepartmentId']; ?></td>
                                <td><?php echo $row['DepartmentCode']; ?></td>
                                <td><?php echo $row['DepartmentDesc']; ?></td>

                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>

      </div>
    </div>
  </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $('#tblDept').DataTable();
    $('#tblAM').DataTable({
        initComplete: function () {
            this.api()
                .columns([1,3,5,7])
                .every(function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
 
                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                });
        },
    });
} );
</script>

</div>
<?php require_once(ROOT_DIR.'includes/partials/footer.php'); ?>