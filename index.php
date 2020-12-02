<?php

$link = mysqli_connect( "127.0.0.1", "python-app", "brassica", "students");

if(!$link){
    echo "Fehler: konnte nicht mit MySQL verbinden." . PHP_EOL;
    echo "Debug-Fehlernummer: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debug-Fehlermeldung: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$result = mysqli_query($link, "SELECT * FROM noten ORDER BY lastname");







function createTable($data){
    echo
    "<tr>
    <td class='firstname'>".$data['firstname']."</td>
    <td class='lastname'>".$data['lastname']."</td>
    <td class='grade'>".$data['grade']."</td>
    <td class='id'>".$data['id']."</td>
    <td><a href='#editEmployeeModal'data-toggle='modal' class='edit-button'><button class='btn btn-warning'>Bearbeiten</button></a></td>
    <td><a href='#deleteEmployeeModal'data-toggle='modal' class='delete-button'><button class='btn btn-danger'>Löschen</button></a></td>
    </tr>
";
}



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" </head> <body>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Noten</title>
    <link rel="stylesheet" href="example.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script>
        $('[data-toggle="tooltip"]').tooltip();
    </script>
</head>
    <body>
        <div class="container">
            <div class="table-responsive-md">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col">
                                <h2>Notenspiegel</b></h2>
                            </div>
                            <div class="col">
                                <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Studenten hinzufügen</span></a>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Vorname</th>
                                <th>Nachname</th>
                                <th>Note</th>
                                <th>MartikelNr.</th>
                                <th colspan="2">Aktionen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = mysqli_fetch_array($result)){
                                    createTable($row);
                                }

                            ?>
                        </tbody>
    <!-- Add Modal HTML -->                           
    <div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="/api/new.php", method="POST">
					<div class="modal-header">						
						<h4 class="modal-title">Studenten hinzufügen</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Vorname</label>
							<input type="text" name="vorname" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nachname</label>
							<input type="text" name="nachname" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Note</label>
							<input type="text" name="grade" class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Abbrechen">
						<input type="submit" class="btn btn-success" value="Hinzufügen">
					</div>
				</form>
			</div>
		</div>
    </div>
    <!-- Edit Modal HTML -->                           
    <div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="/api/update.php", method="POST">
					<div class="modal-header">						
						<h4 class="modal-title">Studenten bearbeiten</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Vorname</label>
							<input type="text" name="vorname" id="vorname-edit" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nachname</label>
							<input type="text" name="nachname"  id="nachname-edit"class="form-control" required>
						</div>
						<div class="form-group">
							<label>Note</label>
							<input type="text" name="grade" id="grade-edit"class="form-control" required>
						</div>					
						<div class="form-group">
							<input type="hidden" name="id" id="id-edit"class="form-control" required>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Abbrechen">
						<input type="submit" class="btn btn-success" value="Bearbeiten">
					</div>
				</form>
			</div>
		</div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="/api/delete.php", method="GET">
					<div class="modal-header">						
						<h4 class="modal-title">Studenten löschen</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
                        <div class="form-group">
							<label>Vorname</label>
							<input type="text" id="vorname-delete" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Nachname</label>
                            <input type="text" id="nachname-delete" class="form-control" readonly>
						</div>
						<p>Sind Sie sich sicher diesen Studenten zu löschen?</p>
                        <p class="text-warning"><small>Diese Aktion kann nicht rückgängig gemacht werden.</small></p>
                        <input type="hidden" name="id" id="student-id-delete"/>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Abbrechen">
						<input type="submit" class="btn btn-danger" value="Löschen">
					</div>
				</form>
			</div>
		</div>
	</div>
    <script>
        $(".delete-button").click(function () {
            var studentId = $(this).parent().siblings(".id")[0].textContent
            var studentFirst = $(this).parent().siblings(".firstname")[0].textContent;
            var studentLast = $(this).parent().siblings(".lastname")[0].textContent;
            $(".modal-body #student-id-delete").val( studentId );
            $(".modal-body #vorname-delete").val( studentFirst );
            $(".modal-body #nachname-delete").val( studentLast );
        });
        $(".edit-button").click(function () {
            var studentId = $(this).parent().siblings(".id")[0].textContent
            var studentFirst = $(this).parent().siblings(".firstname")[0].textContent;
            var studentLast = $(this).parent().siblings(".lastname")[0].textContent;
            var studentGrade = $(this).parent().siblings(".grade")[0].textContent;
            $(".modal-body #id-edit").val(studentId);
            $(".modal-body #grade-edit").val(studentGrade);
            $(".modal-body #vorname-edit").val(studentFirst);
            $(".modal-body #nachname-edit").val(studentLast);
        });
    </script>                            
    
    </body>

</html>