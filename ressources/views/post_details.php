<?php
require './session_config.php';
require_once($_SERVER['DOCUMENT_ROOT'] . '/ressources/Controller/ForumController.php');
$forumController = new ForumController();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $postId = $_GET['id'];

    $post = $forumController->getPostById($postId);

    if ($post) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $post->getTitle(); ?></title>
            <script>
                function redirectToPost(url) {
                    window.location.href = url;
                }
            </script>
            <style>

                #body-postdetails{
                    background-color: #ecf0f1;
                    margin: 0;
                    padding: 15px 250px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    height: fit-content;
                    min-height: 100%;
                }

                .post-forum {
                    border: 1px solid #ccc;
                    margin: 10px auto; /* Centrage horizontal */
                    padding: 10px;
                }


                .title-post {
                    font-size: 20px;
                    font-weight: bold;
                }

                .title-comment {
                    font-size: 18px;
                    font-weight: bold;
                    margin-top: 15px;
                }

                .author-post,
                .author-comment,
                .created-date {
                    font-style: italic;
                    color: #555;
                }

                .content-post,
                .content-comment {
                    margin-top: 10px;
                }


                .comment-section {
                    margin-top: 20px;
                }

                .comment-form {
                    margin-top: 20px;
                }

                .comment-list,
                .comment-forum {
                    border: 1px solid #eee;
                    margin: 10px auto; /* Centrage horizontal */
                    padding: 10px;
                }

                .flex {
                    display: flex;
                    justify-content: center;
                }

                .column {
                    flex-direction: column;
                }

                .row {
                    flex-direction: row;
                }

            </style>
        </head>
        <body>
        <?php include 'sidebar.php'; ?>
        <div id="body-postdetails">
        <?php
        $forumController->showPostDetails($post);
        ?>
        </div>
        </body>
        </html>
        <?php
    } else {
        echo "Post non trouvé.";
    }
} else {
    echo "ID du post non spécifié ou invalide.";
}
?>
