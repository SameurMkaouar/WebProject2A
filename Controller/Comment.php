<?php
    require('C:\xampp\htdocs\forumV1\config.php');
    class Comment{
        function createComment($comment){
            $db = config::getConnexion();
            try{
                $sql = 'INSERT INTO comment (id_post, comment_content) VALUES (:id_post, :content)';
                $query = $db->prepare($sql);
                $query->bindParam(':id_post', $comment['id_post']);
                $query->bindParam(':content', $comment['comment_content']);
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
}


?>