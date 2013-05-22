<?php
class Friend_Share extends Plugin {

	// Demonstrates how to create a dummy special feed and chain
	// headline generation to queryFeedHeadlines();

	// Not implemented yet: stuff for 3 panel mode

	private $host;
	private $dummy_id;

	function about() {
		return array(1.0,
			"MicroCommunity Plugin ",
			"fox",
			false);
	}

	function init($host) {
		$this->host = $host;

		$this->dummy_id = $host->add_feed(-1, 'Comments', 'images/pub_set.svg', $this);
	}

	function get_unread($feed_id) {
        $result = db_query("SELECT COUNT(*) AS thecount FROM ttrss_mc_WHERE uid='".$_SESSION['uid']."' AND is_read IS FALSE");
        $unread = db_fetch_results($result, 0, 'thecount');
		return $unread;
	}

	function get_headlines($feed_id, $options) {
		$qfh_ret = queryFeedHeadlines(-4,
			$options['limit'],
			$options['view_mode'], $options['cat_view'],
			$options['search'],
			$options['search_mode'],
			$options['override_order'],
			$options['offset'],
			$options['owner_uid'],
			$options['filter'],
			$options['since_id'],
			$options['include_children']);

		$qfh_ret[1] = 'Dummy feed';

		return $qfh_ret;
	}

	function api_version() {
		return 2;
	}

}
?>
