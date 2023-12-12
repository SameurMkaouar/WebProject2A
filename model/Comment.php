<?php
      require_once __DIR__ . '/../config.php';
    class Comment{
        function createComment($comment){
            $db = config::getConnexion();
            try{
                $sql = 'INSERT INTO comment (id_post, comment_content, id_user) VALUES (:id_post, :content, :id_user)';
                $query = $db->prepare($sql);
                $query->bindParam(':id_post', $comment['id_post']);
                $query->bindParam(':content', $comment['comment_content']);
                $query->bindParam(':id_user', $comment['id_user']);
                $query->execute();

                $sql = 'UPDATE post SET post_comments = post_comments + 1 WHERE (id_post = :id_post)';
                $query = $db->prepare($sql);
                $query->bindParam(':id_post', $comment['id_post']);
                $query->execute();
            }
            catch(PDOException $e){
                $e->getMessage();
            }    
         }
        public function getPostComments($id_post){
            $db = config::getConnexion();
            try{
                $query = 'SELECT * FROM comment WHERE id_post = :id_post';
                $statement = $db->prepare($query);
                $statement->bindParam(':id_post', $id_post, PDO::PARAM_INT);
                $statement->execute();
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
                $e->getMessage();
            }
        }
        public function getUserPostComments($id_user){
            $db = config::getConnexion();
            try {
                $query = 'SELECT c.*, p.post_title 
                          FROM comment c 
                          JOIN post p ON c.id_post = p.id_post 
                          WHERE c.id_user = :id
                          ORDER BY c.comment_time DESC;';
                $statement = $db->prepare($query);
                $statement->bindParam(':id', $id_user, PDO::PARAM_INT);
                $statement->execute();
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
                $e->getMessage();
            }
        }
        public function deleteComment($id){
            $db = config::getConnexion();
            try{
                $query = 'DELETE FROM comment WHERE id_comment = :id';
                $statement = $db->prepare($query);
                $statement->bindParam(':id', $id, PDO::PARAM_INT);
                $statement->execute();
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                
                return $data;
            }
            catch(PDOException $e){
                $e->getMessage();
            }
        }public function getUserCommentCount($id_user){
            $db = config::getConnexion();
            try {
                $query = 'SELECT COUNT(*) AS comment_count FROM comment WHERE id_user = :id';
                $statement = $db->prepare($query);
                $statement->bindParam(':id', $id_user, PDO::PARAM_INT);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                
                if ($result && isset($result['comment_count'])) {
                    return $result['comment_count'];
                } else {
                    return 0; 
                }
            } catch(PDOException $e) {
                echo $e->getMessage(); 
                return 0; 
            }
        }
        
}


?>