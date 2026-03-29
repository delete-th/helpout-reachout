
<?php
	// entities/VolunteerMatch.php
	require_once __DIR__ . '/../config/DBConnection.php';

	class VolunteerMatch {
		
		public function getMatch($pinID,$rID) {
			global $conn;
			$sql = "SELECT vm.mID AS matchID,
						   vm.csrID AS csrID, 
						   vm.rID,
						   vm.dateBooked AS dateBooked,
						   ua.name AS csrName,
						   r.description,
						   r.pinID,
						   r.category, 
						   c.category AS category, 
						   r.date, 
						   r.location, 
						   r.priority,
						   r.status,
						   r.viewCount,
						   r.savedCount
					FROM volunteermatch vm 
					JOIN useraccount ua
					ON vm.csrID = ua.aID
					JOIN request r
					ON r.rID = vm.rID
					JOIN category c
					ON c.cID = r.category
					WHERE r.pinID = ? AND vm.rID = ? AND r.status = 'Completed'";
					
			$stmt = $conn->prepare($sql);
			if (!$stmt)
				return false;
		
			$stmt->bind_param("ii", $pinID, $rID);
			$stmt->execute();
			$result = $stmt->get_result();
			return $result->fetch_assoc();  //returns array
		}
		
		public function getPINMatchHistory($pinID) {
			global $conn;
			$stmt = $conn->prepare("SELECT vm.mID AS matchID,
										   vm.csrID AS csrID, 
										   vm.rID as rID,
										   vm.dateBooked AS dateBooked,
										   ua.name AS csrName,
										   r.description,
										   r.pinID,
										   r.category, 
										   c.category AS category, 
										   r.date, 
										   r.location, 
										   r.priority,
										   r.status,
										   r.viewCount,
										   r.savedCount
										FROM volunteermatch vm 
										JOIN useraccount ua
										ON vm.csrID = ua.aID
										JOIN request r
										ON r.rID = vm.rID
										JOIN category c
										ON c.cID = r.category
										WHERE r.pinID = ? 
										AND r.status = 'Completed'");
			$stmt->bind_param("i", $pinID);
			$stmt->execute();
			$result = $stmt->get_result();
			return $result->fetch_all(MYSQLI_ASSOC);  //returns array
		}
		
		public function searchMatchHistory($pinID, $searchBy, $searchInput) {
			global $conn;

			// Only allow valid column names to avoid SQL injection
			$allowedColumns = ['mID' => 'matchID',
							   'rID' => 'r.rID', 
							   'csrName' => 'ua.name',
							   'category' => 'c.category', 
							   'description' => 'r.description', 
							   'date' => 'r.date', 
							   'location' => 'r.location',
							   'dateBooked' => 'dateBooked'];
			$column = $allowedColumns[$searchBy] ?? 'category';

			$sql = "SELECT vm.mID AS matchID,
						vm.csrID AS csrID, 
						vm.rID AS rID,
						vm.dateBooked AS dateBooked,
					   ua.name AS csrName,
					   r.description,
					   r.pinID,
					   r.category, 
					   c.category AS category, 
					   r.date, 
					   r.location, 
					   r.priority,
					   r.status,
					   r.viewCount,
					   r.savedCount
					FROM volunteermatch vm 
					JOIN useraccount ua
					ON vm.csrID = ua.aID
					JOIN request r
					ON r.rID = vm.rID
					JOIN category c
					ON c.cID = r.category
					WHERE r.pinID = ?
					AND r.status = 'Completed' 
					AND $column LIKE ?";
			$stmt = $conn->prepare($sql);
			
			if (!$stmt) {
				return [];
			}
			
			$like = "%" . $searchInput . "%";
			$stmt->bind_param("is", $pinID, $like);
			
			$stmt->execute();
			$result = $stmt->get_result();

			$matches = [];
			while ($row = $result->fetch_assoc()) {
				$matches[] = $row;
			}

			$stmt->close();
			return $matches;
		}

		public function csrRepSearchHistoryMatches($csrID, $searchBy, $searchInput) {
			global $conn;

			// Prevent SQL injection
			$allowedColumns = [
				'mID' => 'vm.mID',
				'rID' => 'vm.rID',
				'pinID' => 'r.pinID',
				'pinName' => 'pinUA.name',
				'csrName' => 'ua.name',
				'category' => 'c.category',
				'description' => 'r.description',
				'date' => 'r.date',
				'location' => 'r.location',
				'dateBooked' => 'vm.dateBooked'
			];
			$column = $allowedColumns[$searchBy] ?? 'r.description';

			// Base SQL
			$sql = "SELECT 
						vm.mID as mID,
						vm.csrID AS csrID, 
						vm.rID AS rID,
						vm.dateBooked AS dateBooked,
						ua.name AS csrName,
						r.description,
						r.pinID,
						pinUA.name AS pinName,    
						r.category, 
						c.category AS category, 
						r.date, 
						r.location, 
						r.priority,
						r.status
					FROM volunteermatch vm 
					JOIN useraccount ua ON vm.csrID = ua.aID
					JOIN request r ON r.rID = vm.rID
					JOIN useraccount pinUA ON r.pinID = pinUA.aID  
					JOIN category c ON c.cID = r.category
					WHERE vm.csrID = ?
					AND r.status = 'Completed'";

			// Add search condition
				$sql .= " AND $column LIKE ?";
				$stmt = $conn->prepare($sql);
				if (!$stmt) return [];
				$like = "%" . $searchInput . "%";
				$stmt->bind_param("is", $csrID, $like);
			

			$stmt->execute();
			$result = $stmt->get_result();

			$matches = [];
			while ($row = $result->fetch_assoc()) {
				$matches[] = $row;
			}

			$stmt->close();
			return $matches;
		}

		
		public function csrRepGetCompletedMatchByMID($mID) {
			global $conn;

			$sql = "SELECT 
						vm.mID AS mID, 
						vm.csrID AS csrID, 
						vm.rID AS rID,
						vm.dateBooked AS dateBooked,
						ua.name AS csrName,
						r.description,
						r.pinID,
						pinUA.name AS pinName,    -- PIN name
						r.category, 
						c.category AS category, 
						r.date, 
						r.location, 
						r.priority,
						r.status
					FROM volunteermatch vm 
					JOIN useraccount ua ON vm.csrID = ua.aID
					JOIN request r ON r.rID = vm.rID
					JOIN useraccount pinUA ON r.pinID = pinUA.aID  -- PIN
					JOIN category c ON c.cID = r.category
					WHERE vm.mID = ?
					AND r.status = 'Completed'";

			$stmt = $conn->prepare($sql);
			if (!$stmt) {
				return false;
			}

			$stmt->bind_param("i", $mID);
			$stmt->execute();
			$result = $stmt->get_result();

			$match = $result->fetch_assoc();
			$stmt->close();

			return $match;
		}
		
		/**
		 * Get all completed matches for a specific CSR Rep.
		 */
		public function csrRepGetAllCompletedMatchesByCSRID(int $csrID) {
			global $conn;

			$sql = "SELECT 
						vm.mID AS mID, 
						vm.csrID AS csrID, 
						vm.rID AS rID,
						vm.dateBooked AS dateBooked,
						ua.name AS csrName,
						r.description,
						r.pinID,
						pinUA.name AS pinName,    -- PIN name
						r.category, 
						c.category AS category, 
						r.date, 
						r.location, 
						r.priority,
						r.status
					FROM volunteermatch vm
					JOIN useraccount ua ON vm.csrID = ua.aID
					JOIN request r ON r.rID = vm.rID
					JOIN useraccount pinUA ON r.pinID = pinUA.aID  -- PIN
					JOIN category c ON c.cID = r.category
					WHERE vm.csrID = ?
					AND r.status = 'Completed'";

			$stmt = $conn->prepare($sql);
			if (!$stmt) {
				return [];
			}

			$stmt->bind_param("i", $csrID);
			$stmt->execute();
			$result = $stmt->get_result();

			$matches = [];
			while ($row = $result->fetch_assoc()) {
				$matches[] = $row;
			}

			$stmt->close();
			return $matches;
		}

		
		
		
	}
	
?>