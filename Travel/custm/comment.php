<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comment Feature</title>
    <script src="cjs.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #commentForm {
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #commentForm label {
            display: block;
            margin-top: 10px;
        }

        #commentForm input[type="text"],
        #commentForm textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            resize: vertical;
        }

        #commentForm button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #commentForm button:hover {
            background-color: #003d82;
        }

        #responseContainer {
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            padding: 10px;
            background-color: #e2e2e2;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #commentsSection {
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 4px;
        }

        #commentsSection > div {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }
    </style>
    
</head>

<body>
<table>
    
    <tr>
        <td>
            <?php require 'headline.php'; ?>
        </td>
    </tr>
    <tr>
        <td>
    <form id="commentForm" onsubmit="return false;">
        <label for="username">Name:</label>
        <input type="text" id="username" name="username" placeholder="Your Name">

        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" placeholder="Write a comment..."></textarea>

        <button type="submit" onclick="submitComment()">Post Comment</button>
    </form>

    <div id="responseContainer"></div> <!-- Response container -->

    <div id="commentsSection">
      
    </div>

    <script>
        // Call function to load existing comments
        window.onload = loadComments;
    </script>
        </td>
    </tr>

    <tr>
        <td>
            <?php include "footer.php"; ?>
        </td>
    </tr>
    
</table>
</body>
</html>
