<!DOCTYPE html>
<html>

<head>
	<title>Department Hierarchy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		body {
			margin-top: 20px;
		}

		.tree li {
			list-style-type: none;
			margin: 10px;
			position: relative;
		}

		.tree li:before {
			content: "";
			position: absolute;
			top: -7px;
			border-top: 1px solid #ccc;
			left: 0;
			width: 100%;
			height: 8px;
		}

		.tree li:after {
			content: "";
			position: absolute;
			top: 1px;
			border-left: 1px solid #ccc;
			left: 0;
			width: 0;
			height: 100%;
		}

		.tree li a {
			display: inline-block;
			padding: 3px 8px;
			text-decoration: none;
			color: #666;
			font-size: 14px;
			border: 1px solid #ccc;
			border-radius: 5px;
			transition: all 0.3s;
			position: relative;
		}

		.tree li a:hover,
		.tree li a:hover+ul li a {
			background: #c8e4f8;
			color: #000;
			border: 1px solid #94a0b4;
		}

		.tree li a:hover+ul li:before,
		.tree li a:hover+ul li:after,
		.tree li a:hover+ul:before,
		.tree li a:hover+ul:after {
			border-color: #94a0b4;
		}

		.tree li .arrow::before {
			content: "►";
			position: absolute;
			top: 50%;
			left: -1.5em;
			transform: translateY(-50%);
			font-size: 1.2em;
		}

		.tree li.expanded>.arrow::before {
			content: "▼";
		}

		.tree ul {
			margin-left: 1em;
		}
	</style>
</head>

<body>
	<div class="container">
		<h1>Department Hierarchy</h1>
		<div class="row">
			<div class="col-md-12">
				<ol class="tree">
					<?php
					session_start();
                    include 'db.php';
                    $db = new DbConnection();

					$user_id = $_SESSION['id'];
				
					$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
					$acces_query = $db->execute_query($sql);
                    
					$is_admin = ($acces_query[0]['is_admin'] == 1);
                    // var_dump($is_admin);
					// die("here");

					if (empty($_SESSION['id']) || !$is_admin) {
						header('Location:Login.php');
						exit();
					}

					$query_depart = "SELECT * FROM department";
					$resp_depart = $db->execute_query($query_depart);

					$arr = [];
					foreach ($resp_depart as $row) {
						$arr[$row['id']]['name'] = $row['name'];
						$arr[$row['id']]['parent_id'] = $row['parent_id'];
					}

					buildTreeView($arr, 0);

					function buildTreeView($arr, $parent, $level = 0, $prelevel = -1)
					{
						foreach ($arr as $id => $data) {
							if ($parent == $data['parent_id']) {
								if ($level > $prelevel) {
									echo "<ol>";
								}
								if ($level == $prelevel) {
									echo "</li>";
								}
								echo "<li class='expanded'><a class='arrow' href='Department.php?department_id=" . $id . "'>" . $data['name'] . "</a>";
								if ($level > $prelevel) {
									$prelevel = $level;
								}
								$level++;
								buildTreeView($arr, $id, $level, $prelevel);
								$level--;
							}
						}
						if ($level == $prelevel) {
							echo "</li></ol>";
						}
					}

					if (isset($_GET['department_id'])) {
						$department_id = $_GET['department_id'];
						if (!empty($department_id)) {
							$db = new DbConnection();
							$sql = "SELECT * FROM users WHERE department_id = '$department_id'";
							$employees = $db->execute_query($sql);
							if (count($employees) == 0) {
								echo "No employees found in this department.";
							} else {
								echo "<title> Department Employees </title><ul>";
								foreach ($employees as $employee) {
									echo "<table class=\"table\"><thead><tr><th>Name</th><th>Surname Info</th><th>Username</th></tr></thead><tbody>";
									echo "<tr>";
									echo "<td>" . $employee['name'] . "</td>";
									echo "<td>" . $employee['surname'] . "</td>";
									echo "<td>" . $employee['username'] . "</td>";
									echo "</tr></tbody></table>";
								}
								echo "</ul>";
							}
						}
					}
					?>
				</ol>
				<center>
					<a href="Home.php" class="btn btn-secondary">Back</a>
				</center>
				
				<head>
					<title>Department List</title>
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
				</head>

				<body>
					<div class="container">
						<h1>Department List</h1>
						<a href="CreateDepartment.php" class="btn btn-primary mb-3">Create Department</a>
						<table class="table">
							<thead>
								<tr>


									<th>Department</th>
									<th>Department Info</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
                                 
                                $sql = "SELECT * FROM department";
								$result = $db->execute_query($sql);
                            
								foreach ($result as $value) {
									echo "<tr>";
									echo "<td>" . $value["name"] . "</td>";
									echo "<td>" . $value["department_info"] . "</td>";
									echo "<td><a href='UpdateDepartment.php?id=" . $value["id"] .
										"' class='btn btn-sm btn-info mr-2'>Update</a><a href='DeleteDepartment.php?id=" .
										$value["id"] . "' class='btn btn-sm btn-danger'>Delete</a></td>";
									echo "</tr>";
								}

								?>
							</tbody>
						</table>
					</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.
			</div>
		</div>
	</div>


			