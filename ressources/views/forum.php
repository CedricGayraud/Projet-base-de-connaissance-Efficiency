<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/ressources/Controller/forumController.php');
$forumController = new ForumController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efficiency - Forum</title>
    <style>
        .forum-body {
            font-family: 'Arial', sans-serif;
            background-color: #ecf0f1;
            margin: 0;
            padding: 15px 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        header {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            font-size: 40px;
            width: 100%;
            font-family: "Poppins", sans-serif;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        #featured-posts {
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            max-width: 800px;
            margin-top: 20px;
        }

        .post {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            width: 800px;
            text-align: left;
        }

        .search-bar {
            margin-top: 20px;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            width: 300px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #2ecc71;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .section-title {
            font-family: "Poppins", sans-serif;
            font-size: 25px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>

<div class="forum-body">
    <header>
        <h1>Forum</h1>
    </header>

    <h1 class="section-title"> À la Une </h1>
    <div id="featured-posts-test-div">
        <?php
        $forumController->displayPosts(1);
        var_dump($forumController);
        ?>
    </div>

    <div class="search-bar">
        <form action="/rechercher" method="get">
            <label>
                <input type="text" name="q" placeholder="Rechercher...">
            </label>
            <input type="submit" value="Rechercher">
        </form>
    </div>
</div>

</body>
</html>