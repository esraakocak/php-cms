<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <?php include "includes/admin_sidebar.php"; ?>


    <div id="content-wrapper">
        <div class="container-fluid">
            <h1>Welcome to Admin Page</h1>
            <hr>

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Author</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Response</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                   
                <?php
                    
                    $sql_query = "SELECT * FROM comments ORDER BY comment_id DESC";
                    $select_all_comments = mysqli_query($conn, $sql_query);
                       $k = 1;
                        while ($row = mysqli_fetch_assoc($select_all_comments)) {
                                    $comment_id = $row["comment_id"];
                                    $comment_post_id = $row["comment_post_id"];
                                    $comment_author = $row["comment_author"];
                                    $comment_date = $row["comment_date"];
                                    $comment_email = $row["comment_email"];
                                    $comment_status = $row["comment_status"];
                                    $comment_text= substr($row["comment_text"], 0, 100);
                                   

                            echo "
                            <tr>
                                <td>{$comment_id}</td>
                                <td>{$comment_author}</td>
                                <td>{$comment_email}</td>
                                <td>{$comment_text}</td>
                                <td>{$comment_date}</td>
                                <td>{$comment_status}</td>";

                                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                $select_post_id_query = mysqli_query($conn , $query);
                                 while($row = mysqli_fetch_assoc($select_post_id_query)) {
                                      $post_id = $row["post_id"];
                                      $post_title = $row["post_title"];


                                 }
                                 echo "<td>{$post_title}</td>";


                               
                                  echo " <td>
                                    <div class='dropdown'>
                                        <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            Actions
                                        </button>
                                        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                            <a class='dropdown-item' data-toggle='modal' data-target='#view_modal$k' href='#'>View</a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='comments.php?delete={$comment_id}'>Delete</a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='comments.php?approved={$comment_id}'>Approve</a>
                                            <div class='dropdown-divider'></div>
                                            <a class='dropdown-item' href='comments.php?unapproved={$comment_id}'>Unapprove</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>" ;
                            ?>       



                    <div id="view_modal<?php echo $k; ?>" class="modal fade">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Vie Comment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="comment_author">Comment Author</label>
                                            <input type="text" readonly class="form-control" name="comment_author" value="<?php echo $comment_author; ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="comment_email">Comment Email</label>
                                            <input type="text" readonly class="form-control" name="comment_email" value="<?php echo $comment_email; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="comment_text">Comment Text</label>
                                            <textarea class="form-control" readonly name="comment_text" id="" cols="20" rows="5"><?php echo $comment_text; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment_status">Comment Status</label>
                                            <input type="text" class="form-control" name="comment_status" value="<?php echo $comment_status; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="commented_post">Commented Post</label>
                                            <input type="text" readonly class="form-control" name="commented_post" value="<?php echo $post_title; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="comment_id" value="">
                                            <input type="submit" class="btn btn-primary" name="view_post" value="View Post">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $k++; } ?>
                </tbody>
            </table>


            <?php
        if(isset($_GET["approved"])){
            
             $the_comment_id = $_GET["approved"];
            
            $sql_query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$the_comment_id}";
            
            $approve_comment_query = mysqli_query($conn, $sql_query);
            header("Location: comments.php");
        }
    
        ?>

            <?php
        if(isset($_GET["unapproved"])){
            
             $the_comment_id = $_GET["unapproved"];
            
            $sql_query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$the_comment_id}";
            
            $unapprove_comment_query = mysqli_query($conn, $sql_query);
            header("Location: comments.php");
        }
    
        ?> 





            <?php
        if(isset($_GET["delete"])){
            
             $del_comment_id = $_GET["delete"];
            
            $sql_query = "DELETE FROM comments WHERE comment_id ={$del_comment_id} ";
            
            $delete_comment_query = mysqli_query($conn, $sql_query);
            header("Location: comments.php");
        }
    
        ?>

            <?php include "includes/admin_footer.php"; ?>