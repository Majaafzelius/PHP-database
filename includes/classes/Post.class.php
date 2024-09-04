<?php
class Post { // Klass
    private $id;
    public $title;
    public $content;
    public $timestamp;

    public function __construct() {
        // konstruktor för att koppla till databasen
        $this->conn = new mysqli('studentmysql.miun.se', 'maaf2200', 'm3WM!VLkq7', 'maaf2200');;
    }

    public function save_data($title, $content, $timestamp) {
        // Funktion för att spara data i databasen
        $stmt = $this->conn->prepare("INSERT INTO Posts (title, content, time_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $content, $timestamp);
        $stmt->execute();
        $stmt->close();
    }

    public function delete() {
        // Funktion för att ta bort enstaka inlägg från webbsidan och databasen
        $post_id = $_POST['post_id'];
        $stmt = $this->conn->prepare("DELETE FROM Posts WHERE Id = ?");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        if ($stmt->error) {
            echo "Error: " . $stmt->error;
        } 
        $stmt->close();
    }

    public function get_data_admin() {
        // Funktion för att skriva ut inlägg på admin.php
        if (isset($_POST['submit'])) {
            // triggar funktionen delete vid tryck av knapp i inlägg
            $this->delete();
        }

        $sql = 'SELECT * FROM Posts ORDER BY time_date DESC';
        $result = $this->conn->query($sql);
        $posts = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $posts[] = array(
                    'id' => $row['Id'],
                    'title' => $row['title'],
                    'content' => (strlen($row['content'])> 500) ? substr($row['content'],0, 500) . '...' : $row['content'],
                    'date' => $row['time_date']
                );
            }
        }
        return $posts;
    }
    public function get_data_all() {
        // funktion för att skriva ut alla inlägg på news.php
        $output = $this->conn->query('SELECT * from Posts ORDER by time_date DESC');
        $posts = array();
        while ($row = $output->fetch_assoc()) {
            $posts[] = array(
                'id' => $row['Id'],
                'title' => $row['title'],
                'content' => (strlen($row['content'])> 500) ? substr($row['content'],0, 500) . '...' : $row['content'],
                'date' => $row['time_date']
            );
        }
        return $posts;
    }

    public function get_data_index() {
        // funktion för attt skriva ut inlägg på index.php
        $output = $this->conn->query('SELECT * from Posts ORDER by time_date DESC');
        $posts = array();
        if ($output->num_rows > 1) {
            // kollar om det finns fler än 2 inlägg att visa
            for ($i=0; $i<2; $i++) {
                $row = $output->fetch_assoc();
                $posts[] = array(
                    'id' => $row['Id'],
                    'title' => $row['title'],
                    'content' => (strlen($row['content'])> 500) ? substr($row['content'],0, 500) . '...' : $row['content'],
                    'date' => $row['time_date']
                );
            }
        }
        else {
            // visar inlägg om det enbart finns ett
            $row = $output->fetch_assoc();
            $posts[] = array(
                'id' => $row['Id'],
                'title' => $row['title'],
                'content' => (strlen($row['content'])> 500) ? substr($row['content'],0, 500) . '...' : $row['content'],
                'date' => $row['time_date']
            );
        }
        return $posts;
        
    }
    public function fulltext($i) {
        // funktion för att visa hela inlägg
        $sql = "SELECT * FROM Posts WHERE Id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $i);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                echo '<h2>'.$row['title'].'</h2>';
                echo '<i>' . $row['time_date'] . '</i>';
                echo '<p>' . $row['content'].'</p>';
        } 
        else {
            echo "Ingen text hittades.";
        }
    }
   
}