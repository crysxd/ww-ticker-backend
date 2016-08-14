<?php
class Team {
	
	public $players = array();

	private $baseUrl = "http://www.wildwings.de/web/";

	function fetch() {
		// Fetch team page
		$dom = new DOMDocument();
		@$dom->loadHTMLFile($this->baseUrl."saison/team/");
		$finder = new DomXPath($dom);

		// Get all links to players
		$nodes = $finder->query('//div[contains(@class,"playerPreview")]/a');
		$node = $nodes->item(0);

		// Fetch all players
		foreach($nodes as $node) {
			$url = $this->baseUrl.$node->getAttribute("href");
			$this->players[] = $this->fetchPlayer($url);

		}
	}

	private function fetchPlayer($url) {
		// Fetch player page
		$dom = new DOMDocument();
		@$dom->loadHTMLFile($url);
		$finder = new DomXPath($dom);

		// Get the URL to the player's image
		$imgUrl = $this->baseUrl.$finder->query('//a[contains(@rel,"lightbox")]')->item(0)->getAttribute("href");

		// Get the name and number in one string
		$nameAndNumber = $finder->query('//h1[contains(@class,"playerHeader")]')->item(0)->textContent;

		// Remove the leading # and seperate number (all until first space) and name (rest of the string)
		$nameAndNumber = str_replace("#", "", $nameAndNumber);
		$number = explode(" ", $nameAndNumber)[0];
		$name = str_replace($number." ", "", $nameAndNumber);

		// Create array and return
		return array("number" => $number, "name" => $name, "imgUrl" => $imgUrl);

	}
}
