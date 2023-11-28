<?php
    require('C:\xampp\htdocs\forumV1\config.php');
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
            try{
                $query = 'SELECT * FROM comment WHERE id_user = :id';
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
        }
        
}


?>