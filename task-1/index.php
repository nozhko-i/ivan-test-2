<?php


$arr = array(3,7,23,1,7,9,7,8,5,6,32,45,12,18,0,0,12,15,17,9,6,3,5,2,8,5,3,5,1,8,5,3,2,4,5,1,2);
$n = 3;

$result = partials( $arr, $n );

if ( is_string( $result ) ) {

	echo $result;

} else {

	foreach ( $result as $item ) {
		echo array_sum( $item ) . ': [' . implode( ' ', $item ) . "]<br />";
	}
}





function partials( $source, $partitions ) {

	if ( $partitions == 0 ) {
		return 'Error. Partition cannot be 0';
	}

	sort( $source );

	$total = array_sum( $source );

	$sum_parts = $total / $partitions;

	if ( max( $source ) > $sum_parts ) {
		return 'Cannot to do parts properly';
	}

	if ( $partitions > count( $source ) ) {
		return 'Partitions cannot be greater then array count';
	}

	$total = 0;

	$k = 0;

	$result = array();

	for( $i = 0; $i < count( $source ); $i++ ) {

		if ( pow( ( $sum_parts - ( $total + $source[$i] ) ), 2 )  >  pow( ( $sum_parts - $total ), 2 ) ) {
			$total = 0;
			$k++;
		}

		$result[$k][] = $source[$i];

		$total = $total + $source[$i];

	}

	return $result;
}
