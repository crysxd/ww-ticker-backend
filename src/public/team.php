<?php
class Team {
	
	public $players = array();

	function fetch() {
		$baseUrl = "http://www.wildwings.de/web/saison/team/";
		$dom = new DOMDocument();
		@$dom->loadHTMLFile($baseUrl);
		$finder = new DomXPath($dom);

		$nodes = $finder->query('//div[contains(@class,"playerPreview")]/a');
		echo $nodes->length;
		foreach($nodes as $node) {
			$url = $baseUrl."/".$node->getAttribute("href");
			$this->loadPlayer($url);

		}
	}

	private function loadPlayer($url) {
		$dom = new DOMDocument();
		@$dom->loadHTMLFile($url);
		$finder = new DomXPath($dom);

		$imgUrl = $finder->query("//a[contains(@rel,lightbox)]")->item(0)->getAttribute("href");
//		$nameAndNumber = substr($nodes->item(0)->textContent, 1);
//		$number = explode(" ", $nameAndNumber)[0];
//		$name = str_replace($number." ", "", $nameAndNumber);

		$players[] = $imgUrl;//array("number" => $number, "name" => $name, "imgUrl" => $imgUrl);

	}
}
