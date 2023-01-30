function showLoginModal() {
  let loginBtn = document.querySelector(".login");
  let loginForm = document.getElementById("login-form-container");

  loginBtn.addEventListener("click", () => {
    loginForm.style.display = "block";
  });
}
function hideLoginModal() {
  let closeLoginBtn = document.querySelector(".close-login");
  let loginForm = document.getElementById("login-form-container");

  closeLoginBtn.addEventListener("click", () => {
    loginForm.style.display = "none";
  });
}
/*===============================
 * AJAX CALLS
 *===============================*/
function getMessages() {
  let chatBox = document.querySelector(".chat-box");
  let sender = document.querySelector(".username-display").textContent.trim();
  let recipient = document.getElementById("recipients");

  fetch("get_messages.php", {
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((messages) => {
      const filteredMessages = messages.filter((message) => {
        return (
          (message.recipient === recipient.value && message.name === sender) ||
          (message.recipient === sender && message.name === recipient.value)
        );
      });
      const sortedMessages = filteredMessages.sort((a, b) => {
        return new Date(b.dateSent - b.dateSent);
      });
      chatBox.innerHTML = "";
      sortedMessages.forEach((message) => {
        const messageDiv = document.createElement("div");
        console.log(`message sender:${message.name}`);
        console.log(`selected recipient:${recipient.value}`);
        if (message.recipient === sender) {
          messageDiv.classList.add("recipient");
        } else if (message.name === sender) {
          messageDiv.classList.add("sender");
        }
        const messageSender = document.createElement("h4");
        messageSender.textContent = message.name;

        const messageBody = document.createElement("p");
        messageBody.textContent = message.chatMessage;

        const messageTimeSent = document.createElement("small");
        messageTimeSent.textContent = message.dateSent;

        messageDiv.appendChild(messageSender);
        messageDiv.appendChild(messageBody);
        messageDiv.appendChild(messageTimeSent);

        chatBox.appendChild(messageDiv);
      });
    });
}

function sendMessage() {
  let sendMessageBtn = document.querySelector(".submit-message");
  let message = document.getElementById("send-message");
  let sender = document.querySelector(".username-display").textContent.trim();
  let recipient = document.getElementById("recipients");

  sendMessageBtn.onclick = () => {
    fetch("send_messages.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        message: message.value,
        recipient: recipient.value,
        name: sender,
      }),
    })
      .then(function (response) {
        // Handle the response from the PHP script
        if (response.ok) {
          return response.json();
        } else {
          throw new Error("Sending message failed");
        }
      })
      .then(function (data) {
        // Check if the message was sent successfully
        if (data.success) {
          // Clear the message input
          message.value = "";

          alert("Message sent!");
        } else {
          alert(data.error);
        }
      })
      .catch(function (error) {
        alert(error.message);
      });
  };
}
function logout() {
  document.querySelector(".logout").onclick = () => {
    fetch("logout.php", {
      method: "POST",
      headers: {
        "content-type": "application/json",
      },
      body: JSON.stringify({
        loginStatus: "logout",
      }),
    }).then(function (response) {
      // Handle the response from the PHP script
      if (response.ok) {
        return response.json();
      }
    });
    then(function (data) {
      if (data.success) {
        window.location.reload();
      }
    }).catch((error) => {
      console.error(error);
    });
  };
}
document.addEventListener("DOMContentLoaded", () => {
  hideLoginModal();
  document.getElementById("recipients").onchange = () => {
    getMessages();
  };
  setInterval(getMessages, 7000);
  sendMessage();
  logout();
});
