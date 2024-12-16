<?php
require_once("server/db.php");

class NewsModel {

    // Fetch the latest news for the diaporama
    public function getNews() {
        $db = new Database();
        $conn = $db->connectDb();

        $query = "SELECT n.id, n.title, n.description, n.image_path
                  FROM news n
                  ORDER BY n.created_at DESC
                  ";

      $news = $db->executeQuery($conn, $query);
      $db->disconnectDb($conn);

       return $news;
    }
}
?>
