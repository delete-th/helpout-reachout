
<?php
//entities/Category.php
require_once __DIR__ . '/../config/DBConnection.php';
class Category {

	public function getCategoryByCID($cID) {
		global $conn;
		$stmt = $conn->prepare("SELECT * FROM category WHERE cID = ?");
		$stmt->bind_param("i", $cID);
		$stmt->execute();
		return $stmt->get_result()->fetch_assoc();  //returns array
	}
	
	public function getCategoryByType($category) {
		global $conn;
		$stmt = $conn->prepare("SELECT * FROM category WHERE category LIKE ?");
		$like = "%" . $category . "%";
		$stmt->bind_param("s", $like);
		$stmt->execute();
		return $stmt->get_result()->fetch_assoc();  //returns array
	}
	
	public function getCategories() {
		global $conn;
		
		$result = $conn->query("SELECT * FROM category");
		
		while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
		return $categories; // return array
	}
	
	public function createCategory($category) {
		global $conn;
		
		$sql = $conn->prepare("INSERT INTO category (category) VALUES (?)");
		if (!$sql)
			return false;
			
		$sql->bind_param("s", $category );
					
		if (!$sql->execute()) {
			$sql->close();
			return false;
		}

		
		$sql->close();
		return true;
	}

	public function deleteCategory($cID) {
		global $conn;

		$stmt = $conn->prepare("DELETE FROM category WHERE cID = ?");
		if (!$stmt) return false;

		$stmt->bind_param("i", $cID);
		$result = $stmt->execute();
		$stmt->close();

		return $result; // true if deleted, false if failed
	}

	public function updateCategory($cID, $category) {
		global $conn;

		$stmt = $conn->prepare("UPDATE category SET category = ? WHERE cID = ?");
		if (!$stmt) return false;

		$stmt->bind_param("si", $category, $cID);
		$result = $stmt->execute();
		$stmt->close();

		return $result; // true if updated, false if failed
		
	}    
	
	
	public function searchCategories($searchBy, $searchInput) {
        global $conn;

        // Allowed columns
        $allowedColumns = [
            'cID' => 'cID',
            'category' => 'category'
        ];

        $column = $allowedColumns[$searchBy] ?? 'category'; // default to category

        // Prepare SQL for partial match
        $sql = "SELECT * FROM category WHERE $column LIKE ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) return [];

        $like = "%" . $searchInput . "%";
        $stmt->bind_param("s", $like);
        $stmt->execute();

        $result = $stmt->get_result();
        $categories = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        return $categories;
    }
	
    /* ============================================================
       DAILY REPORT
       Returns all requests made TODAY, grouped by category
    ============================================================ */
    public function platformManagerGetDailyReport() {
        global $conn;

        $categories = $this->getCategories();
        $today = date("Y-m-d");

        $report = [];

        foreach ($categories as $cat) {
            $cID = $cat['cID'];

            $stmt = $conn->prepare("
                SELECT description, date, priority
                FROM request
                WHERE category = ?
                  AND DATE(date) = ?
            ");
            $stmt->bind_param("is", $cID, $today);
            $stmt->execute();
            $result = $stmt->get_result();

            $requests = $result->fetch_all(MYSQLI_ASSOC);

            // Skip if no requests today under this category
            if (empty($requests)) {
                continue;
            }

            $report[$cID] = [
                'cID' => $cID,
                'category' => $cat['category'],
                'requests' => $requests
            ];
        }

        return $report;
    }




    /* ============================================================
       WEEKLY REPORT
       Returns all requests made THIS WEEK (Sunday → Saturday)
    ============================================================ */
    public function platformManagerGetWeeklyReport() {
        global $conn;

        $categories = $this->getCategories();

		$today = new DateTime();

		// Get day of the week (0 = Sunday, 6 = Saturday)
		$dayOfWeek = (int)$today->format('w');  

		// Start of week (Sunday)
		$weekStart = clone $today;
		$weekStart->modify('-' . $dayOfWeek . ' days');

		// End of week (Saturday)
		$weekEnd = clone $weekStart;
		$weekEnd->modify('+6 days');

		// Format for display
		$start = $weekStart->format('Y-m-d');
		$end   = $weekEnd->format('Y-m-d');


        $report = [];

        foreach ($categories as $cat) {
            $cID = $cat['cID'];

            $stmt = $conn->prepare("
                SELECT description, date, priority
                FROM request
                WHERE category = ?
                  AND DATE(date) BETWEEN ? AND ?
            ");

            $stmt->bind_param("iss", $cID, $start, $end);
            $stmt->execute();
            $result = $stmt->get_result();

            $requests = $result->fetch_all(MYSQLI_ASSOC);

            if (empty($requests)) {
                continue;
            }

            $report[$cID] = [
                'cID' => $cID,
                'category' => $cat['category'],
                'requests' => $requests
            ];
        }

        return $report;
    }




    /* ============================================================
       MONTHLY REPORT
       Returns all requests made THIS MONTH
    ============================================================ */
    public function platformManagerGetMonthlyReport() {
        global $conn;

        $categories = $this->getCategories();

        // First day and last day of this month
        $start = date("Y-m-01");
        $end   = date("Y-m-t"); // t = last day of month

        $report = [];

        foreach ($categories as $cat) {
            $cID = $cat['cID'];

            $stmt = $conn->prepare("
                SELECT description, date, priority
                FROM request
                WHERE category = ?
                  AND DATE(date) BETWEEN ? AND ?
            ");

            $stmt->bind_param("iss", $cID, $start, $end);
            $stmt->execute();
            $result = $stmt->get_result();

            $requests = $result->fetch_all(MYSQLI_ASSOC);

            if (empty($requests)) {
                continue;
            }

            $report[$cID] = [
                'cID' => $cID,
                'category' => $cat['category'],
                'requests' => $requests
            ];
        }

        return $report;
    }
	
	

}
?>