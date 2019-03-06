<?php
class cache_news
{
    const CACHE_TIME = 3 * 60; //3 minutes
    public $NewsID = 0;
    public $FeedXML = "";
    public $TimeCreated = 0;
    public $Expire = 0;
        
	/**
	 * Constructor for Answer class.
	 *
	 * @param integer $NewsID = ID number of news feed
	 * @param integer $TimeCreated +The current time of answer
	 * @param string $Description = description info
	 * @return void
	 * @todo none
	 */
    function __construct($NewsId,$FeedXml)
	{#constructor sets stage by adding data to an instance of the object
		$this->NewsID = (int)$NewsId;
		$this->FeedXML = $FeedXml;
		$this->TimeCreated = time();
        $this->Expire = time() + CACHE_TIME ;
	}#end cache_news() constructor
}#end cache_news class
