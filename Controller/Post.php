<?php
    require('C:\xampp\htdocs\forumV1\config.php');
    class Post{
            public function getAllPost(){
                $db = config::getConnexion();
                try{
                    $query = 'SELECT * FROM post ';
                    $result = $db->query($query);
                    $data = $result->fetchAll(PDO::FETCH_ASSOC);
                    return $data;
                }
                catch(PDOException $e){
                    $e->getMessage();
                }
            }
            public function getPopularPosts(){
                $db = config::getConnexion();
                try{
                    $query = 'SELECT * FROM post ORDER BY post_likes DESC;';
                    $result = $db->query($query);
                    $data = $result->fetchAll(PDO::FETCH_ASSOC);
                    return $data;
                }
                catch(PDOException $e){
                    $e->getMessage();
                }
            }
            public function getRecentPosts(){
                $db = config::getConnexion();
                try{
                    $query = 'SELECT * FROM post ORDER BY post_time DESC';
                    $result = $db->query($query);
                    $data = $result->fetchAll(PDO::FETCH_ASSOC);
                    return $data;
                }
                catch(PDOException $e){
                    $e->getMessage();
                }
            }
            public function getPostsByComments(){
                $db = config::getConnexion();
                try{
                    $query = 'SELECT p.*, (
                        SELECT COUNT(*)
                        FROM comment c
                        WHERE c.id_post = p.id_post
                    ) AS comment_count
                    FROM post p
                    ORDER BY comment_count DESC;';
                    $result = $db->query($query);
                    $data = $result->fetchAll(PDO::FETCH_ASSOC);
                    return $data;
                }
                catch(PDOException $e){
                    $e->getMessage();
                }
            }
            function getPost($id){
                $db = config::getConnexion();
                try{
                    $query = 'SELECT * FROM post WHERE id_post = '.$id.'';
                    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
                    return $result[0];
                }
                catch(PDOException $e){
                    $e->getMessage();
                }  
            }
            function deletePost($id){
                $db = config::getConnexion();
                try{
                    $query = 'DELETE FROM post WHERE id_post = '.$id.'';
                    $db->query($query);
                }
                catch(PDOException $e){
                    $e->getMessage();
                }
            }
            function createPost($post){
                $db = config::getConnexion();
                try{
                    $sql = 'INSERT INTO post (post_title, post_content, post_categorie, post_img) VALUES (:ptitle, :pcontent, :pcat, :pimg)';
                    $query = $db->prepare($sql);
                    $query->bindParam(':ptitle', $post['post_title']);
                    $query->bindParam(':pcontent', $post['post_content']);
                    $query->bindParam(':pcat', $post['post_categorie']);
                    $query->bindParam(':pimg', $post['post_img']);
                    $query->execute();
                }
                catch(PDOException $e){
                    $e->getMessage();
                }
            }
            function updatePost($post){
                $db = config::getConnexion();
                try {
                    $sql = 'UPDATE post SET post_content = :content, post_title = :title, post_categorie = :categorie WHERE id_post = '.$post['id_post'].'';
                    $query = $db->prepare($sql);
                    $query->bindParam(':content', $post['post_content']);
                    $query->bindParam(':title', $post['post_title']);
                    $query->bindParam(':categorie', $post['post_categorie']);
                    $query->execute();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }

            function updatePostImage($image, $id){                
                $db = config::getConnexion();
                try {
                    $sql = 'UPDATE post SET post_img = :img WHERE id_post = '. $id .'';
                    $query = $db->prepare($sql);
                    $query->bindParam(':img', $image);
                    $query->execute();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
    }
?>

