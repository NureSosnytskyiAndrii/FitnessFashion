<?php
session_start();

use System\classes\User;

if (isset($_SESSION['username']) && $_SESSION['uid']) {
    $user_obj = new User();
    $user = $user_obj->getUserById($_SESSION['uid']);
    $user_first_name = $user['name'];
    $user_last_name = $user['surname'];
    $user_status = $user['user_role'];
    $user_avatar = $user['avatar'];
}
?>

<div id="chat-container" class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Branch: <span id="branch-name"></span></h2>
        </div>
        <div class="col-md-4">
            <button class="btn btn-secondary" onclick="changeBranch()">Change Branch</button>
        </div>
    </div>

    <ul id="message-list"></ul>

    <div class="row">
        <div class="col-md-8">
            <input type="text" id="message-input" class="form-control" placeholder="Type your message">
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary" onclick="sendMessage()">Send</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const branch = localStorage.getItem("branch") || "default";
        document.getElementById("branch-name").innerText = branch;
        loadMessages(branch);
    });

    function sendMessage() {
        const inputElement = document.getElementById("message-input");
        const message = inputElement.value.trim();

        if (message === "") {
            return;
        }

        const branch = localStorage.getItem("branch") || "default";
        const now = new Date();
        const timestamp = now.toLocaleTimeString();

        const newMessage = {
            branch: branch,
            timestamp: timestamp,
            text: message,
            senderFirstName: "<?php echo $user_first_name; ?>",
            senderLastName: "<?php echo $user_last_name; ?>",
            senderAvatar: "<?php echo $user_avatar; ?>",
        };

        const savedMessages = JSON.parse(localStorage.getItem(`messages_${branch}`)) || [];
        savedMessages.push(newMessage);
        localStorage.setItem(`messages_${branch}`, JSON.stringify(savedMessages));

        inputElement.value = "";
        loadMessages(branch);
    }

    function loadMessages(branch) {
        const messageList = document.getElementById("message-list");
        messageList.innerHTML = "";

        const savedMessages = JSON.parse(localStorage.getItem(`messages_${branch}`)) || [];

        savedMessages.forEach((message, index) => {
            const messageItem = document.createElement("li");
            messageItem.classList.add("message");
            const avatarHTML = message.senderAvatar ? `<img class="avatar" src="${message.senderAvatar}" alt="User Avatar">` : '';
            const deleteBtnHTML = (isCurrentUser(message) || isModerator()) ? `<button class="delete-btn" onclick="deleteMessage(${index})">Delete</button>` : '';
            //const userStatusHTML = ((isCurrentUser(message) && isModerator()) || (isCurrentUser(message) && isTrainer())) ? `<div><strong class="text-warning">${getUserStatus()}</strong></div>` : '';
            messageItem.innerHTML = `<div>${avatarHTML}<strong>${message.senderFirstName} ${message.senderLastName}</strong>(${message.timestamp}): ${message.text} ${deleteBtnHTML}</div>`;
            messageList.appendChild(messageItem);
        });
    }

    function getUserStatus() {
        if (isModerator()) {
            return "Moderator";
        } else if (isTrainer()) {
            return "Trainer";
        }
        return "";
    }

    function isCurrentUser(message) {
        return message.senderFirstName === "<?php echo $user_first_name; ?>" && message.senderLastName === "<?php echo $user_last_name; ?>";
    }

    function isModerator() {
        return "<?php echo $user['user_role']; ?>" === "moder";
    }

    function isTrainer() {
        return "<?php echo $user['user_role']; ?>" === "trainer";
    }

    function deleteMessage(index) {
        const branch = localStorage.getItem("branch") || "default";
        let savedMessages = JSON.parse(localStorage.getItem(`messages_${branch}`)) || [];

        savedMessages.splice(index, 1);

        localStorage.setItem(`messages_${branch}`, JSON.stringify(savedMessages));
        loadMessages(branch);
    }

    function changeBranch() {
        const newBranch = prompt("Enter the new branch name:") || "default";
        localStorage.setItem("branch", newBranch);
        document.getElementById("branch-name").innerText = newBranch;
        loadMessages(newBranch);
    }
</script>
