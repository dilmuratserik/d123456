<?php
namespace vBulletin\Search;

class Search{
    private $db;
    private $render;

    public function __construct(\PDO $db, $render)
    {
        $this->db = $db;
        $this->render = $render;
    }

    public function doSearch($request)
    {
        if (isset($request['searchid'])) {
            $this->showResults($request['searchid']);
        } elseif (!empty($request['q'])) {
            $this->processSearch($request['q']);
        } else {
            $this->showSearchForm();
        }
    }

    private function processSearch($query)
    {
        $sth = $this->db->prepare('SELECT * FROM vb_post WHERE text LIKE ?');
        $sth->execute(['%' . $query . '%']);
        $result = $sth->fetchAll();
        $this->logQuery($query);
        $this->renderSearchResults($result);
    }

    private function showResults($searchId)
    {
        $sth = $this->db->prepare('SELECT * FROM vb_searchresult WHERE searchid = ?');
        $sth->execute([$searchId]);
        $result = $sth->fetchAll();
        $this->renderSearchResults($result);
    }

    private function showSearchForm()
    {
        echo "<h2>Search in forum</h2><form><input name='q'></form>";
    }

    private function logQuery($query)
    {
        file_put_contents('logs/search_log.txt', $query . "\n", FILE_APPEND);

    }

    private function renderSearchResults($results)
    {
        foreach ($results as $row) {
            if ($row['forumid'] != 5) {
                $this->render->render_search_result($row);
            }
        }
    }
}