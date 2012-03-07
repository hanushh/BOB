<?php
function evalbarcode($bar){
$subject = $bar;
$temp = (string) $subject;

/*
$total1 =0;
$total2=0;
preg_match('/[0-9]{13}$/',
    $subject, $matches);
if($matches){
for($i = 0; $i < strlen($subject)-1; $i++){
if($i%2==0)
{
   	$total1+=$temp[$i];
	}
	else{$total2+=$temp[$i];
	}
	}
	$total1=$total1*3;
	
	$sum=$total1+$total2;

	$t=$sum%10;
	$check=10-$t;

	*/
	
//preg_match('/^1(9|1)[0-9]{10}'.$check.'$/',$subject, $matches);

preg_match('/^1(9|1)[0-9]{11}/',$subject, $matches); //comment this and uncomment other commented lines if you need check sum
if(!$matches){ return 0; }
else{ return 1; }
}
/*
}
else
{return 0;}}
*/
?>
