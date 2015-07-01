<?php
/**
 * Summary
 * Description.
 *
 * @since  0.9.0
 * @package
 * @subpackage
 * @author nguyenvanduocit
 */

namespace PhoneNumberCrawler;


use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class PhoneNumberCrawler {
	/** @var  string */
	protected $url;
	protected $httpClient;
	protected $crawler;
	protected $post;
	public function __construct( $url ) {
		$this->url = $url;
		$this->httpClient = new Client();
	}

	protected function parseContent($content) {
		return $this->crawler = new Crawler( $content );
	}
	public function processPost(){
		$this->post = $this->getPostInfo();
		return $this->post;
	}
	public function getPhoneNumber() {


		return $response->phone;
	}

	protected function getPostInfo(){
		$post = new \stdClass();
		$res           = $this->httpClient->get( $this->url );
		$body          = $res->getBody();
		$content = $body->getContents();
		$parsed_content = $this->parseContent($content);

		$reviewDom = $parsed_content->filterXPath('//*[@id="draf-review-load"]');
		$post->id = $reviewDom->attr('resid');

		$apiEndPoint = "http://www.foody.vn/Restaurant/GetPhoneByResId?resId={$this->post->id}";
		$res           = $this->httpClient->get( $apiEndPoint );
		$responseText = $res->getBody()->getContents();
		$response = json_decode($responseText);
		$post->phone = $response->phone;

		$titleDom = $parsed_content->filterXPath('//div[contains(@class, "main-info-title")]/h1');
		$post->title = $titleDom->text();

		$addressDom = $parsed_content->filterXPath('//div[contains(@class, "res-common-add")]');
		$post->address = $addressDom->text();

		$priceDom = $parsed_content->filterXPath('//span[contains(@itemprop, "priceRange")]');
		$post->priceRange = $priceDom->text();

		$openDom = $parsed_content->filterXPath('//span[contains(@itemprop, "open")]');
		$post->openTime = $openDom->text();

		$closeDom = $parsed_content->filterXPath('//span[contains(@itemprop, "close")]');
		$post->closeTime = $closeDom->text();

		$thumbnailDom = $parsed_content->filterXPath('//img[contains(@class, "pic-place")]');
		$post->thumbnailSrc = $thumbnailDom->attr('src');

		return $post;
	}
}