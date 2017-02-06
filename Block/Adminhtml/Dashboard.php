<?php
/**
 * Copyright (c) 2017 Magenerds
 * All rights reserved
 *
 * This product includes proprietary software developed at Magenerds, Germany
 * For more information see http://www.magenerds.com/
 *
 * To obtain a valid license for using this software please contact us at
 * info@magenerds.com
 */

namespace Magenerds\Dashboard\Block\Adminhtml;

use Magento\Backend\Block\Template;

/**
 * @copyright  Copyright (c) 2017 Magenerds (http://www.magenerds.com)
 * @link       http://www.magenerds.com/
 * @author     Florian Sydekum <info@magenerds.com>
 */
class Dashboard extends Template
{
    /**
     * Holds the blog feed url
     */
    const BLOG_FEED_URL = 'http://www.magenerds.com/category/magento-2/feed/';

    /**
     * Holds the news feed url
     */
    const NEWS_FEED_URL = 'http://www.magenerds.com/category/dashboardnews/feed/';

    /**
     * Holds the number of blog feeds
     */
    const NUMBER_BLOG_FEEDS = 5;

    /**
     * Holds the number of news feeds
     */
    const NUMBER_NEWS_FEEDS = 5;

    /**
     * Returns the blog feeds
     *
     * @return []
     */
    public function getBlogFeeds()
    {
        $feeds = [];
        $reader = new \Zend_Feed_Reader();

        $ctr = 1;
        foreach ($reader->import(self::BLOG_FEED_URL) as $feed) {
            $feeds[] = [
                'link' => $feed->getLink(),
                'title' => $feed->getTitle(),
                'date' => substr($feed->getDateCreated(), 0, 10),
                'description' => $feed->getDescription()
            ];
            if ($ctr == self::NUMBER_BLOG_FEEDS) break;
            $ctr++;
        }

        return $feeds;
    }

    /**
     * Returns the news feeds
     *
     * @return []
     */
    public function getNewsFeeds()
    {
        $feeds = [];
        $reader = new \Zend_Feed_Reader();

        $ctr = 1;
        foreach ($reader->import(self::NEWS_FEED_URL) as $feed) {
            $feeds[] = [
                'link' => $feed->getLink(),
                'title' => $feed->getTitle(),
                'date' => substr($feed->getDateCreated(), 0, 10),
                'content' => $feed->getContent()
            ];
            if ($ctr == self::NUMBER_NEWS_FEEDS) break;
            $ctr++;
        }

        return $feeds;
    }
}