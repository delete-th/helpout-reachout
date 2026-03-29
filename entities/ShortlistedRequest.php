<?php
// entities/ShortlistedRequest.php
require_once __DIR__ . '/../config/DBConnection.php';

class ShortlistedRequest {

    /**
     * Add a request to the CSR's shortlist
     */
    public function addShortlistedRequest($rID, $csrID) {
        global $conn;

        $stmt = $conn->prepare("
            INSERT INTO shortlistedrequest (rID, csrID)
            VALUES (?, ?)
        ");

        if (!$stmt) return false;

        $stmt->bind_param("ii", $rID, $csrID);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    /**
     * Remove a request from the CSR's shortlist
     */
    public function removeShortlistedRequest($rID, $csrID) {
        global $conn;

        $stmt = $conn->prepare("
            DELETE FROM shortlistedrequest 
            WHERE rID = ? AND csrID = ?
        ");

        if (!$stmt) return false;

        $stmt->bind_param("ii", $rID, $csrID);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    /**
     *  fetch all shortlisted requests for a CSR
     */
	public function getShortlistedRequestsByCSR($csrID) {
		global $conn;

		$sql = "
			SELECT 
				r.rID,
				r.pinID,
				ua.name AS pinName,
				r.description,
				r.category,
				c.category AS category,
				r.date,
				r.location,
				r.priority,
				r.status,
				r.viewCount,
				r.savedCount
			FROM shortlistedrequest sr
			JOIN request r ON sr.rID = r.rID
			JOIN useraccount ua ON r.pinID = ua.aID
			JOIN category c ON r.category = c.cID
			WHERE sr.csrID = ?
			AND r.status NOT IN ('Completed', 'Incomplete');

		";

		$stmt = $conn->prepare($sql);
		if (!$stmt) return [];

		$stmt->bind_param("i", $csrID);
		$stmt->execute();
		$result = $stmt->get_result();

		$rows = [];
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}

		$stmt->close();
		return $rows;
	}


	/**
	 * Get a single shortlisted request by request ID
	 * Returns full request details including PIN name and category
	 */
	public function getShortlistedRequestByRID($rID) {
		global $conn;

		$sql = "
			SELECT 
				r.rID,
				r.pinID,
				ua.name AS pinName,
				r.description,
				r.category,
				c.category AS category,
				r.date,
				r.location,
				r.priority,
				r.status,
				sr.csrID
			FROM shortlistedrequest sr
			JOIN request r ON sr.rID = r.rID
			JOIN useraccount ua ON r.pinID = ua.aID
			JOIN category c ON r.category = c.cID
			WHERE r.rID = ?
			LIMIT 1
		";

		$stmt = $conn->prepare($sql);
		if (!$stmt) return null;

		$stmt->bind_param("i", $rID);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

		$stmt->close();
		return $row ?: null;
	}


	public function searchShortlistedRequests($csrID, $searchBy, $searchInput) {
		global $conn;

		// Allowed columns to prevent SQL injection
		$allowedColumns = [
			'rID'         => 'r.rID',
			'pinID'       => 'r.pinID',
			'pinName'     => 'ua.name',
			'description' => 'r.description',
			'category'    => 'c.category',
			'date'        => 'r.date',
			'location'    => 'r.location'
		];

		// Default to description if invalid
		$column = $allowedColumns[$searchBy] ?? 'r.description';

		// If the column is numeric (IDs), don't use LIKE, use exact match
		$isNumericColumn = in_array($searchBy, ['rID', 'pinID']);
		if ($isNumericColumn) {
			$sql = "
				SELECT 
					r.*, 
					ua.name AS pinName, 
					c.category AS category
				FROM shortlistedrequest sr
				JOIN request r ON sr.rID = r.rID
				JOIN useraccount ua ON r.pinID = ua.aID
				JOIN category c ON r.category = c.cID
				WHERE sr.csrID = ? AND $column = ?
			";
			$stmt = $conn->prepare($sql);
			if (!$stmt) return [];

			$stmt->bind_param("ii", $csrID, $searchInput);
		} else {
			$sql = "
				SELECT 
					r.*, 
					ua.name AS pinName, 
					c.category AS category
				FROM shortlistedrequest sr
				JOIN request r ON sr.rID = r.rID
				JOIN useraccount ua ON r.pinID = ua.aID
				JOIN category c ON r.category = c.cID
				WHERE sr.csrID = ? AND $column LIKE ?
			";
			$stmt = $conn->prepare($sql);
			if (!$stmt) return [];

			$like = "%" . $searchInput . "%";
			$stmt->bind_param("is", $csrID, $like);
		}

		$stmt->execute();
		$result = $stmt->get_result();

		$shortlisted = [];
		while ($row = $result->fetch_assoc()) {
			$shortlisted[] = $row;
		}

		$stmt->close();
		return $shortlisted;
	}


}
