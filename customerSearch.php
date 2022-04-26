<?php
$pageTitle = "Customer Search";
require_once '/home/phplibs/db.php';
$mysqli = dbConnect();  //for real_escape_string()

$DARKER_LIGHT_GRAY_RGB = "#C3C3C3"; //use this for table row background color with draft themes, distinguish from light #EAEAEA used to alternate table rows (for example when displaying 'all' records)
$src = 'custsearch'; //identify source script when calling customerView or customerEdit


if (isset($_REQUEST["sort"]))
  $sort = $_REQUEST["sort"];
else
  $sort = "CustomerId";

if (isset($_REQUEST["dir"]) and $_REQUEST["dir"] == "desc") {
  $dir = "desc";
  $link = "asc";
} else {
  $dir = "asc";
  $link = "desc";
}

$searchDisp = "";
$searchDispEnc = "";
$searchDispHTML = "";
$foundCount = 0;
$found = false;
$foundText = "";
$showRenewDiv = '';
$showExpiryDiv = '';


//if (isset($_REQUEST["searchTerm"]))
if (isset($_REQUEST["searchTerm"]) && !empty(trim($_REQUEST["searchTerm"]))) {
  $searchDisp = trim($_REQUEST["searchTerm"]);
  $searchDispEnc = urlencode($searchDisp);
  $searchDispHTML = htmlentities($searchDisp);

  $searchSQL = str_replace("*", "%", $searchDisp);
  $safe_searchSQL = $mysqli->real_escape_string($searchSQL);
  $mulWordFlag = false;
  if(strpos($safe_searchSQL, ' ') !== false) {
        $mulWordFlag = true;
        $wordArray = explode(' ', $safe_searchSQL);
        $wordCount = count($wordArray);
        $firstNameSQL = '';
        for($i = 0; $i <= $wordCount-2; $i++) {
                $firstNameSQL = $firstNameSQL . ' ' . $wordArray[$i];
        }
        $firstNameSQL = ltrim($firstNameSQL);
        $lastNameSQL = $wordArray[$wordCount-1];
	$safe_searchSQL = str_replace(' ', '%', $safe_searchSQL);
  }

$search = isset($_REQUEST["searchfilter"]) ? $_REQUEST["searchfilter"] : "";
$validSearch = array('byid','byemail', 'byIP', 'byName', 'byUUID');
$search = in_array($search, $validSearch) ? $search : "";
$searchFilter = $search;

if(!empty($searchFilter)) {
  $sql  = "select c.CustomerId, c.EMail, c.Username, c.DisplayName, c.FirstName, c.LastName, c.Username, c.SubExpires, c.AccountType, c.AccountSubtype, c.2018AccountType, c.2018AccountSubtype, c.SubscriptionPlanConditionId, c.Status, ";
  $sql .= "spc.ConditionType, sp.PlanName as 'source', sp2.PlanName as 'dest' from Customer c ";
  $sql .= "left join SubscriptionPlanConditions spc ";
  $sql .= "on c.SubscriptionPlanConditionId = spc.PlanConditionId ";
  $sql .= "left join SubscriptionPlans sp on spc.SrcPlanId = sp.PlanId ";
  $sql .= "left join SubscriptionPlans sp2 on spc.DestPlanId = sp2.PlanId ";

	if($searchFilter == 'byid') {
	  $sql .= "where c.CustomerId like '$safe_searchSQL'";
	}
	if($searchFilter == 'byemail') {
	 $sql .= "where lower(c.EMail) like lower('%$safe_searchSQL%') or lower(c.Login) like lower('%$safe_searchSQL%')";
	}
	if($searchFilter == 'byIP') {
	 $sql .= "where c.CustomerId in (select CustomerId from UserActivity where IPAddress like '%$safe_searchSQL%')";
	}
	if($searchFilter == 'byName') {
          if(!$mulWordFlag) {
                $sql .= "where lower(c.FirstName) like lower('%$safe_searchSQL%') or lower(c.LastName) like lower('%$safe_searchSQL%') or lower(c.Username) like lower('%$safe_searchSQL%') or lower(c.DisplayName) like lower('%$safe_searchSQL%') ";
          }
          else {
                $sql .= "where lower(c.FirstName) like lower('%$firstNameSQL%') and lower(c.LastName) like lower('%$lastNameSQL%') or lower(c.Username) like lower('%$safe_searchSQL%') or lower(c.DisplayName) like lower('%$safe_searchSQL%') ";
          }

	}
	if($searchFilter == 'byUUID') {
	  $sql .= "where c.CustomerUUID='$safe_searchSQL' ";
	}

  $sql .= "order by $sort $dir";
}

else {
  $sql  = "select c.CustomerId, c.EMail, c.Username, c.DisplayName, c.FirstName, c.LastName, c.Username, c.SubExpires, c.AccountType, c.AccountSubtype, c.2018AccountType, c.2018AccountSubtype, c.SubscriptionPlanConditionId, c.Status, ";
  $sql .= "spc.ConditionType, sp.PlanName as'source', sp2.PlanName as 'dest' from Customer c ";
  $sql .= "left join SubscriptionPlanConditions spc ";
  $sql .= "on c.SubscriptionPlanConditionId = spc.PlanConditionId ";
  $sql .= "left join SubscriptionPlans sp on spc.SrcPlanId = sp.PlanId ";
  $sql .= "left join SubscriptionPlans sp2 on spc.DestPlanId = sp2.PlanId ";
  $sql .= "where c.CustomerId like '$safe_searchSQL' or lower(c.EMail) like lower('%$safe_searchSQL%') or lower(c.Login) like lower('%$safe_searchSQL%') or ";
if(!$mulWordFlag) {
  $sql .= "lower(c.FirstName) like lower('%$safe_searchSQL%') or lower(c.LastName) like lower('%$safe_searchSQL%') or lower(c.Username) like lower('%$safe_searchSQL%') or lower(c.DisplayName) like lower('%$safe_searchSQL%') or  ";
}
else {
  $sql .= "lower(c.FirstName) like lower('%$firstNameSQL%') and lower(c.LastName) like lower('%$lastNameSQL%') or lower(c.Username) like lower('%$safe_searchSQL%') or lower(c.DisplayName) like lower('%$safe_searchSQL%') or  ";
}

  $sql .= "c.CustomerId in (select CustomerId from UserActivity where IPAddress like '%$safe_searchSQL%') or CustomerUUID='$safe_searchSQL' ";
  $sql .= "order by $sort $dir";
}
  $result = dbQueryArray($sql);

  $foundCount = count($result);
  if ($foundCount == 0)
    $found = false;
  else
    $found = true;

  $foundText = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='font-weight: bold;'>Found&nbsp;{$foundCount}&nbsp;results&nbsp;for&nbsp;search&nbsp;term:&nbsp;{$searchDisp}</span>";
} else {
  $searchDisp = "";
  $found = false;
  $foundText = "";
}



//  add new dropdown



// print_r($resultSelect);die;

// $searchDisp = "";
$searchDispEncs = "";
$searchDispHTMLs = "";
$foundCounts = 0;
$founds = false;
$foundTexts = "";

// $stat_days = $_POST['stat_days'];

// $stat_days = trim($_REQUEST["stat_days"]);
// $stat_days = trim($_REQUEST["customer_renewal_inquiries"]);
$club = isset($_REQUEST['customer_renewal_inquiries']) ? $_REQUEST['customer_renewal_inquiries'] : "";
$validClub = array('renew','expired', 'enableleaderboard', 'enableinapp', 'enablediscord');
$club = in_array($club, $validClub) ? $club : ""; 
$clubFilter = $club;

$stat_days = isset($_REQUEST['stat_days']) ? $_REQUEST['stat_days'] : "";
$validStatDays = array(30,60,90,120);
$stat_days = in_array($stat_days, $validStatDays) ? $stat_days : "";
$statFilter = $stat_days;

$exp_days = isset($_REQUEST['exp_days']) ? $_REQUEST['exp_days']: "";
$validExpDays = array(30,60,90,120);
$exp_days = in_array($exp_days, $validExpDays) ? $exp_days : "";
$expFilter = $exp_days;

if(!empty($clubFilter)){

    if($clubFilter == 'renew') {
	
	$showRenewDiv = "<script> showRenewDiv(); </script>";	
	if(!empty($statFilter)) {
    $sql  = "select * from Customer 
  where SubExpires between now() and date_add(now(), interval $statFilter day) and 2018AccountType='AstronomyClub' and 2018AccountSubType='ClubOwner' and Status in ('Complimentary', 'Active')";
  
    $resultSelect = dbQueryArray($sql);
    // $statFilterRenewalInquiries = $stat_days;
  
    $foundCounts = count($resultSelect);
    if ($foundCounts == 0)
      $founds = false;
    else
      $founds = true;
  
    $foundTexts = "&nbsp;<span style='font-weight: bold; color: red;'>Total&nbsp;<b>{$foundCounts}</b>&nbsp;Astronomy Clubs Coming up for Renewal&nbsp;Within&nbsp;&nbsp;<b>{$statFilter}</b>&nbsp;&nbsp;Days</span>";
	}
   } 

 
  if($clubFilter == 'expired') {
	$showExpiryDiv = "<script> showExpiryDiv(); </script>";
	if(!empty($expFilter)) {
                $expirysql = "select * from Customer where SubExpires between now() and date_sub(now(), interval $expFilter day) and 2018AccountType='AstronomyClub' and 2018AccountSubType='ClubOwner' and Status in ('Expired', 'Active')";
                $resultSelect = dbQueryArray($expirysql);
                $foundCounts = count($resultSelect);
                if($foundCounts == 0)
                  $founds = false;
                else
                  $founds = true;
                $foundTexts = "&nbsp;<span style='font-weight: bold; color: red;'>Total&nbsp;<b>{$foundCounts}</b>&nbsp;Astronomy Clubs that have expired &nbsp;Within&nbsp;&nbsp;<b>{$expFilter}</b>&nbsp;&nbsp;Days</span>";
	}
  }
 
	if($clubFilter == 'enableleaderboard') {
		$leaderboardsql = "select c.* from Customer c LEFT JOIN CustomerWorkspaceSettings cws ON cws.CustomerId = c.CustomerId where c.2018AccountType in ('AstronomyClub', 'FamilyClub') and c.2018AccountSubType in ('ClubOwner', 'FamilyOwner') and cws.StudentEnabledValue IS NOT NULL and cws.WorkspaceSettingKeyId=3";
		$resultSelect = dbQueryArray($leaderboardsql);
		$foundCounts = count($resultSelect);
                if($foundCounts == 0)
                  $founds = false;
                else
                  $founds = true;
                $foundTexts = "&nbsp;<span style='font-weight: bold; color: red;'>Total&nbsp;<b>{$foundCounts}</b>&nbsp; Customers (Owners) have enabled Leaderboard for their members &nbsp;</span>";
	}

        if($clubFilter == 'enableinapp') {
                $inappsql = "select c.* from Customer c LEFT JOIN CustomerWorkspaceSettings cws ON cws.CustomerId = c.CustomerId where c.2018AccountType in ('AstronomyClub', 'FamilyClub') and c.2018AccountSubType in ('ClubOwner', 'FamilyOwner') and cws.StudentEnabledValue = 1 and cws.WorkspaceSettingKeyId=2";
                $resultSelect = dbQueryArray($inappsql);
                $foundCounts = count($resultSelect);
                if($foundCounts == 0)
                  $founds = false;
                else
                  $founds = true;
                $foundTexts = "&nbsp;<span style='font-weight: bold; color: red;'>Total&nbsp;<b>{$foundCounts}</b>&nbsp; Customers (Owners) have enabled Slooh In-App Community for their members &nbsp;</span>";
        }

        if($clubFilter == 'enablediscord') {
                $leaderboardsql = "select c.* from Customer c LEFT JOIN CustomerWorkspaceSettings cws ON cws.CustomerId = c.CustomerId where c.2018AccountType in ('AstronomyClub', 'FamilyClub') and c.2018AccountSubType in ('ClubOwner', 'FamilyOwner') and cws.StudentEnabledValue = 1 and cws.WorkspaceSettingKeyId=1";
                $resultSelect = dbQueryArray($leaderboardsql);
                $foundCounts = count($resultSelect);
                if($foundCounts == 0)
                  $founds = false;
                else
                  $founds = true;
                $foundTexts = "&nbsp;<span style='font-weight: bold; color: red;'>Total&nbsp;<b>{$foundCounts}</b>&nbsp; Customers (Owners) have enabled Discord for their members &nbsp;</span>";
        }
else {
  
  
    //   $sql  = "select * from Customer 
    // where SubExpires between now() and date_add(now(), interval 60 day) and 2018AccountType='AstronomyClub' and 2018AccountSubType='ClubOwner' and Status in ('Complimentary', 'Active')";
    //   $resultSelect = dbQueryArray($sql);
  
    //   $foundCounts = count($resultSelect);
    //   if ($foundCounts == 0)
    //     $founds = false;
    //   else
    //   $stat_days ="60";
    //     $founds = true;
    //     $foundTexts = "&nbsp;<span style='font-weight: bold; color: red;'>Total&nbsp;<b>{$foundCounts}</b>&nbsp;Astronomy Clubs Coming up for Renewal&nbsp;Within&nbsp;&nbsp;<b>{$stat_days}</b>&nbsp;&nbsp;Days</span>";
  }
}

/*
else{
  //$stat_dayss = trim($_REQUEST["stat_days"]);
  if ($clubFilter == 'renew') {
    $sql  = "select * from Customer 
  where SubExpires between now() and date_add(now(), interval $stat_days day) and 2018AccountType='AstronomyClub' and 2018AccountSubType='ClubOwner' and Status in ('Complimentary', 'Active')";
  
    $resultSelect = dbQueryArray($sql);
    $statFilter = $stat_days;
    $statFilterRenewalInquiries = $stat_days;
  
    $foundCounts = count($resultSelect);
    if ($foundCounts == 0)
      $founds = false;
    else
      $founds = true;
  
    $foundTexts = "&nbsp;<span style='font-weight: bold; color: red;'>Total&nbsp;<b>{$foundCounts}</b>&nbsp;Astronomy Clubs Coming up for Renewal&nbsp;Within&nbsp;&nbsp;<b>{$stat_days}</b>&nbsp;&nbsp;Days</span>";
  }

  if($clubFilter == 'expired') {

  }

 else {

    //   $sql  = "select * from Customer 
    // where SubExpires between now() and date_add(now(), interval 60 day) and 2018AccountType='AstronomyClub' and 2018AccountSubType='ClubOwner' and Status in ('Complimentary', 'Active')";
    //   $resultSelect = dbQueryArray($sql);
  
    //   $foundCounts = count($resultSelect);
    //   if ($foundCounts == 0)
    //     $founds = false;
    //   else
    //   $stat_days ="60";
    //     $founds = true;
    //     $foundTexts = "&nbsp;<span style='font-weight: bold; color: red;'>Total&nbsp;<b>{$foundCounts}</b>&nbsp;Astronomy Clubs Coming up for Renewal&nbsp;Within&nbsp;&nbsp;<b>{$stat_days}</b>&nbsp;&nbsp;Days</span>";
  }
}

*/

?>

<!DOCTYPE html>
<html>

<head>
  <title>SSA - <?= $pageTitle ?></title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>

        .loader {
          display: none;
          top: 60%;
          left: 55%;
          position: fixed;
          transform: translate(-50%, -50%);
        }

        .loading {
          border: 2px solid #ccc;
          width: 60px;
          height: 60px;
          border-radius: 50%;
          border-top-color: #1ecd97;
          border-left-color: #1ecd97;
          animation: spin 1s infinite ease-in;
        }

        @keyframes spin {
          0% {
            transform: rotate(0deg);
          }

          100% {
            transform: rotate(360deg);
          }
        }
    div.top-link-padding {
      margin-top: 20px;
      margin-left: 30px;
    }

    table.padded-list-table {
      border-collapse: collapse;
      margin-top: 30px;
      margin-left: 30px;
    }

    table.padded-list-table th {
      padding: 3px;
      background-color: #a9a9a9;
      color: white;
      font-size: 18px;
      font-weight: normal;
      border-right: 2px solid #E0E0E0;
      /* width: 400px; */
    }

    table.padded-list-table td {
      padding-top: 3px;
      /* width: 400px; */

    }

    /* table .padded-list-table th.details-list{
  width: 300px!important;
} */
    table.padded-list-table tr:nth-child(even) {
      background-color: #eaeaea;
    }

    a.sort:link,
    a.sort:visited,
    a.sort:hover,
    a.sort:active {
      text-decoration: none;
      background-color: transparent;
      color: white;
    }

    .search-customer-list {
      margin-left: 491px;
      margin-top: -26px;
    }

    .filter-customer-subexpire {
      margin-left: 420px;
      margin-top: -41px;
    }

    *{margin: 0;padding: 0;}
a,
a:hover{text-decoration: none;}

/* #top-nav{
  min-height: 50px;
  margin-left: 240px;
}

#top-nav ul{
  background-color: #e0e0e0;
  list-style: none;   */
  /* width: 200px;
  color: black; */
/* }
#top-nav ul li{
  display: inline-block;
  color: black;
}

#top-nav ul li a{
  display: block;
  color: black;
  padding: 10px 20px;
}
#top-nav ul li a:hover{background-color: #666;} */

/* Dropdown */
/* li.dropdown{position: relative;}
ul.dropdown-menu{
  position: absolute;
  min-width: 120px;
}
ul.dropdown-menu li{
  display: block !important;
  white-space: nowrap;
} */

/* Sub Dropdown */
/* ul.dropdown-menu ul.dropdown-menu{
  left: 100%;
  top: 0;
  background-color: #f00 !important;
} */

/* Display none by Default */
/* ul.dropdown-menu{
  display: none;
}

.selected {
  background-color:red;
}
.dropdown, .dropup {
    position: relative;
} */
</style>
</head>

<body>

  <?php
  //require "/home/sites/altair.slooh.com/web/admin/include/header.php";
  //require "/home/sites/altair.slooh.com/web/admin/include/menu.php";


  require "include/header.php";
  require "include/menu.php";

  ?>

  <script language="JavaScript">
    $(function() {
      $('#viewtimepicker').datetimepicker({
        controlType: 'select',
        showTimepicker: false,
        alwaysSetTime: false,
        pickerTimeFormat: null,
        oneLine: true,
        currentText: "Now",
        closeText: "Done",
        timezone: 0,
        dateFormat: 'DD, M d, yy',
        timeFormat: "HH:mm 'UTC'",

        onClose: function(dateText, inst) {
          /* alert ("Done!"); */
          document.filters.submit();
        }

      });
    });
  </script>
<!--
  <script language="javascript" type="text/javascript">
    function submitTotalDays() {
      document.getElementById("total_days_view").submit();
    }
  </script>
-->
  <script language="javascript" type="text/javascript">
    function submitRenewalInquiries() {
      document.getElementById("customer_inquiries").submit();
    }
  </script>



  <div id="content">
<!-- <br><br>
<div class="top-link-padding">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<b> Customer Inquiries: </b>&nbsp;&nbsp;
<form name="filters" id="total_days_view" method="post" action="customerSearch.php" style="margin-top: -25px;">
<select class="selectpicker multiple" name="customer_renewal_inquiries" id="customer_renewal_inquiries" class="inquiries" onClick="submitTotalDays()">
<option value="">Please select an inquiry</option>

<option <?php //if ($statFilter == "30" || $statFilter == "60" || $statFilter == "90" || $statFilter == "120") echo "selected"; ?> value="60">Astronomy Clubs coming up for Renewal</option>
  </select>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </div> -->



    <div class="top-link-padding">
      <form name="filters" id="customer_inquiries" method="post" action="customerSearch.php">

        <b> Customer Inquiries: </b>&nbsp;&nbsp;
        <select name="customer_renewal_inquiries" id="customer_renewal_inquiries" class="inquiries" onchange="submitRenewalInquiries();">
        
          <option value="">Please select an inquiry</option>

	<option <?php if ($clubFilter == "renew") echo "selected"; ?> value="renew"> Astronomy Clubs coming up for Renewal </option>
	<option <?php if ($clubFilter == "expired") echo "selected"; ?> value="expired"> Astronomy Clubs that are Expired </option>
          <!-- <option value="60">Astronomy Clubs coming up for Renewal</option> -->
        <option <?php if ($clubFilter == "enableleaderboard") echo "selected"; ?> value="enableleaderboard"> Customers that have enabled leaderboards for their members </option>
        <option <?php if ($clubFilter == "enableinapp") echo "selected"; ?> value="enableinapp"> Customers that have enabled In-App Community for their members </option>
        <option <?php if ($clubFilter == "enablediscord") echo "selected"; ?> value="enablediscord"> Customers that have enabled Discord for their members </option>

        </select>

	&nbsp;&nbsp;&nbsp; 
    <div id='renewdiv' style='display:none;'>
    <br><b> Renews within the next: </b>&nbsp;&nbsp;
    <select name="stat_days" id="stat_days" class="stat_days" onchange="submitRenewalInquiries()">

      <option <?php if ($statFilter == "") echo "selected"; ?> value="">Select Days</option>
      <option <?php if ($statFilter == "30") echo "selected"; ?> value="30">30 Days</option>
      <option <?php if ($statFilter == "60") echo "selected"; ?> value="60">60 Days</option>
      <option <?php if ($statFilter == "90") echo "selected"; ?> value="90">90 Days</option>
      <option <?php if ($statFilter == "120") echo "selected"; ?> value="120">120 Days</option>

    </select>
    </div>

        &nbsp;&nbsp;&nbsp;
    <div id='expirydiv' style='display:none;'>
    <br><b> Expired within the last: </b>&nbsp;&nbsp;
    <select name="exp_days" id="exp_days" class="stat_days" onchange="submitRenewalInquiries()">

      <option <?php if ($expFilter == "") echo "selected"; ?> value="">Select Days</option>
      <option <?php if ($expFilter == "30") echo "selected"; ?> value="30">30 Days</option>
      <option <?php if ($expFilter == "60") echo "selected"; ?> value="60">60 Days</option>
      <option <?php if ($expFilter == "90") echo "selected"; ?> value="90">90 Days</option>
      <option <?php if ($expFilter == "120") echo "selected"; ?> value="120">120 Days</option>

    </select>
    </div>
    </form>
    </div>


   <br> 
    <div class="search-customer-list option" >
    </div>
     
     
    <div class="top-link-padding">

      <form action="customerSearch.php" method="post" name="custSearch">
        <b>Customer Input: </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" width="60" name="searchTerm" value="<?= $searchDispHTML ?>">&nbsp;&nbsp; 
<b> Search: </b>&nbsp;&nbsp;
<select name='searchfilter' id='searchfilter' class='searchfilter' onchange="spinner();document.custSearch.submit();">
          <option value="">Please select a filter type</option>

        <option <?php if ($searchFilter == "byid") echo "selected"; ?> value="byid"> By Customer ID </option>
        <option <?php if ($searchFilter == "byemail") echo "selected"; ?> value="byemail"> By Customer Email </option>
        <option <?php if ($searchFilter == "byName") echo "selected"; ?> value="byName"> By Customer Name </option>
        <option <?php if ($searchFilter == "byIP") echo "selected"; ?> value="byIP"> By IP Address </option>
        <option <?php if ($searchFilter == "byUUID") echo "selected"; ?> value="byUUID"> By Customer UUID </option>

        </select>

&nbsp;&nbsp;<input type="submit" value="Search" onClick='spinner();'>&nbsp;&nbsp;
<a class="none" href="#" onClick="help('search'); return false;"><img border="0" align="absmiddle" src="images/help.png"></a><?= $foundText ?>
      </form>
    </div>
    <br>
    <div class="top-link-padding">
      <?= $foundTexts ?>
    </div>

<div class="loader">
  <div class="loading">
  </div>
</div>

    <!-- <div class="col-sm-4">
        
      </div>
      <div class="col-sm-4 filter-customer-subexpire">
        
      </div>


      <div class="col-sm-4 search-customer-list">
        
      </div>
    </div> -->

    <br><br>
    <table class="padded-list-table" id="customer_list_inquiries_days">
      <tr>
        <th width="100" colspan="1">&nbsp;Op&nbsp;</th>

        <?php
        if ($sort == "CustomerId")
          echo "<th width='140'><a class='sort' href='customerSearch.php?sort=CustomerId&dir=$link&searchTerm=$searchDispEnc'>Customer Id</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='140'><a class='sort' href='customerSearch.php?sort=CustomerId&dir=$dir&searchTerm=$searchDispEnc'>Customer Id</a</th>";

        if ($sort == "LastName")
          echo "<th width='200'><a class='sort' href='customerSearch.php?sort=LastName&dir=$link&searchTerm=$searchDispEnc'>Name</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='200'><a class='sort' href='customerSearch.php?sort=LastName&dir=$dir&searchTerm=$searchDispEnc'>Name</a></th>";

        if ($sort == "EMail")
          echo "<th width='200'><a class='sort' href='customerSearch.php?sort=EMail&dir=$link&searchTerm=$searchDispEnc'>E-Mail</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='200'><a class='sort' href='customerSearch.php?sort=EMail&dir=$dir&searchTerm=$searchDispEnc'>E-Mail</a></th>";

        if ($sort == "Username")
          echo "<th width='200'><a class='sort' href='customerSearch.php?sort=Username&dir=$link&searchTerm=$searchDispEnc'>Username</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='200'><a class='sort' href='customerSearch.php?sort=Username&dir=$dir&searchTerm=$searchDispEnc'>Username</a></th>";

        if ($sort == "DisplayName")
          echo "<th width='200'><a class='sort' href='customerSearch.php?sort=DisplayName&dir=$link&searchTerm=$searchDispEnc'>Display Name</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='200'><a class='sort' href='customerSearch.php?sort=DisplayName&dir=$dir&searchTerm=$searchDispEnc'>Display Name</a></th>";


        if ($sort == "Details")
          echo "<th class='details-list'><a class='sort' href='customerSearch.php?sort=DisplayName&dir=$link&searchTerm=$searchDispEnc'>Details</a><img width='105' height='15' src='images/$dir.png'></th>";
        else
          echo "<th class='details-list'><a class='sort' href='customerSearch.php?sort=DisplayName&dir=$dir&searchTerm=$searchDispEnc'>Details</a></th>";


        if ($sort == "SubExpires")
          echo "<th width='200'><a class='sort' href='customerSearch.php?sort=SubExpires&dir=$link&searchTerm=$searchDispEnc'>Sub Expires</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='200'><a class='sort' href='customerSearch.php?sort=SubExpires&dir=$dir&searchTerm=$searchDispEnc'>Sub Expires</a></th>";

        if ($sort == "2018AccountType")
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=2018AccountType&dir=$link&searchTerm=$searchDispEnc'>Account Type</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=2018AccountType&dir=$dir&searchTerm=$searchDispEnc'>Account Type</a></th>";

        if ($sort == "2018AccountSubtype")
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=2018AccountSubtype&dir=$link&searchTerm=$searchDispEnc'>Account Subtype</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=2018AccountSubtype&dir=$dir&searchTerm=$searchDispEnc'>Account Subtype</a></th>";

        if ($sort == "AccountType")
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=AccountType&dir=$link&searchTerm=$searchDispEnc'>Legacy Account Type</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=AccountType&dir=$dir&searchTerm=$searchDispEnc'>Legacy Account Type</a></th>";


        if ($sort == "AccountSubtype")
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=AccountSubtype&dir=$link&searchTerm=$searchDispEnc'>Legacy Account Subtype</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=AccountSubtype&dir=$dir&searchTerm=$searchDispEnc'>Legacy Account Subtype</a></th>";

        if ($sort == "SubscriptionPlanConditionId")
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=SubscriptionPlanConditionId&dir=$link&searchTerm=$searchDispEnc'>SubPlan CondId</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=SubscriptionPlanConditionId&dir=$dir&searchTerm=$searchDispEnc'>SubPlan CondId</a></th>";

        if ($sort == "ConditionType")
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=ConditionType&dir=$link&searchTerm=$searchDispEnc'>Action</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=ConditionType&dir=$dir&searchTerm=$searchDispEnc'>Action</a></th>";

        if ($sort == "source")
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=source&dir=$link&searchTerm=$searchDispEnc'>SubPlan Previous</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=source&dir=$dir&searchTerm=$searchDispEnc'>SubPlan Previous</a></th>";

        if ($sort == "dest")
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=dest&dir=$link&searchTerm=$searchDispEnc'>SubPlan Current</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='150'><a class='sort' href='customerSearch.php?sort=dest&dir=$dir&searchTerm=$searchDispEnc'>SubPlan Current</a></th>";

        if ($sort == "Status")
          echo "<th width='180'><a class='sort' href='customerSearch.php?sort=Status&dir=$link&searchTerm=$searchDispEnc'>Status</a><img width='15' height='15' src='images/$dir.png'></th>";
        else
          echo "<th width='180'><a class='sort' href='customerSearch.php?sort=Status&dir=$dir&searchTerm=$searchDispEnc'>Status</a></th>";

        ?>

      </tr>


      <?php


      if ($found) {
        foreach ($result as $row) {

          $numSubAccountSeatsAvailable = 0;
          $numSubAccountSeatsUsed = 0;
          $pendingInvitationsCnt = 0;

          $seatLookupQry = "select sum(NbrOfSeats) nbrOfSeats from SubscriptionSeatPacks where SubscriptionSeatPackId in (select SubscriptionSeatPackId from CustomerSubscriptionSeatPacks where CustomerId={$row["CustomerId"]})";
          $seatLookupResult = dbQueryScalar($seatLookupQry);
          $numSubAccountSeatsAvailable = $seatLookupResult['nbrOfSeats'] ?? 0;

          $seatsInvitedLookupQry = "select count(*) cnt from CustomerLinkInvitations where ParentCustomerId={$row["CustomerId"]}";
          $seatsInvitedLookupResult = dbQueryScalar($seatsInvitedLookupQry);
          $numSubAccountSeatsUsed = $seatsInvitedLookupResult['cnt'] ?? 0;

          $activeInvitationsLookupQry = "select count(*) cnt from CustomerLinkInvitations where ParentCustomerId='{$row["CustomerId"]}' and InvitationStatus='Accepted' and Deleted=0";
          $activeInvitationsResult = dbQueryArray($activeInvitationsLookupQry);
          $activeInvitationsCnt = $activeInvitationsResult[0]['cnt'] ?? 0;

          $archivedInvitationsLookupQry = "select count(*) cnt from CustomerLinkInvitations where ParentCustomerId={$row["CustomerId"]} and Deleted=1";
          $archivedInvitationsResult = dbQueryArray($archivedInvitationsLookupQry);
          $archivedInvitationsCnt = $archivedInvitationsResult[0]['cnt'] ?? 0;

          $seatLookupQry = "select ssp.* from CustomerSubscriptionSeatPacks csp left join SubscriptionSeatPacks ssp on ssp.SubscriptionSeatPackId=csp.SubscriptionSeatPackId where csp.CustomerId={$row["CustomerId"]}";
          $seatResults = dbQueryArray($seatLookupQry);


          $pendingInvitationsLookupQry = "select count(*) cnt from CustomerLinkInvitations where ParentCustomerId ='{$row["CustomerId"]}' and Deleted='0' and (InvitationStatus='Viewed' or InvitationStatus='Sent')";
          $pendingInvitationsResult = dbQueryArray($pendingInvitationsLookupQry);
          $pendingInvitationsCnt = $pendingInvitationsResult[0]['cnt'] ?? 0;

          $seatResult = array() ?? 0;
          foreach ($seatResults as $seatResult) {
            $seatResult['NbrOfSeats'] ?? 0;
          }


          if ($row["Status"] == 'Canceled' or $row["Status"] == 'Expired' or $row["Status"] == 'TimecardExpired'  or $row["Status"] == 'Trial Canceled' or $row["Status"] == 'Pending')
            echo "<tr style='background-color: $DARKER_LIGHT_GRAY_RGB'>\n";
          else
            echo "<tr>\n";

          echo "<td>&nbsp;&nbsp;&nbsp;<a href='customerView.php?cid={$row["CustomerId"]}&sort=$sort&dir=$dir&src=$src&searchTerm=$searchDispEnc'>view</a>&nbsp;&nbsp;&nbsp;<a href='customerEdit.php?cid={$row["CustomerId"]}&sort=$sort&dir=$dir&src=$src&searchTerm=$searchDispEnc'>edit</a>&nbsp;&nbsp;&nbsp;</td>\n";

          echo "<td>{$row["CustomerId"]}</td>\n";
          echo "<td>{$row["FirstName"]} {$row["LastName"]}</td>\n";
          echo "<td><div class='row' style='width:255px;'><p style='line-break: anywhere;'>{$row["EMail"]}</p></div></td>\n";
          echo "<td>{$row["Username"]}</td>\n";
          echo "<td>{$row["DisplayName"]}</td>\n";
          echo "<td colspan='1' width='450px;'><div class='row' style='width:450px;'><div width='350px;'>Maximum # of Seats:</div><p width='100px;' style='margin-left: 386px; margin-top: -15px;'>{$numSubAccountSeatsAvailable}</p></div><div class='row' style='width:450px;'> <div width='350px;'># of Pending Invitations for Astronomy Club Members:</div><p width='100px;' style='margin-left: 386px; margin-top: -15px;'>{$pendingInvitationsCnt}</p></div> <div class='row' style='width:450px;'><div width='350px;'> # of Active Astronomy Club Members:</div><p width='100px;' style='margin-left: 386px; margin-top: -15px;'>{$activeInvitationsCnt} of {$seatResult['NbrOfSeats']}</p></div><div class='row' style='width:450px;'><div width='350px;'># of Archived Astronomy Club Members:  </div><p width='100px;' style='margin-left: 386px; margin-top: -15px;'> {$archivedInvitationsCnt}</p></div></td>\n";

          echo "<td><div style='width:90px;'>{$row["SubExpires"]}</div></td>\n";
          echo "<td>{$row["2018AccountType"]}</td>\n";
          echo "<td>{$row["2018AccountSubtype"]}</td>\n";
          echo "<td>{$row["AccountType"]}</td>\n";
          echo "<td>{$row["AccountSubtype"]}</td>\n";
          if ($row["SubscriptionPlanConditionId"] == 0) {
            echo "<td colspan='4' style='font-weight: bold;'>This account has not been migrated to v4!</td>\n";
          } else {
            echo "<td>{$row["SubscriptionPlanConditionId"]}</td>\n";
            echo "<td>{$row["ConditionType"]}</td>\n";
            if (isset($row["dest"])) {
              echo "<td>{$row["source"]}</td>\n";
              echo "<td>{$row["dest"]}</td>\n";
            } else {
              echo "<td></td>\n";
              echo "<td>{$row["source"]}</td>\n";
            }
          }
          echo "<td>{$row["Status"]}</td>\n";
          echo "</tr>\n";
        }
      }
      ?>



      <?php
      if ($founds) {
        foreach ($resultSelect as $row) {

          $numSubAccountSeatsAvailable = 0;
          $numSubAccountSeatsUsed = 0;
          $activeInvitationsCnt = 0;

          $seatLookupQry = "select sum(NbrOfSeats) nbrOfSeats from SubscriptionSeatPacks where SubscriptionSeatPackId in (select SubscriptionSeatPackId from CustomerSubscriptionSeatPacks where CustomerId={$row["CustomerId"]})";
          $seatLookupResult = dbQueryScalar($seatLookupQry);
          $numSubAccountSeatsAvailable = $seatLookupResult['nbrOfSeats'] ?? 0;

          $seatsInvitedLookupQry = "select count(*) cnt from CustomerLinkInvitations where ParentCustomerId={$row["CustomerId"]}";
          $seatsInvitedLookupResult = dbQueryScalar($seatsInvitedLookupQry);
          $numSubAccountSeatsUsed = $seatsInvitedLookupResult['cnt'];

          $activeInvitationsLookupQry = "select count(*) cnt from CustomerLinkInvitations where ParentCustomerId='{$row["CustomerId"]}' and InvitationStatus='Accepted' and Deleted=0";
          $activeInvitationsResult = dbQueryArray($activeInvitationsLookupQry);
          $activeInvitationsCnt = $activeInvitationsResult[0]['cnt'] ?? 0;

          $archivedInvitationsLookupQry = "select count(*) cnt from CustomerLinkInvitations where ParentCustomerId={$row["CustomerId"]} and Deleted=1";
          $archivedInvitationsResult = dbQueryArray($archivedInvitationsLookupQry);
          $archivedInvitationsCnt = $archivedInvitationsResult[0]['cnt'];

          $seatLookupQry = "select ssp.* from CustomerSubscriptionSeatPacks csp left join SubscriptionSeatPacks ssp on ssp.SubscriptionSeatPackId=csp.SubscriptionSeatPackId where csp.CustomerId={$row["CustomerId"]}";
          $seatResultss = dbQueryArray($seatLookupQry);
          $seatResults = $seatResultss;

          $pendingInvitationsLookupQry = "select count(*) cnt from CustomerLinkInvitations where ParentCustomerId ='{$row["CustomerId"]}' and Deleted='0' and (InvitationStatus='Viewed' or InvitationStatus='Sent')";
          $pendingInvitationsResult = dbQueryArray($pendingInvitationsLookupQry);
          $pendingInvitationsCnt = $pendingInvitationsResult[0]['cnt'] ?? 0;

          $seatResult = array() ?? 0;
          foreach ($seatResults as $seatResult) {
            $seatResult['NbrOfSeats'];
          }


          if ($row["Status"] == 'Canceled' or $row["Status"] == 'Expired' or $row["Status"] == 'TimecardExpired'  or $row["Status"] == 'Trial Canceled' or $row["Status"] == 'Pending')
            echo "<tr style='background-color: $DARKER_LIGHT_GRAY_RGB'>\n";
          else
            echo "<tr>\n";

          echo "<td>&nbsp;&nbsp;&nbsp;<a href='customerView.php?cid={$row["CustomerId"]}&sort=$sort&dir=$dir&src=$src&searchTerm=$searchDispEnc'>view</a>&nbsp;&nbsp;&nbsp;<a href='customerEdit.php?cid={$row["CustomerId"]}&sort=$sort&dir=$dir&src=$src&searchTerm=$searchDispEnc'>edit</a>&nbsp;&nbsp;&nbsp;</td>\n";

          echo "<td>{$row["CustomerId"]}</td>\n";
          echo "<td>{$row["FirstName"]} {$row["LastName"]}</td>\n";
          echo "<td><div class='row' style='width:255px;'><p style='line-break: anywhere;'>{$row["EMail"]}</p></div></td>\n";
          echo "<td>{$row["Username"]}</td>\n";
          echo "<td>{$row["DisplayName"]}</td>\n";
          echo "<td colspan='1' width='450px;'><div class='row' style='width:450px;'><div width='350px;'>Maximum # of Seats:</div><p width='100px;' style='margin-left: 386px; margin-top: -15px;'>{$numSubAccountSeatsAvailable}</p></div><div class='row' style='width:450px;'> <div width='350px;'># of Pending Invitations for Astronomy Club Members:</div><p width='100px;' style='margin-left: 386px; margin-top: -15px;'>{$pendingInvitationsCnt}</p></div> <div class='row' style='width:450px;'><div width='350px;'> # of Active Astronomy Club Members:</div><p width='100px;' style='margin-left: 386px; margin-top: -15px;'>{$activeInvitationsCnt} of {$seatResult['NbrOfSeats']}</p></div><div class='row' style='width:450px;'><div width='350px;'># of Archived Astronomy Club Members:  </div><p width='100px;' style='margin-left: 386px; margin-top: -15px;'> {$archivedInvitationsCnt}</p></div></td>\n";

          echo "<td><div style='width:90px;'>{$row["SubExpires"]}</div></td>\n";
          echo "<td>{$row["2018AccountType"]}</td>\n";
          echo "<td>{$row["2018AccountSubtype"]}</td>\n";
          echo "<td>{$row["AccountType"]}</td>\n";
          echo "<td>{$row["AccountSubtype"]}</td>\n";
          if ($row["SubscriptionPlanConditionId"] == 0) {
            echo "<td colspan='4' style='font-weight: bold;'>This account has not been migrated to v4!</td>\n";
          } else {
            echo "<td>{$row["SubscriptionPlanConditionId"]}</td>\n";
            echo "<td>{$row["ConditionType"]}</td>\n";
            if (isset($row["dest"])) {
              echo "<td>{$row["source"]}</td>\n";
              echo "<td>{$row["dest"]}</td>\n";
            } else {
              echo "<td></td>\n";
              echo "<td>{$row["source"]}</td>\n";
            }
          }
          echo "<td>{$row["Status"]}</td>\n";
          echo "</tr>\n";
        }
      }
      ?>


    </table>

  </div>
  <script src="jquery.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script type="text/javascript">
    $("#customer_renewal_inquiries").change(function() {
      if ($(this).data('options') === undefined) {
        /*Taking an array of all options-2 and kind of embedding it on the select1*/
        $(this).data('options', $('#stat_days option').clone());
      }
      var id = $(this).val();
      // alert(id);
      if (id == 60) {
        var options = $(this).data('options').filter('[value=' + id + ']');
        $('#stat_days').html(options);
      } else {
        var options = $(this).data('options').filter('[value=' + id + ']');
        $('#stat_days').html(options);
      }

    });
  </script>
  <script>
		$("#clickme_buyres").on("click", function() {
			var se = $("#navigation_for_buyres_id");
			se.show();
			se[0].size = 2;
		});
		$("#navigation_for_buyres_id").on("click", function() {
			var se = $(this);
			se.hide();
		});
	</script>
  <script>
  $(function(){
  
  $('li.dropdown > a').on('click',function(event){
    
    event.preventDefault();
    $(this).toggleClass('selected');
    $(this).parent().find('ul').first().toggle(300);
    
    $(this).parent().siblings().find('ul').hide(200);
    
    //Hide menu when clicked outside
    $(this).parent().find('ul').parent().mouseleave(function(){ 
      var thisUI = $(this);
      $('html').click(function(){
        thisUI.children(".dropdown-menu").hide();
    thisUI.children("a").removeClass('selected');
               
        $('html').unbind('click');
      });
    });
    
    
  });
});
  </script>
<script>
function showRenewDiv() {
        document.getElementById('renewdiv').style.display = 'block';
}
</script>
<?php echo $showRenewDiv; ?>

<script>
function showExpiryDiv() {
	document.getElementById('expirydiv').style.display = 'block';
}
</script>
<?php echo $showExpiryDiv; ?>
<script>
    function spinner() {
        document.getElementsByClassName("loader")[0].style.display = "block";
    }
</script>
</body>




</html>
