<?php
// index.php
$action = $_GET['action'] ?? 'Login';

switch ($action) {
	case 'Login': 
		require_once "boundaries/Login.php";
		break;

	case '3_UserAdmin_Menu': 
		require_once "boundaries/UserAdminMenu.php";
		require_once "boundaries/SearchUserProfiles.php";
		require_once "boundaries/UserProfileList.php";
		break;
		
	case 'UserAccountMenuPage':
		require_once "boundaries/UserAccountMenuPage.php";
		require_once "boundaries/SearchUserAccounts.php";
		require_once "boundaries/UserAccountList.php";
		break;	
		
	case '1_PIN_Menu':
		require_once "boundaries/PINMenu.php";
		require_once "boundaries/PINSearchRequests.php";
		require_once "boundaries/PINRequestList.php";
		break;
		
	case 'PIN_History':
		require_once "boundaries/PINMatchHistoryMenuPage.php";
		require_once "boundaries/PINSearchMatchHistory.php";
		require_once "boundaries/PINMatchHistoryList.php";
		break;
		
	case '2_CSRRep_Menu':
		require_once "boundaries/CSRRepMenu.php";
		require_once "boundaries/CSRRepSearchRequests.php";
		require_once "boundaries/CSRRepRequestList.php";
		break;

	case 'CSRRepShortlistedRequestsPage':
		require_once "boundaries/CSRRepShortlistedRequestsPage.php";
		require_once "boundaries/CSRRepSearchShortlistedRequests.php";
		require_once "boundaries/CSRRepShortlistedRequestList.php";
		break;
	
	case 'CSRRepCompletedMatchHistoryPage':
		require_once "boundaries/CSRRepCompletedMatchHistoryPage.php";
		require_once "boundaries/CSRRepSearchCompletedMatchesHistory.php";
		require_once "boundaries/CSRRepCompletedMatchHistoryList.php";
		break;
		
	case '4_PlatformManager_Menu':
		require_once "boundaries/PlatformManagerMenu.php";
		require_once "boundaries/PlatformManagerSearchCategories.php";
		require_once "boundaries/PlatformManagerCategoryList.php";
		break;

	case 'PlatformManagerReportPage':
		require_once "boundaries/PlatformManagerReportPage.php";
		require_once "boundaries/PlatformManagerGenerateReportButtonLayout.php";
		break;


		
	case 'Logout': 
		require_once "boundaries/Logout.php";
		break;
}

?>