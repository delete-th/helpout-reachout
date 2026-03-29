<?php
// entities/Request.php
require_once __DIR__ . '/../config/DBConnection.php';

class Request {

    // create new request
	public function createRequest($pinID, $category, $description, $date, $location, $status, $priority) {
		global $conn;

		$stmt = $conn->prepare("INSERT INTO request (pinID, description, category, date, location, status, priority)
								VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("issssss", $pinID, $description, $category, $date, $location, $status, $priority);

		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}

	
	public function getAllRequests($pinID) {
		global $conn;
		$stmt = $conn->prepare("SELECT 
									r.rID,
									r.pinID,
									r.description,
									r.category,
									c.category AS category,
									r.date,
									r.location,
									r.priority,
									r.status,
									r.viewCount,
									r.savedCount
									FROM request r
									JOIN category c ON r.category = c.cID
									WHERE r.pinID = ?");
		$stmt->bind_param("i", $pinID);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->fetch_all(MYSQLI_ASSOC);  //returns array
	}
	
	public function csrRepGetAllRequests() {
		global $conn;

		$sql = "
			SELECT 
				r.rID,
				r.pinID,
				ua.name AS pinName,         -- from useraccount
				r.description,
				r.category,
				c.category AS category,  -- from category
				r.date,
				r.location,
				r.priority,
				r.status,
				r.viewCount,
				r.savedCount
			FROM request r
			JOIN useraccount ua ON r.pinID = ua.aID
			JOIN category c ON r.category = c.cID
			WHERE r.status NOT IN ('Completed', 'Incomplete');";
		

		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();

		return $result->fetch_all(MYSQLI_ASSOC);
	}
	
	
	public function getRequestByID($rID) {
		global $conn;

		$sql = "
			SELECT 
				r.rID,
				r.pinID,
				ua.name AS pinName,        -- from useraccount
				r.description,
				r.category,
				c.category AS category, -- from category
				r.date,
				r.location,
				r.priority,
				r.status,
				r.viewCount,
				r.savedCount
			FROM request r
			JOIN useraccount ua ON r.pinID = ua.aID
			JOIN category c ON r.category = c.cID
			WHERE r.rID = ?
		";

		$stmt = $conn->prepare($sql);
		if (!$stmt) return null;

		$stmt->bind_param("i", $rID);
		$stmt->execute();
		$result = $stmt->get_result();

		return $result->fetch_assoc(); // Returns a single associative array
	}
	
	public function viewAllRequests() {
		global $conn;

		$sql = "
			SELECT 
				r.rID,
				r.pinID,
				ua.name AS pinName,         -- from useraccount
				r.description,
				r.category,
				c.category AS category,  -- from category
				r.date,
				r.location,
				r.priority,
				r.status,
				r.viewCount,
				r.savedCount
			FROM request r
			JOIN useraccount ua ON r.pinID = ua.aID
			JOIN category c ON r.category = c.cID
		";

		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->get_result();

		return $result->fetch_all(MYSQLI_ASSOC);
	}
	
	public function updateRequest($rID, $pinID, $cID, $description, $formattedDate, $location, $priority, $status) {
        global $conn;

        $stmt = $conn->prepare("UPDATE request 
                                SET category = ?, description = ?, date = ?, location = ?, priority = ?, status = ?
                                WHERE rID = ? AND pinID = ?");
        if (!$stmt)
            return false;

        $stmt->bind_param("isssssii", $cID, $description, $formattedDate, $location, $priority, $status, $rID, $pinID);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
	
	public function deleteRequest($rID) {
		global $conn;
		
		$stmt = $conn->prepare("DELETE FROM request WHERE rID = ?");
		$stmt->bind_param("i", $rID);
		$result = $stmt->execute();
		$stmt->close();
		
		return $result;
	}
	
	public function updateStatus($rID, $status) {
		global $conn;
		
		$stmt = $conn->prepare("UPDATE request SET status = ? WHERE rID = ?");
		if (!$stmt)
            return false;

        $stmt->bind_param("si", $status, $rID);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
	}
	
	
	public function searchRequestsForPIN($pinID, $searchBy, $searchInput) {
		global $conn;

		// Only allow valid column names to avoid SQL injection
		$allowedColumns = [
			'rID'        => 'rID',
			'pinID'      => 'pinID',
			'description'=> 'description',
			'category'   => 'c.category',
			'date'       => 'date',
			'location'   => 'location'
		];

		// Default to 'description' if invalid column passed
		$column = $allowedColumns[$searchBy] ?? 'description';

		// Build SQL
		$sql = "
			SELECT 
				r.*, 
				c.category AS category 
			FROM request r
			JOIN category c ON r.category = c.cID
			WHERE r.pinID = $pinID
			AND (r.status = 'Pending' OR r.status = 'InProgress')
			AND $column LIKE ?
		";

		$stmt = $conn->prepare($sql);
		if (!$stmt) {
			return [];
		}
		
		$like = "%" . $searchInput . "%";
		$stmt->bind_param("s", $like);
		$stmt->execute();
		$result = $stmt->get_result();

		$requests = [];
		while ($row = $result->fetch_assoc()) {
			$requests[] = $row;
		}

		$stmt->close();
		return $requests;
	}
	
	
	public function searchRequests($searchBy, $searchInput) {
		global $conn;

		// Only allow valid column names to avoid SQL injection
		$allowedColumns = [
			'rID'        => 'rID',
			'pinID'      => 'pinID',
			'pinName'    => 'ua.name',    // include pin name if joined in view
			'description'=> 'description',
			'category'   => 'c.category',
			'date'       => 'date',
			'location'   => 'location'
		];

		// Default to 'description' if invalid column passed
		$column = $allowedColumns[$searchBy] ?? 'description';

		// Build SQL
		$sql = "
			SELECT 
				r.*, 
				ua.name AS pinName, 
				c.category AS category 
			FROM request r
			JOIN useraccount ua ON r.pinID = ua.aID
			JOIN category c ON r.category = c.cID
			WHERE (r.status = 'Pending' OR r.status = 'InProgress')
			AND $column LIKE ?
		";

		$stmt = $conn->prepare($sql);
		if (!$stmt) {
			return [];
		}
		
		$like = "%" . $searchInput . "%";
		$stmt->bind_param("s", $like);
		$stmt->execute();
		$result = $stmt->get_result();

		$requests = [];
		while ($row = $result->fetch_assoc()) {
			$requests[] = $row;
		}

		$stmt->close();
		return $requests;
	}
	
	public function incrementRequestViewCount($rID) {
		global $conn;

		$sql = "UPDATE request SET viewCount = viewCount + 1 WHERE rID = ?";
		$stmt = $conn->prepare($sql);
		if (!$stmt) return false;

		$stmt->bind_param("i", $rID);
		$result = $stmt->execute();
		$stmt->close();

		return $result;
	}
	
	public function incrementSavedCount($rID) {
		global $conn;

		$stmt = $conn->prepare("
			UPDATE request 
			SET savedCount = savedCount + 1 
			WHERE rID = ?
		");

		if (!$stmt) {
			return false;
		}

		$stmt->bind_param("i", $rID);
		$success = $stmt->execute();
		$stmt->close();

		return $success;
	}
	
	public function decrementSavedCount($rID) {
		global $conn;

		// Prevents savedCount from going below 0
		$stmt = $conn->prepare("
			UPDATE request 
			SET savedCount = GREATEST(savedCount - 1, 0)
			WHERE rID = ?
		");

		if (!$stmt) {
			return false;
		}

		$stmt->bind_param("i", $rID);
		$success = $stmt->execute();
		$stmt->close();

		return $success;
	}
	
}
