<?php class rmz_fixer extends Plugin {
        private $host;
        function about() {
                return array(1.0,
                        "moves list of hosts to end of line to make sorting work",
                        "swack");
        }
        function init($host) {
                $this->host = $host;
                $host->add_hook($host::HOOK_ARTICLE_FILTER, $this);
        }
        function hook_article_filter($article) {
                //moves list of sites to end of name
                if(strpos($article["link"], "rmz.cr") !== FALSE)
                {
                        $subject = $article["title"];
                        $pattern = '~^(\[.*\])(?: )(.*)~';
                        $replace = '\2 \1';
                        $article["title"] = preg_replace($pattern,$replace,$subject);
                }
                return $article;
        }
        function api_version() {
                return 2;
        }
}

