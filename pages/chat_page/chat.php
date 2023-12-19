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
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <button class="btn btn-sm" style="border: 2px solid #c8aaf2; color: #39285e;" onclick="viewAllBranches()" ondblclick="hideAllBranches()">View All Branches</button>
            <button class="btn btn-sm" style="border: 2px solid #c8aaf2; color: #39285e;"  onclick="changeBranch()"><i class="fa-solid fa-arrow-right-arrow-left"></i></button>
        </div>
    </div>

    <div id="branch-cards" class="row mt-3"></div>

    <div class="col-9" id="message-container">
        <ul id="message-list"></ul>
    </div>

    <div class="row">
        <div class="col-md-8">
            <input type="text" id="message-input" class="form-control ml-2" placeholder="Type your message">
        </div>
        <div class="col-md-4">
            <button class="btn" style="background-color:#be9ded; color: #39285e;" onclick="sendMessage()">Send <span><i class="fas fa-arrow-up"></i></span></button>
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
            const deleteBtnHTML = (isCurrentUser(message) || isModerator()) ? `<button class="delete-btn" onclick="deleteMessage(${index})"><i class="fas fa-trash-alt"></i></button>` : '';
            //const userStatusHTML = ((isCurrentUser(message) && isModerator()) || (isCurrentUser(message) && isTrainer())) ? `<div><strong class="text-warning">${getUserStatus()}</strong></div>` : '';
            messageItem.innerHTML = `<div>${avatarHTML}<strong>${message.senderFirstName} ${message.senderLastName}</strong>(${message.timestamp}): ${message.text} </div>${deleteBtnHTML}`;
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


    function viewAllBranches() {
        const branchCardsContainer = document.getElementById("branch-cards");
        branchCardsContainer.removeAttribute("hidden", true);
        branchCardsContainer.innerHTML = "";

        // Retrieve all branches from localStorage
        const allBranches = Object.keys(localStorage)
            .filter(key => key.startsWith('messages_'))
            .map(key => key.replace('messages_', ''));

        allBranches.forEach(branch => {
            const branchCard = document.createElement("div");
            branchCard.classList.add("card", "m-2");
            branchCard.innerHTML = `
                <div class="card-body">
                    <h5 class="card-title">${branch}</h5>
                    <button class="btn btn-secondary" onclick="loadMessages('${branch}')">Load Messages</button>
                </div>
            `;
            branchCardsContainer.appendChild(branchCard);
        });
    }

    function hideAllBranches() {
        const branchCardsContainer = document.getElementById("branch-cards");
        branchCardsContainer.setAttribute("hidden", true);
    }

</script>
