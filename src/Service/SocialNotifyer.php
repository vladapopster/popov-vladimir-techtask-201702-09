<?php

namespace Lunch\Service;

use Abraham\TwitterOAuth\TwitterOAuth;

class SocialNotifyer
{
    const TWITTER_ACCESS_TOKEN = 'access_token';
    const TWITTER_ACCESS_TOKEN_SECRET = 'access_token_secret';
    const TWITTER_CONSUMER_KEY = 'consumer_key';
    const TWITTER_CONSUMER_SECRET = 'consumer_secret';
    const TWITTER_STATUS = 'Today recipe has been posted!';

    private $isEnabled = false;

    public function notify()
    {
        if ($this->isEnabled) {
            $this->tweet();
        }
    }

    private function tweet()
    {
        $connection = new TwitterOAuth(
            self::TWITTER_CONSUMER_KEY,
            self::TWITTER_CONSUMER_SECRET,
            self::TWITTER_ACCESS_TOKEN,
            self::TWITTER_ACCESS_TOKEN_SECRET
        );

        $connection->post("statuses/update", ["status" => self::TWITTER_STATUS]);
    }
}
