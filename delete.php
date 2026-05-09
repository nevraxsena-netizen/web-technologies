<?php
    include 'db_connection.php';
    $id = $firstName = $lastName = $departmentId = $position = '';
    include 'get_employee.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Delete Employee</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
  <div class="container my-5">
    <h2 class="mb-4 text-danger">Delete Employee</h2>
    
    <div class="alert alert-warning shadow-sm">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        Are you sure you want to delete this employee? This action cannot be undone.
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
              <div class="col-sm-12 col-md-6 col-lg-4 mb-2 mb-md-0">
                  <strong>Name:</strong> <?php echo htmlspecialchars($firstName . ' ' . $lastName); ?>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-4 mb-2 mb-md-0">
                  <strong>Position:</strong> <?php echo htmlspecialchars($position); ?>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-4">
                  <strong>Department:</strong> 
                  <?php
                        try {
                            $query = "SELECT Name FROM Department WHERE Id = ?";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute([$departmentId]);
                            $department = $stmt->fetch(PDO::FETCH_ASSOC);
                            echo $department ? htmlspecialchars($department['Name']) : 'N/A';
                        } catch (PDOException $e) {
                            echo "Error loading department";
                        }
                  ?>
              </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">
      <a href="list.php" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to List
      </a>
      <form action="process_delete.php" method="POST" class="d-inline">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <button type="submit" class="btn btn-danger">
          <i class="bi bi-trash-fill"></i> Confirm Delete
        </button>
      </form>
    </div>
  </div>
</body>
</html>