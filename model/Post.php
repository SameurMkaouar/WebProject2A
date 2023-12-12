<?php
  require_once __DIR__ . '/../config.php';
    class Post{
            public function getAllPost(){
                $db = config::getConnexion();
                try{
                    $query = 'SELECT * FROM post';
                    $result = $db->query($query);
                    $data = $result->fetchAll(PDO::FETCH_ASSOC);
                    return $data;
                }
                catch(PDOException $e){
                    $e->getMessage();
                }
            }
            public function getPendingPosts(){
                $db = config::getConnexion();
                try{
                    $query = 'SELECT * FROM post WHERE post_status=:stat';
                    $sql= $db->prepare($query);
                    $sql->bindValue(':stat',"Pending");
                    $sql->execute();
                    $data = $sql->fetchAll(PDO::FETCH_ASSOC);
                    return $data;
                }
                catch(PDOException $e){
                    $e->getMessage();
                }
            }
            public function getPublishedPosts(){
                $db = config::getConnexion();
                try{
                    $query = 'SELECT * FROM post WHERE post_status=:stat';
                    $sql= $db->prepare($query);
                    $sql->bindValue(':stat',"Published");
                    $sql->execute();
                    $data = $sql->fetchAll(PDO::FETCH_ASSOC);
                    return $data;
                }
                catch(PDOException $e){
                    $e->getMessage();
                }
            }
            public function getPopularPosts(){
                $db = config::getConnexion();
                try{
                    $query = 'SELECT * FROM post WHERE post_status = "Published" ORDER BY post_likes DESC';
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
                    $query = 'SELECT * FROM post WHERE post_status = "Published" ORDER BY post_time DESC';
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
                        FROM post p WHERE post_status = "Published"
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
                    $sql = 'DELETE FROM post_react WHERE id_post =:id';
                    $query = $db->prepare($sql);
                    $query->bindParam(':id', $id);
                    $query->execute();
                    $sql = 'DELETE FROM comment WHERE id_post =:id';
                    $query = $db->prepare($sql);
                    $query->bindParam(':id', $id);
                    $query->execute();
                    $sql = 'DELETE FROM post WHERE id_post =:id';
                    $query = $db->prepare($sql);
                    $query->bindParam(':id', $id);
                    $query->execute();
                    return true;
                }
                catch(PDOException $e){
                    return $e->getMessage();
                }
            }
            function createPost($post){
                
                $db = config::getConnexion();
                
                    $sql = 'INSERT INTO post (post_title, post_content, post_categorie, post_img ,id_user) VALUES (:ptitle, :pcontent, :pcat, :pimg, :userid)';
                    $query = $db->prepare($sql);
                    $query->bindParam(':ptitle', $post['post_title']);
                    $query->bindParam(':pcontent', $post['post_content']);
                    $query->bindParam(':pcat', $post['post_categorie']);
                    $query->bindParam(':pimg', $post['post_img']);
                    $query->bindParam(':userid', $post['user_id']);

                    try{
                    $query->execute();
                    return true;
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    

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
            function likePost($id, $id_user, $type){                
                $db = config::getConnexion();
                try {
                    //CREATE REACT
                    $sql = 'INSERT INTO post_react (id_post, id_user, react_type) VALUES (:id, :id_user, :typee)';
                    $query = $db->prepare($sql);
                    $query->bindParam(':id', $id);
                    $query->bindParam(':id_user', $id_user);
                    $query->bindParam(':typee', $type);
                    $query->execute();

                    $sql = 'UPDATE post SET post_likes = post_likes + 1 WHERE (id_post = :id)';
                    $query = $db->prepare($sql);
                    $query->bindParam(':id', $id);
                    $query->execute();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
            function unlikePost($id, $id_user, $type){                
                $db = config::getConnexion();
                try {
                    // Remove react from post_react table
                    $sql = 'DELETE FROM post_react WHERE (id_post = :id AND id_user = :id_user AND react_type = :typee)';
                    $query = $db->prepare($sql);
                    $query->bindParam(':id', $id);
                    $query->bindParam(':id_user', $id_user);
                    $query->bindParam(':typee', $type);
                    $query->execute();
            
                    // Decrement post_likes in the post table
                    $sql = 'UPDATE post SET post_likes = post_likes - 1 WHERE id_post = :id';
                    $query = $db->prepare($sql);
                    $query->bindParam(':id', $id);
                    $query->execute();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
            
            function checkLike($id_post, $id_user, $type){                
                $db = config::getConnexion();
                try {
                    $sql = 'SELECT COUNT(*) AS count FROM post_react WHERE id_user = :id_user AND id_post = :id_post AND react_type = :typee';
                    $query = $db->prepare($sql);
                    $query->bindParam(':id_user', $id_user);
                    $query->bindParam(':id_post', $id_post);
                    $query->bindParam(':typee', $type);
                    $query->execute();
            
                    $result = $query->fetch(PDO::FETCH_ASSOC);
            
                    return ($result['count'] > 0); //retourne True si like existe sinon retourne False
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
            function dislikePost($id, $id_user, $type){                
                $db = config::getConnexion();
                try {
                    //CREATE REACT
                    $sql = 'INSERT INTO post_react (id_post, id_user, react_type) VALUES (:id, :id_user, :typee)';
                    $query = $db->prepare($sql);
                    $query->bindParam(':id', $id);
                    $query->bindParam(':id_user', $id_user);
                    $query->bindParam(':typee', $type);
                    $query->execute();

                    $sql = 'UPDATE post SET post_dislikes = post_dislikes + 1 WHERE (id_post = :id)';
                    $query = $db->prepare($sql);
                    $query->bindParam(':id', $id);
                    $query->execute();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
            function unDislike($id, $id_user, $type){                
                $db = config::getConnexion();
                try {
                    // Remove react from post_react table
                    $sql = 'DELETE FROM post_react WHERE (id_post = :id AND id_user = :id_user AND react_type = :typee)';
                    $query = $db->prepare($sql);
                    $query->bindParam(':id', $id);
                    $query->bindParam(':id_user', $id_user);
                    $query->bindParam(':typee', $type);
                    $query->execute();
            
                    // Decrement post_dislikes in the post table
                    $sql = 'UPDATE post SET post_dislikes = post_dislikes - 1 WHERE id_post = :id';
                    $query = $db->prepare($sql);
                    $query->bindParam(':id', $id);
                    $query->execute();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }

            function getChartData(){                
                $db = config::getConnexion();
                try {
                    $query = 'SELECT DATE(post_time) AS post_date, COUNT(*) AS post_count
                    FROM post
                    GROUP BY DATE(post_time)';
                    $result = $db->query($query);
                    $data["posts"] = $result->fetchAll(PDO::FETCH_ASSOC);

                    $query = 'SELECT DATE(comment_time) AS comment_date, COUNT(*) AS comment_count
                    FROM comment
                    GROUP BY DATE(comment_time)';
                    $result = $db->query($query);
                    $data["comments"] = $result->fetchAll(PDO::FETCH_ASSOC);

                    $query = 'SELECT post_likes, post_dislikes, id_post, post_title, post_categorie FROM post';
                    $result = $db->query($query);
                    $data["reacts"] = $result->fetchAll(PDO::FETCH_ASSOC);

                    return $data;

                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
            function approvePost($id){                
                $db = config::getConnexion();
                try {
                    $sql = 'UPDATE post SET post_status = "Published" WHERE id_post = :id';
                    $query = $db->prepare($sql);
                    $query->bindParam(':id', $id);
                    $query->execute();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
            function rejectPost($id){                
                $db = config::getConnexion();
                try {
                    $sql = 'UPDATE post SET post_status = "Pending" WHERE id_post = :id';
                    $query = $db->prepare($sql);
                    $query->bindParam(':id', $id);
                    $result = $db->query($query);
                    return $result;
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }

            function getMyRecentPosts($id){
                $db = config::getConnexion();
                try{
                    $sql = "SELECT * FROM post 
                    WHERE id_user = :id
                    ORDER BY post_time DESC;";
                    $query = $db->prepare($sql);
                    $query->bindParam(':id', $id);
                    $query->execute(); 
                    $result = $query->fetchAll(PDO::FETCH_ASSOC); 
                    return $result;

                }
                catch(PDOException $e){
                    $e->getMessage();
                }
                
            }
            
    }
?>