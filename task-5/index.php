<?php

// Array of data
$data = array(
	array('First Name', 'Last Name', 'Position',  'Age'),
	array('John', 'Smith', 'Manager',  '25'),
	array('Steven', 'Adams', 'Driver',   '35'),
	array('Mickey', 'McCormik', 'Director', '45'),
	array('Tom', 'Rowlands', 'Art Director', '-'),
	array('Ed', 'Simons', 'Art Director', '50'),
);

// Create DOM Document
$doc = new DOMDocument('1.0');

$root = $doc->createElement("html");
$doc->appendChild($root);

$head = $doc->createElement("head");
$root->appendChild($head);

$title = $doc->createElement("title");
$head->appendChild($title);

$text = $doc->createTextNode("Worker list | Ivan Nozhka");
$title->appendChild($text);

$body = $doc->createElement("body");
$root->appendChild($body);

$table = $doc->createElement("table");
$body->appendChild($table);

$table->setAttribute("cellpadding", 10);
$table->setAttribute("cellspacing", 0);
$table->setAttribute("width", 700);
$table->setAttribute("style", "border: 1px solid #ddd;");

$thead = $doc->createElement("thead");
$table->appendChild($thead);

$tr = $doc->createElement("tr");
$thead->appendChild($tr);
$thead->setAttribute("style", "background: #f1f1f1;");

$cols = 0;

foreach( $data[0] as $item ) {

	$th = $doc->createElement("th");
	$tr->appendChild($th);
	$th->setAttribute('style', 'text-align: left;');

	$value = $doc->createTextNode($item);
	$th->appendChild($value);

	$cols++;
}

$count = 0;

for( $i = 1; $i < count( $data ); $i++ ) {

	$tr = $doc->createElement("tr");
	$table->appendChild($tr);

	if ( $i % 2 == 0 ) {
		$tr->setAttribute("style", "background-color: #ddd;");
	}

	for ( $j = 0; $j < count( $data[$i] ); $j++ ) {

		$td = $doc->createElement("td");
		$tr->appendChild($td);
		$td->setAttribute("class", "cell");

		$value = $doc->createTextNode($data[$i][$j]);
		$td->appendChild($value);

		if (is_numeric( $data[$i][$j] )) {
			$count += $data[$i][$j];
		}
	}
}

$tfoot = $doc->createElement("tfoot");
$table->appendChild($tfoot);
$tfoot->setAttribute("style", "background: #f1f1f1;");

$tr = $doc->createElement("tr");
$tfoot->appendChild($tr);

$td = $doc->createElement("td");
$tr->appendChild($td);
$td->setAttribute("colspan", $cols);
$td->setAttribute("style", "font-weight: bold");

$value = $doc->createTextNode( 'Sum of numeric: ' . $count);
$td->appendChild($value);

echo $doc->saveHTML();