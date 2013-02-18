

<div id="content2">

<div class="roundedCornerContent">	

	<h1>You are a Studygig Member!</h1>
<h2>You current plan is: <?php 
	switch ($subscription->item_num ){
		case 4: 
			echo "Monthly";
			break;
		case 3: 
			echo "Quarterly (3 Months)";
			break;
		case 2: 
			echo "Term (4 Months)";
			break;
		case 1: 
			echo "Yearly";
			break;
		}
	?></h2>
<p> You subscribed on: <?php echo $subscription->date; ?></p>

</div>
	
</div>


