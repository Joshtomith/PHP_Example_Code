<?php
//Author: Joshua Smith
//Purpose: Display city_stats data and informoation in a clean and multipaged format
//Date: 10/13/2019

$page_title = 'Climate Data For All Cities';
include ('includes/header.html');

// Page header:
echo '<h1>Climate Data For All Cities</h1>';

require ('mysqli_connect.php'); // Connect to the db.

// Number of records to show per page:
$display = 15;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p']))
{ // Already been determined.
	$pages = $_GET['p'];
}
else
{ // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(city) FROM city_stats";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display)
	{ // More than 1 page.
		$pages = ceil ($records/$display);
	}
	else
	{
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s']))
{
	$start = $_GET['s'];
}
else
{
	$start = 0;
}

// Determine the sort...
// Default is by city.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'cy';

// Determine the sorting order:
switch ($sort)
{
	case 'se':
		$order_by = 'state ASC';
		break;
	case 'rh':
		$order_by = 'record_high ASC';
		break;
	case 'rl':
		$order_by = 'record_low ASC';
		break;
	case 'dc':
		$order_by = 'days_clear ASC';
		break;
	case 'dcl':
		$order_by = 'days_cloudy ASC';
		break;
	case 'dp':
		$order_by = 'days_with_precip ASC';
		break;
	case 'ds':
		$order_by = 'days_with_snow ASC';
		break;
	case 'cy':
		$order_by = 'city ASC';
		break;
	default:
		$order_by = 'city ASC';
		$sort = 'cy';
		break;
}
// Define the query:
$q = "SELECT * FROM city_stats ORDER BY $order_by LIMIT $start, $display";
$r = @mysqli_query ($dbc, $q); // Run the query.

// Table header:
echo '<table align="center" cellspacing="5" cellpadding="5" width="90%">
<tr>
	<td align="left"><b><a href="data.php?sort=cy">City</a></b></td>
	<td align="left"><b><a href="data.php?sort=se">State</a></b></td>
	<td align="right"><b><a href="data.php?sort=rh">High</a></b></td>
	<td align="right"><b><a href="data.php?sort=rl">Low</a></b></td>
	<td align="right"><b><a href="data.php?sort=dc">Days Clear</a></b></td>
	<td align="right"><b><a href="data.php?sort=dcl">Days Cloudy</a></b></td>
	<td align="right"><b><a href="data.php?sort=dp">Days With Precip</a></b></td>
	<td align="right"><b><a href="data.php?sort=ds">Days With Snow</a></b></td>
</tr>';

// Fetch and print all the records:
$bg = '#eeeeee';
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
	{
		$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
			<td align="left">' . $row['city'] . '</td><td align="left">' . $row['state'] .
			'</td><td align="right">' . $row['record_high'] . '</td><td align="right">' . $row['record_low'] .
			'</td><td align="right">' . $row['days_clear'] . '</td><td align="right">' . $row['days_cloudy'] .
			'</td><td align="right">' . $row['days_with_precip'] . '</td><td align="right">' . $row['days_with_snow'] .
			'</td></tr>';
	}

//table tag and closes database for resources
echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1)
{
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;

	// If it's not the first page, make a Previous button:
	if ($current_page != 1)
	{
		echo '<a href="data.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}

	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++)
	{
		if ($i != $current_page)
		{
			echo '<a href="data.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		}
		else
		{
			echo $i . ' ';
		}
	} // End of FOR loop.

	// If it's not the last page, make a Next button:
	if ($current_page != $pages)
	{
		echo '<a href="data.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}

	echo '</p>'; // Close the paragraph.

} // End of links section.

include ('includes/footer.html');
?>
