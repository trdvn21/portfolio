#!/usr/bin/perl
use warnings;
use Text::CSV;
use DBI;

# connect to mySQL
$db ="bklib";
$user = "bklib";
$pass = "***";
$host="localhost";
$dbh = DBI->connect("DBI:mysql:$db:$host", $user, $pass);


# parse CSV file and insert into mySQL
$file = 'bklibrary.csv';
$csv = Text::CSV->new();
open (CSV, "<", $file) or die $!;

$curCatalogId = 1;
$curAuthorId = 1;

while (<CSV>) {
	next if ($. == 1);
	if ($csv->parse($_)) {
		@columns = $csv->fields();
      $title = $columns[0];
		$authors = $columns[1];
      $callnumber = $columns[2];
      $pubyear = $columns[3];
      $edition = $columns[4];
		$category = $columns[5];
		$location = $columns[6];
		$dewnumber = $columns[7];	

		# insert into location table
		$query = "insert into location value(\"$location\", \"direction...\")";
		$sqlQuery  = $dbh->prepare($query) or print "Can't prepare $query: $dbh->errstr\n";
		$sqlQuery->execute;
		$sqlQuery->finish;

		# insert into category table
      $query = "insert into category value(\"$category\", \"description...\")";
      $sqlQuery  = $dbh->prepare($query) or print "Can't prepare $query: $dbh->errstr\n";
      $sqlQuery->execute;
      $sqlQuery->finish;

		# insert into catalog table
      $query = "insert into catalog (id, title, callnumber, dewnumber, pubyear, edition, category) value(\"$curCatalogId\", \"$title\", \"$callnumber\", \"$dewnumber\", \"$pubyear\", \"$edition\", \"$category\")";
      $sqlQuery  = $dbh->prepare($query) or print "Can't prepare $query: $dbh->errstr\n";
      $catalogInserted = $sqlQuery->execute;
      $sqlQuery->finish;

		# insert into catalogcopy table (assume one copy)
		if ($catalogInserted) {
			$query = "insert into catalogcopy value(\"$curCatalogId\", \"$location\")";
      	$sqlQuery  = $dbh->prepare($query) or print "Can't prepare $query: $dbh->errstr\n";
      	$sqlQuery->execute;
      	$sqlQuery->finish;
		}

		# insert into author and author_catalog tables
		@arrAuthors = split(/&|and/, $authors); # assume consistent data
		foreach $author (@arrAuthors) {
			@names = split(',', $author); # assume consistent data
			$lastname = $names[0];
			$firstname = $names[1];
			$query = "insert into author (id, firstname, lastname) value(\"$curAuthorId\", \"$firstname\", \"$lastname\")";
      	$sqlQuery  = $dbh->prepare($query) or print "Can't prepare $query: $dbh->errstr\n";
      	$authorInserted = $sqlQuery->execute;
      	$sqlQuery->finish;

			if ($authorInserted && $catalogInserted) {
				$query = "insert into author_catalog value(\"$curAuthorId\", \"$curCatalogId\")";
      		$sqlQuery  = $dbh->prepare($query) or print "Can't prepare $query: $dbh->errstr\n";
      		$sqlQuery->execute;
      		$sqlQuery->finish;
			}

			if ($authorInserted) { $curAuthorId++; }
		}
		
		if ($catalogInserted) { $curCatalogId++; }

	} else {
		$err = $csv->error_input;
		print "Failed to parse line: $err";
	}
}

close CSV;
$dbh->disconnect;
