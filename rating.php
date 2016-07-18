<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" type="text/css" href="style.css">
	
	<link rel="stylesheet" type="text/css" href="rating.css">
	
	<link rel="icon" href="http://icons.iconarchive.com/icons/double-j-design/diagram-free/128/bar-chart-icon.png">
	<meta charset="UTF-8">
    <title>Rating</title>
	
	
</head>


	


<body>

    <div id="menu">
	    <img id="logo" alt="atom" src="http://animations.fg-a.com/atom_004rd.gif"> 
	    <a class="menu-item" style="background-color: #6C2DC7;"><img width="32px" src="http://icons.iconarchive.com/icons/double-j-design/diagram-free/128/bar-chart-icon.png">&nbspRating</a>
		<a class="menu-item" href="default.php"><img width="25px" src="http://binjiesun.com/images/voteIcon.png">&nbspVote</a>
		<a class="menu-item" href="about.php"><img width="25px" src="http://findicons.com/files/icons/1676/primo/128/info_black.png">&nbspAbout</a>
		<a class="menu-item" href="feedback.php"><img width="25px" src="http://myexpressions.in/images/contact-icon.png">&nbspFeedback</a>
	</div>
	
<?php
	require 'parts/DB_connect.php';  
	
	$golden_index = $silver_index = $bronze_index = -1;
	$fuzzy_set = array();
	$n_of_votes = 0;
	
	function find_best_altern($type)
	{
		$domin = array(array());
	    $table_name = "vote_cnt";
		global $fuzzy_set;
		global $n_of_votes;
		global $golden_index;
		global $silver_index;
		global $bronze_index;
		global $arrSources;
		global $conn;
		
		$n = count($arrSources);
	
		switch ($type)
		{
			case 1:
			{
				$table_name = $table_name . "_comp";
				break;
			}
			case 2:
			{
				$table_name = $table_name . "_char";
				break;
			}
			case 3:
			{
				$table_name = $table_name . "_mann";
				break;
			}
			default;
			{
				echo "Strange type!";
				break;
			}
		}
	
		for ($i = 0; $i < $n; $i++)
		{
			for ($j = 0; $j < $n; $j++)
			{
				$magic = 1;
				$domin[$i][$j] = $magic;
				$sql = "SELECT count FROM $table_name WHERE first = $i AND second = $j;";
				$result = $conn->query($sql);
				if ($result->num_rows == 1) 
				{
					$row = $result->fetch_assoc();
					$count = $row['count'];
					$domin[$i][$j] = $domin[$i][$j] + $count;
				}
			}
		}
		
		$n_of_votes = 0;
		for ($i = 0; $i < $n; $i++)
			for ($j = 0; $j < $n; $j++)
				$n_of_votes = $n_of_votes + $domin[$i][$j];
			
        $n_of_votes = $n_of_votes  - $n * $n;
		
		/*   Old metrics begins
		
		$probs = array();
		for ($i = 0; $i < $n; $i++)
			for ($j = 0; $j < $n; $j++)
			{
				$denom = $domin[$i][$j] + $domin[$j][$i];
				if ($denom == 0)
				{
					$probs[$i][$j] = $probs[$j][$i] = 0.5;	
				}
				else
					$probs[$i][$j] = $domin[$i][$j] / ($denom);
			}
		// Reflexive
		for ($i = 0; $i < $n; $i++)
			$probs[$i][$i] = 1;
		
		$probs_s = array();
		// Strict from non-strict
		for ($i = 0; $i < $n; $i++)
			for ($j = 0; $j < $n; $j++)
			{
				$probs_s[$i][$j] = $probs[$i][$j] - $probs[$j][$i];
				if ($probs_s[$i][$j] < 0)
					$probs_s[$i][$j] = 0;
			}
		Old metrics ends   */ 
		// output_matr
		/*
		for ($i = 0; $i < $n; $i++)
		{
			//printf("%5s&nbsp", $arrSources[$i]);
			for ($j = 0; $j < $n; $j++)
				printf("%5.2f&nbsp", $domin[$i][$j]);
			echo "<br/>";
		}
		*/	
		
		$fuzzy_set = array();
		
		for ($i = 0; $i < $n; $i++)
		{
			$in_favor = 0;
			for ($j = 0; $j < $n; $j++)
			    $in_favor = $in_favor + $domin[$i][$j];
			
			$against = 0;
			for ($j = 0; $j < $n; $j++)
			    $against = $against + $domin[$j][$i];
			
			$fuzzy_set[$i] = $in_favor / ($in_favor + $against);
		}	
		
		/*
		for ($j = 0; $j < $n; $j++)
		{
			$max = 0;
			for ($i = 0; $i < $n; $i++)
				if ($probs_s[$i][$j] > $max)
					$max = $probs_s[$i][$j];
			$fuzzy_set[$j] = 1 - $max;
		} */
		
		
		
	     
		
		// output fuzzy_set
		/*
		echo "<br/>";
		for ($j = 0; $j < $n; $j++)
			printf("%5.2f&nbsp",$fuzzy_set[$j]); 
		*/
		
		arsort($fuzzy_set);
		$keys_ordered = array_keys($fuzzy_set);
		
		$golden_index = $keys_ordered[0];
		$silver_index = $keys_ordered[1];
		$bronze_index = $keys_ordered[2];
	}
	
	
//--   Number of unique IP adresses
	$sql = "SELECT COUNT(DISTINCT REMOTE_ADDR) AS cnt FROM vote_queue;";
	$result = $conn->query($sql);
	
	$n_of_unique = 0;
	if ($result->num_rows == 1) 
    {
	    $row = $result->fetch_assoc();
		$n_of_unique = $row['cnt'];
	}
//--
?>
  	<p id="n_of_unique">
	    Unique users: 
	    <?php echo 10+$n_of_unique ?>
		<br/>
	</p>
	
	<!-- Competence block -->
	<div class="category-block">
	    <?php find_best_altern(1); ?>
	    <hr/>
		<p id="votes_number">
			Total number of votes: 
			<?php echo $n_of_votes ?>
			<br/>
	    </p>
	    <div class="category-caption">
		    <strong style="text-align: center; color: blue;">Интеллект</strong>
	    </div>
	
	    <div class="cup-person-pair">
	        <img class="cup-image" id="golden_cup" alt="First Prize"*/ src="http://i.imgur.com/F9KwjtV.png">
	        <img class="person-image" id="person1" src='<?php echo $arrSources[$golden_index] ?>'>
			<img class="leaf-image" id="leaf1" src="http://www.clker.com/cliparts/q/M/C/d/X/e/ely-hi.png">
			<br/>
			<div class="prob_caption">
			    Probability: <?php echo number_format(100*$fuzzy_set[$golden_index], 1) ?>%
			</div>
	    </div>
		
		
	    <div class="cup-person-pair">
	        <img class="cup-image" id="silver_cup" alt="Second Prize" src="http://i.imgur.com/uxSjHxP.png">
	        <img class="person-image" id="person2" src='<?php echo $arrSources[$silver_index] ?>'>
			<img class="leaf-image" id="leaf2" src="http://www.clker.com/cliparts/q/M/C/d/X/e/ely-hi.png">
			<br/>
			<div class="prob_caption">
			    Probability: <?php echo number_format(100*$fuzzy_set[$silver_index], 1) ?>%
			</div>
	    </div>
	
	    <div class="cup-person-pair">
	        <img class="cup-image" id="bronze_cup" alt="Third Prize" src="http://i.imgur.com/LY8OgXt.png">
	        <img class="person-image" id="person3" src='<?php echo $arrSources[$bronze_index] ?>'>
			<img class="leaf-image" id="leaf3" src="http://www.clker.com/cliparts/q/M/C/d/X/e/ely-hi.png">
			<br/>
			<div class="prob_caption">
			    Probability: <?php echo number_format(100*$fuzzy_set[$bronze_index], 1) ?>%
			</div>
	    </div>
		<hr/>
	</div>
	
	<!-- Charisma -->
	<div class="category-block">
	    <?php find_best_altern(2); ?>
	    <hr/>
		<p id="votes_number">
			Total number of votes: 
			<?php echo $n_of_votes ?>
			<br/>
	    </p>
	    <div class="category-caption">
		    <strong style="text-align: center; color: red;">Сексуальность</strong>
	    </div>
	
	    <div class="cup-person-pair">
	        <img class="cup-image" id="golden_cup" alt="First Prize"*/ src="http://i.imgur.com/F9KwjtV.png">
	        <img class="person-image" id="person1" src='<?php echo $arrSources[$golden_index] ?>'">
			<img class="leaf-image" id="leaf1" src="http://www.clker.com/cliparts/q/M/C/d/X/e/ely-hi.png">
			<br/>
			<div class="prob_caption">
			    Probability: <?php echo number_format(100*$fuzzy_set[$golden_index], 1) ?>%
			</div>
	    </div>
	
	    <div class="cup-person-pair">
	        <img class="cup-image" id="silver_cup" alt="Second Prize" src="http://i.imgur.com/uxSjHxP.png">
	        <img class="person-image" id="person2" src='<?php echo $arrSources[$silver_index] ?>'">
			<img class="leaf-image" id="leaf1" src="http://www.clker.com/cliparts/q/M/C/d/X/e/ely-hi.png">
			<br/>
			<div class="prob_caption">
			    Probability: <?php echo number_format(100*$fuzzy_set[$silver_index], 1) ?>%
			</div>
	    </div>
	
	    <div class="cup-person-pair">
	        <img class="cup-image" id="bronze_cup" alt="Third Prize" src="http://i.imgur.com/LY8OgXt.png">
	        <img class="person-image" id="person3" src='<?php echo $arrSources[$bronze_index] ?>'>
			<img class="leaf-image" id="leaf1" src="http://www.clker.com/cliparts/q/M/C/d/X/e/ely-hi.png">
			<br/>
			<div class="prob_caption">
			    Probability: <?php echo number_format(100*$fuzzy_set[$bronze_index], 1) ?>%
			</div>
	    </div>
		<hr/> 
	</div>
	
	<!-- Manners -->
	<div class="category-block">
	    <?php find_best_altern(3); ?>
	    <hr/>
		<p id="votes_number">
			Total number of votes: 
			<?php echo $n_of_votes ?>
			<br/>
	    </p>
	    <div class="category-caption">
		    <strong style="text-align: center; color: green;">Вероятность прихода к успеху</strong>
	    </div>
	
	    <div class="cup-person-pair">
	        <img class="cup-image" id="golden_cup" alt="First Prize"*/ src="http://i.imgur.com/F9KwjtV.png">
	        <img class="person-image" id="person1" src='<?php echo $arrSources[$golden_index] ?>'>
			<img class="leaf-image" id="leaf1" src="http://www.clker.com/cliparts/q/M/C/d/X/e/ely-hi.png">
			<br/>
			<div class="prob_caption">
			    Probability: <?php echo number_format(100*$fuzzy_set[$golden_index], 2) ?>%
			</div>
	    </div>
	
	    <div class="cup-person-pair">
	        <img class="cup-image" id="silver_cup" alt="Second Prize" src="http://i.imgur.com/uxSjHxP.png">
	        <img class="person-image" id="person2" src='<?php echo $arrSources[$silver_index] ?>'>
			<img class="leaf-image" id="leaf1" src="http://www.clker.com/cliparts/q/M/C/d/X/e/ely-hi.png">
			<br/>
			<div class="prob_caption">
			    Probability: <?php echo number_format(100*$fuzzy_set[$silver_index], 2) ?>%
			</div>
	    </div>
	
	    <div class="cup-person-pair">
	        <img class="cup-image" id="bronze_cup" alt="Third Prize" src="http://i.imgur.com/LY8OgXt.png">
	        <img class="person-image" id="person3" src='<?php echo $arrSources[$bronze_index] ?>'>
			<img class="leaf-image" id="leaf1" src="http://www.clker.com/cliparts/q/M/C/d/X/e/ely-hi.png">
			<br/>
			<div class="prob_caption">
			    Probability: <?php echo number_format(100*$fuzzy_set[$bronze_index], 2) ?>%
			</div>
	    </div>
		<hr/> 
	</div>
	
	<?php
	    require 'parts/lower_bar.php';
	?>

</body>	

<?php $conn->close(); ?>



</html>


<script>
    load_back();
</script>