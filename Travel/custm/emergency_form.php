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
    <title>Comment System</title>
</head>
<body>

<h2>Comments</h2>

<div id="comments">
   
</div>

<hr>

<h3>Add a Comment</h3>
<form id="commentForm">
    <label for="username">Username:</label>
    <input type="text" id="username" required>
    <br>
    <label for="commentText">Comment:</label>
    <textarea id="commentText" required></textarea>
    <br>
    <button type="button" onclick="submitComment()">Submit Comment</button>
</form>

<script>
    function loadComments() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_comments.php', true); 

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('comments').innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    }

    function submitComment() {
        var username = document.getElementById('username').value;
        var comment = document.getElementById('commentText').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'submit_comment.php', true); 
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                loadComments();
            }
        };

        var data = 'username=' + encodeURIComponent(username) + '&comment=' + encodeURIComponent(comment);
        xhr.send(data);
    }

   
    document.addEventListener('DOMContentLoaded', function() {
        loadComments();
    });
</script>

</body>
</html>
