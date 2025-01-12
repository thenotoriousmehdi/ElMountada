<?php

class _404
{
	use Controller;
    public function showPageNotFound()
    {
		$this->startSession();
		$this->View('404');
		$view = new _404View();
		$sessionData = $this->getSessionData();
		$view ->Head();
		$view ->displaySessionMessage();
		$view->loadHeader($sessionData);
        $view -> pageNotFound();
		$view ->footer();
		$view ->foot();
    }
}
