document.addEventListener('DOMContentLoaded', function () {
    var isSubmitting = false;

    document.getElementById('commentForm').addEventListener('submit', function (e) {
        e.preventDefault();
        if (isSubmitting) return; 

        submitComment(); 
    });

    loadComments(); 
});

function submitComment() {
    if (isSubmitting) return; 
    isSubmitting = true;
    
    var username = document.getElementById('username').value;
    var comment = document.getElementById('comment').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'submit_comment.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE) {
            isSubmitting = false; 
            
            if (this.status === 200) {
                document.getElementById('responseContainer').innerHTML = this.responseText;
                
               
                if (this.responseText.includes("Comment added successfully")) {
                    document.getElementById('username').value = '';
                    document.getElementById('comment').value = '';
                }

                loadComments();
            } else {
                console.error('An error occurred during the request.');
            }
        }
    };
    xhr.send('username=' + encodeURIComponent(username) + '&comment=' + encodeURIComponent(comment));
}

function loadComments() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch_comments.php', true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById('commentsSection').innerHTML = this.responseText;
        } else {
            console.error('Error fetching comments');
        }
    };
    xhr.send();
}


var isSubmitting = false;

