<?php

include "db.php";
					session_start();
					$db = new DbConnection();

					$user_id = $_SESSION['id'];

					$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
					$acces_query = $db->execute_query($sql);

					$is_admin = ($acces_query[0]['is_admin'] == 1);

					if (empty($_SESSION['id']) || !$is_admin) {
						header('Location:login.php');
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
			</div>
		</div>
	</div>
