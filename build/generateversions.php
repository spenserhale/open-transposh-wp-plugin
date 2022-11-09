<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$file    = $argv[1];
$version = strtolower( $argv[2] );
//var_dump($argv);
$excludesection = false;

$handle = fopen( $file, "r" );
if ( $handle ) {
	while ( ( $line = fgets( $handle ) ) !== false ) {
		$ignorenext = false;
		// those lines will never be included
		if ( str_contains( $line, 'FULL VERSION' ) ||
		     str_contains( $line, 'FULLSTOP' ) ||
		     str_contains( $line, 'WPORG VERSION' ) ||
		     str_contains( $line, 'WPORGSTOP' ) ) {
			$ignorenext = true;
		}
		if ( $version == "full" ) {
			if ( str_contains( $line, 'WPORG VERSION' ) ) {
				$excludesection = true;
			}
			if ( str_contains( $line, 'WPORGSTOP' ) ) {
				$excludesection = false;
			}
		}
		if ( $version == "wporg" ) {
			if ( str_contains( $line, 'FULL VERSION' ) ) {
				$excludesection = true;
			}
			if ( str_contains( $line, 'FULLSTOP' ) ) {
				$excludesection = false;
			}
		}
		if ( ! $excludesection && ! $ignorenext ) {
			echo $line;
		}
	}

	fclose( $handle );
} else {
	// error opening the file.
} 