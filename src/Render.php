<?php
namespace vBulletin\Search;

class Render {
    public function render_search_result($row) {
        echo "<div>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p>" . htmlspecialchars($row['text']) . "</p>";
        echo "</div>";
    }
    public function processSearch($query)
    {
        try {
            $sth = $this->db->prepare('SELECT * FROM vb_post WHERE text LIKE ?');
            $sth->execute(['%' . $query . '%']);
            $result = $sth->fetchAll();
            $this->logQuery($query);
            $this->renderSearchResults($result);
        } catch (\PDOException $e) {
            echo "Ошибка поиска: " . $e->getMessage();
        }
    }
    public function doSearch($request)
    {
        if (isset($request['searchid'])) {
            if (is_numeric($request['searchid'])) {
                $this->showResults($request['searchid']);
            } else {
                echo "Неверный идентификатор поиска.";
            }
        } elseif (!empty($request['q'])) {
            $this->processSearch($request['q']);
        } else {
            $this->showSearchForm();
        }
    }


}