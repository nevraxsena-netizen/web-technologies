<?php
    include 'db_connection.php';
    $id = $number = $firstName = $lastName = $departmentId = $position = $salary = $hireDate = '';
    include 'get_employee.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Employee Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
  <div class="container my-5">
    <h2 class="mb-4">Employee Registration</h2>
    <div class="card shadow">
        <div class="card-body">
          <form action="process_employee.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row g-3 mb-3">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="empNumber" class="form-label">Employee Number</label>
                    <input type="text" class="form-control" id="empNumber" name="empNumber" value="<?php echo $number; ?>" placeholder="EMP12345" required>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="department" class="form-label">Department</label>
                    <select class="form-select" id="department" name="department" required>
                      <option disabled <?php if(empty($departmentId)) echo 'selected'; ?>>Choose...</option> 
                      <?php
                        try {
                            $query = "SELECT Id, Name FROM Department";
                            $stmt = $pdo->query($query);
                            while ($department = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($department['Id'] == $departmentId) ? 'selected' : '';
                                echo "<option value='{$department['Id']}' $selected>{$department['Name']}</option>";
                            }
                        } catch (PDOException $e) {
                            echo "<option value=''>Error loading departments</option>";
                        }
                      ?>                  
                    </select>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName; ?>" placeholder="Enter first name" required>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName; ?>" placeholder="Enter last name" required>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position" value="<?php echo $position; ?>" placeholder="Enter position" required>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <label for="salary" class="form-label">Salary ($)</label>
                    <input type="number" step="0.01" class="form-control" id="salary" name="salary" value="<?php echo $salary; ?>" placeholder="e.g., 50000" required>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <label for="hireDate" class="form-label">Hire Date</label>
                    <input type="date" class="form-control" id="hireDate" name="hireDate" value="<?php echo $hireDate; ?>" required>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
              <a href="list.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to List
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-person-check-fill"></i> Save Employee
              </button>
            </div>
          </form>
        </div>
    </div>
  </div>
</body>
</html>