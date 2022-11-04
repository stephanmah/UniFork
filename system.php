<?php
define('ROOT_DIR', '');
require_once(ROOT_DIR . 'includes/loader.php');
require_once(ROOT_DIR . 'includes/partials/header.php');

$resultAM = AccessManagement::GetAllAccess(null, null);
$resultAMUsers = AccessManagement::GetAllUsers();
$resultDept = System::getDepartment();
$resultRole = System::getRole();
$resultAccessLevel = System::getAccessLevel();
$resultApp = System::getApp();

?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />


<!-- Update AM Modal -->
<div class="modal fade" id="AMModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/examples/actions/confirmation.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Access Management</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="m-4">
                        <input hidden value="" id=accessIdInput />
                        <div class="mb-3">
                            <label class="form-label" for="roleSelect">Role:</label>
                            <select id="roleSelect" class="form-select" aria-label="Default select example">
                                <option value="0"></option>
                                <?php foreach ($resultRole as $row) { ?>
                                    <option value="<?php echo $row['RoleId'] ?>"><?php echo $row['RoleDesc'] ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" id="roleInput" hidden readonly class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="departmentSelect">Department:</label>
                            <select id="departmentSelect" class="form-select" aria-label="Default select example">
                                <option value="0"></option>
                                <?php foreach ($resultDept as $row) { ?>
                                    <option value="<?php echo $row['DepartmentId'] ?>"><?php echo $row['DepartmentDesc'] ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" id="departmentInput" hidden readonly class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="accessLevelSelect">Access Level:</label>
                            <select id="accessLevelSelect" class="form-select" aria-label="Default select example">
                                <option value="0"></option>
                                <?php foreach ($resultAccessLevel as $row) { ?>
                                    <option value="<?php echo $row['AccessLevelId'] ?>"><?php echo $row['AccessLevelDesc'] ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" id="accessLevelInput" hidden readonly class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="appSelect">App:</label>
                            <select id="appSelect" class="form-select" aria-label="Default select example">
                                <option value="0"></option>
                                <?php foreach ($resultApp as $row) { ?>
                                    <option value="<?php echo $row['AppId'] ?>"><?php echo $row['AppDesc'] ?></option>
                                <?php } ?>
                            </select>
                            <input type="text" id="appInput" hidden readonly class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="accessAddBtn" class="btn btn-primary  accessMaintain" hidden>+Add</button>
                    <button type="button" id="accessUpdateBtn" class="btn btn-warning  accessMaintain" hidden>~Update</button>
                    <button type="button" id="accessDeleteBtn" class="btn btn-danger  accessMaintain" hidden>~Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div style="border: 1px solid lightgrey; padding: 10px; background-color:aliceblue; ">

    <div class="accordion" id="accordionAM">
        <div class="accordion-item">
            <h2 class="accordion-header" id="AccessManagement">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h5>Access Management Setting</h5>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionAM">
                <div class="accordion-body">

                    <div>
                        <table id="tblAM">
                            <thead>
                                <th>Role</th>
                                <th>Department</th>
                                <th>Access Level</th>
                                <th>Application</th>
                                <th>Access Id</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php if (!empty($resultAM)) { ?>
                                    <?php foreach ($resultAM as $row) { ?>
                                        <tr>
                                            <td><?php echo $row['RoleDesc']; ?></td>
                                            <td><?php echo $row['DepartmentDesc']; ?></td>
                                            <td><?php echo $row['AccessLevelDesc']; ?></td>
                                            <td><?php echo $row['AppDesc']; ?></td>
                                            <td><?php echo $row['AccessId']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary updateAMBtn" data-bs-toggle="modal" data-bs-target="#AMModal" data-accessid="<?php echo $row['AccessId']; ?>">~Update</button>
                                                <button type="button" class="btn btn-danger deleteAMBtn" data-bs-toggle="modal" data-bs-target="#AMModal" data-accessid="<?php echo $row['AccessId']; ?>">-Delete</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Role Description</th>
                                    <th>Department Description</th>
                                    <th>Access Level Description</th>
                                    <th>App Description</th>
                                    <th>Access Id</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
                <div style="margin: 25px;">
                    <button type="button" id="addAMBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AMModal">+ Add Access</button>
                </div>
            </div>
        </div>

        <!-- Update User Modal -->
        <div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/examples/actions/confirmation.php" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="m-4">
                                <input hidden value="" id=userIdInput />
                                <div class="mb-3">
                                    <label class="form-label" for="userNameInput">Username:</label>
                                    <input type="text" id="userNameInput" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" id="passwordLabel" for="passwordInput">Password:</label>
                                    <input type="text" id="passwordInput" class="form-control" placeholder="Password" aria-label="password" aria-describedby="basic-addon1">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="firstNameInput">First Name:</label>
                                    <input type="text" id="firstNameInput" class="form-control" placeholder="First Name" aria-label="firstName" aria-describedby="basic-addon1">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="lastNameInput">Last Name:</label>
                                    <input type="text" id="lastNameInput" class="form-control" placeholder="Last Name" aria-label="lastName" aria-describedby="basic-addon1">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="emailInput">Email:</label>
                                    <input type="email" id="emailInput" class="form-control" placeholder="Email" aria-label="email" aria-describedby="basic-addon1">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="roleSelect">Role:</label>
                                    <select class="form-select" id="roleSelect" aria-label="Default select example" id="roleSelect">
                                        <option value="0"></option>
                                        <?php foreach ($resultRole as $row) { ?>
                                            <option value="<?php echo $row['RoleId'] ?>"><?php echo $row['RoleDesc'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="text" id="roleInput" hidden readonly class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="departmentSelect">Department:</label>
                                    <select class="form-select" id="departmentSelect" aria-label="Default select example" id="departmentSelect">
                                        <option value="0"></option>
                                        <?php foreach ($resultDept as $row) { ?>
                                            <option value="<?php echo $row['DepartmentId'] ?>"><?php echo $row['DepartmentDesc'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="text" id="departmentInput" hidden readonly class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="userAddBtn" class="btn btn-primary userMaintain" hidden>+Add</button>
                            <button type="button" id="userUpdateBtn" class="btn btn-warning userMaintain" hidden>~Update</button>
                            <button type="button" id="userDeleteBtn" class="btn btn-danger userMaintain" hidden>~Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <h5>Users</h5>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionAM">
                <div class="accordion-body">
                    <div>
                        <table id="tblUsers">
                            <thead>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php if (!empty($resultAMUsers)) { ?>
                                    <?php foreach ($resultAMUsers as $row) { ?>
                                        <tr>
                                            <td><?php echo $row['Name']; ?></td>
                                            <td><?php echo $row['Role']; ?></td>
                                            <td><?php echo $row['Department']; ?></td>
                                            <td>
                                                <?php
                                                if ($row['UserId'] != $user->UserId) { ?>
                                                    <button type="button" class="btn btn-primary updateUserBtn" data-bs-toggle="modal" data-bs-target="#userModal" data-userid="<?php echo $row['UserId']; ?>">~Update</button>
                                                    <button type="button" class="btn btn-danger deleteUserBtn" data-bs-toggle="modal" data-bs-target="#userModal" data-userid="<?php echo $row['UserId']; ?>">-Delete</button>
                                                <?php } else { ?>
                                                    <button type="button" class="btn btn-info viewUserBtn" data-bs-toggle="modal" data-bs-target="#userModal" data-userid="<?php echo $row['UserId']; ?>">:View</button><span> No update allowed.</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Department</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div style="margin: 25px;">
                    <button type="button" id="addUserBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">+Add User</button>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        jQuery(document).ready(function($) {


            $('#tblDept').DataTable();

            $('#tblUsers').DataTable({
                initComplete: function() {
                    this.api()
                        .columns([0, 1, 2])
                        .every(function() {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append('<option value="' + d + '">' + d + '</option>');
                                });
                        });
                },
            });

            var tableU = $('#tblUsers').DataTable();

            $('#tblUsers tbody').on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    tableU.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            $('.viewUserBtn').click(function() {
                clearUserModal()
                //alert($(this).data("userid"));
                $.ajax({
                    type: "GET",
                    url: 'models/userGet.php',
                    data: {
                        userId: $(this).data("userid")
                    },
                    dataType: "json",
                    success: function(data) {
                        $('userIdInput').val(data.result.UserId);
                        $('#userNameInput').val(data.result.UserName).attr('readonly', true);
                        $('#passwordInput').attr("hidden",true);
                        $('#passwordLabel').attr("hidden",true);
                        $('#firstNameInput').val(data.result.FirstName).attr('readonly', true);
                        $('#lastNameInput').val(data.result.LastName).attr('readonly', true);
                        $('#emailInput').val(data.result.Email).attr('readonly', true);
                        $('#roleSelect option[value="' + data.result.RoleId + '"]').attr('selected', 'selected');
                        $('#departmentSelect option[value="' + data.result.DepartmentId + '"]').attr('selected', 'selected');
                        $('#roleInput').val($('#roleSelect option:selected').text()).attr('readonly', true).attr('hidden', false);
                        $('#departmentInput').val($('#departmentSelect option:selected').text()).attr('readonly', true).attr('hidden', false);
                        $('select').attr('hidden', true);
                        
                    },
                    error: function(request, status, error) {
                        alert(request.responseText);
                    }
                });
            });

            $('#addUserBtn').click(function() {
                clearUserModal();
                $('#userAddBtn').attr('hidden',false);
                //alert($(this).data("userid"));
            });

            $('.updateUserBtn').click(function() {
                clearUserModal();
                //alert($(this).data("userid"));
                $.ajax({
                    type: "GET",
                    url: 'models/userGet.php',
                    data: {
                        userId: $(this).data("userid")
                    },
                    dataType: "json",
                    success: function(data) {
                        $('userIdInput').val(data.result.UserId);
                        $('#userNameInput').val(data.result.UserName);
                        $('#passwordInput').attr("hidden",true);
                        $('#passwordLabel').attr("hidden",true);
                        $('#firstNameInput').val(data.result.FirstName);
                        $('#lastNameInput').val(data.result.LastName);
                        $('#emailInput').val(data.result.Email);
                        $('#roleSelect option[value="' + data.result.RoleId + '"]').attr('selected', 'selected');
                        $('#departmentSelect option[value="' + data.result.DepartmentId + '"]').attr('selected', 'selected');
                        $('#roleInput').val($('#roleSelect option:selected').text()).attr('readonly', true).attr('hidden', false);
                        $('#DepartmentInput').val($('#departmentSelect option:selected').text()).attr('readonly', true).attr('hidden', false);
                        $('select').attr('hidden', false);
                        $('#roleInput').attr("hidden",true);
                        $('#departmentInput').attr("hidden",true);
                        $('#userUpdateBtn').attr('hidden',false);
                    },
                    error: function(request, status, error) {
                        alert(request.responseText);
                    }
                });
            });

            $('.deleteUserBtn').click(function() {
                clearUserModal();
                //alert($(this).data("userid"));
                $.ajax({
                    type: "GET",
                    url: 'models/userGet.php',
                    data: {
                        userId: $(this).data("userid")
                    },
                    dataType: "json",
                    success: function(data) {
                        $('userIdInput').val(data.result.UserId);
                        $('#userNameInput').val(data.result.UserName).attr('readonly', true);;
                        $('#passwordInput').attr("hidden",true);
                        $('#passwordLabel').attr("hidden",true);
                        $('#firstNameInput').val(data.result.FirstName).attr('readonly', true);;
                        $('#lastNameInput').val(data.result.LastName).attr('readonly', true);;
                        $('#emailInput').val(data.result.Email).attr('readonly', true);;
                        $('#roleSelect option[value="' + data.result.RoleId + '"]').attr('selected', 'selected');
                        $('#departmentSelect option[value="' + data.result.DepartmentId + '"]').attr('selected', 'selected');
                        $('#roleInput').val($('#roleSelect option:selected').text()).attr('readonly', true).attr('hidden', false);
                        $('#departmentInput').val($('#departmentSelect option:selected').text()).attr('readonly', true).attr('hidden', false);
                        $('select').attr('hidden', true);
                        $('#userDeleteBtn').attr('hidden',false);
                    },
                    error: function(request, status, error) {
                        alert(request.responseText);
                    }
                });
            });

            
            //**********Access Management Table Begins *****************/
            $('#tblAM').DataTable({
                columnDefs: [{
                    target: 4,
                    visible: false,
                    searchable: false,
                }],
                initComplete: function() {
                    this.api()
                        .columns([0, 1, 2, 3])
                        .every(function() {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append('<option value="' + d + '">' + d + '</option>');
                                });
                        });
                },
            });

            var tableAM = $('#tblAM').DataTable();

            $('#tblAM tbody').on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    tableAM.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            $('#addAMBtn').click(function() {
                clearAMModal();
                $('#accessAddBtn').attr('hidden',false);
            });

            $('.updateAMBtn').click(function() {
                clearAMModal();
                $.ajax({
                    type: "GET",
                    url: 'models/accessGet.php',
                    data: {
                        accessId: $(this).data("accessid")
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#roleSelect option[value="' + data.result.RoleId + '"]').attr('selected', 'selected');
                        $('#departmentSelect option[value="' + data.result.DepartmentId + '"]').attr('selected', 'selected');
                        $('#accessLevelSelect option[value="' + data.result.AccessLevelId + '"]').attr('selected', 'selected');
                        $('#appSelect option[value="' + data.result.AppId + '"]').attr('selected', 'selected');
                        $('#roleInput').val($('#roleSelect option:selected').text()).attr('readonly', true).attr("hidden",true);;
                        $('#departmentInput').val($('#departmentSelect option:selected').text()).attr('readonly', true).attr("hidden",true);;
                        $('#accessLevelInput').val($('#accessLevelSelect option:selected').text()).attr('readonly', true).attr("hidden",true);;
                        $('#appInput').val($('#appSelect option:selected').text()).attr('readonly', true).attr("hidden",true);;
                        $('select').attr('hidden', false);
                        $('#accessUpdateBtn').attr('hidden',false);
                    },
                    error: function(request, status, error) {
                        alert(request.responseText);
                    }
                });

            });

            $('.deleteAMBtn').click(function() {
                clearAMModal();
                $.ajax({
                    type: "GET",
                    url: 'models/accessGet.php',
                    data: {
                        accessId: $(this).data("accessid")
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#roleSelect option[value="' + data.result.RoleId + '"]').attr('selected', 'selected');
                        $('#departmentSelect option[value="' + data.result.DepartmentId + '"]').attr('selected', 'selected');
                        $('#accessLevelSelect option[value="' + data.result.AccessLevelId + '"]').attr('selected', 'selected');
                        $('#appSelect option[value="' + data.result.AppId + '"]').attr('selected', 'selected');
                        $('#roleInput').val($('#roleSelect option:selected').text()).attr('readonly', true).attr("hidden",false);;
                        $('#departmentInput').val($('#departmentSelect option:selected').text()).attr('readonly', true).attr("hidden",false);;
                        $('#accessLevelInput').val($('#accessLevelSelect option:selected').text()).attr('readonly', true).attr("hidden",false);;
                        $('#appInput').val($('#appSelect option:selected').text()).attr('readonly', true).attr("hidden",false);;
                        $('select').attr('hidden', true);
                        $('#accessDeleteBtn').attr('hidden',false);
                    },
                    error: function(request, status, error) {
                        alert(request.responseText);
                    }
                });

            });
            //**********Access Management Table Ends *****************/
        });

        function clearUserModal() {
            $('userIdInput').val('');
            $('#userNameInput').val('').attr('readonly', false);
            $('#passwordInput').val('').attr('readonly', false);
            $('#passwordInput').attr("hidden",false);
            $('#passwordLabel').attr("hidden",false);
            $('#firstNameInput').val('').attr('readonly', false);
            $('#lastNameInput').val('').attr('readonly', false);;
            $('#emailInput').val('').attr('readonly', false);;
            $('option').removeAttr('selected');
            $('select').attr('hidden', false);
            $('#roleInput').val('').attr('hidden', true);
            $('#departmentInput').val('').attr('hidden', true);
            $('.userMaintain').attr('hidden', true);
        }

        function clearAMModal() {
            $('accessIdInput').val('');
            $('option').removeAttr('selected');
            $('select').attr('hidden', false);
            $('#roleInput').val('').attr('hidden', true);
            $('#departmentInput').val('').attr('hidden', true);
            $('#accessLevelInput').val('').attr('hidden', true);
            $('#appInput').val('').attr('hidden', true);
            $('.accessMaintain').attr('hidden', true);
        }
    </script>

</div>
<?php require_once(ROOT_DIR . 'includes/partials/footer.php'); ?>