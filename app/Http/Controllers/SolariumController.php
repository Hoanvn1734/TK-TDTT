<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SolariumController extends Controller
{
	protected $client;

    public function __construct() {
    	$config = array(
    		'endpoint' => array(
    			'localhost' => array(
    				'host' => '127.0.0.1',
    				'port' => 8983,
    				'path' => '/solr/giaoduc'
    			)
    		)
    	);

    	$this->client = new \Solarium\Client($config);
    }

    public function ping() {
    	$ping = $this->client->createPing();

    	try {
    		$this->client->ping($ping);
    		return response()->json('OK');
    	} catch(\Solarium\Exception $e) {
    		return response()->json('ERROR', 500);
    	}
    }

	public function getSearch() {
		return view('search');
	}

	public function result(Request $req) {
		// $query = $this->client->createQuery($this->client::QUERY_SELECT);
  //   	$resultset = $this->client->execute($query);

		$query = $this->client->createSelect();

		$query->createFilterQuery('Title')->setQuery('Title:"' . $req->search . '" OR Content:"' . $req->search . '"');

		// this executes the query and returns the result
		$resultset = $this->client->select($query);

		$found = $resultset->getNumFound();

		return view('result', compact('resultset', 'found'));
	}
}
