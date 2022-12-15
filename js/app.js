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

function getMessages() {
  let sender = document.querySelector(".username-display").textContent.trim();
  let recipient = document.getElementById("recipients");

  console.log(recipient.value);
  console.log(sender);
  recipient.onchange = () => {
    fetch("get_messages.php", {
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((response) => response.json())
      .then((messages) => {
        const filteredMessages = messages.filter((message) => {
          return (
            (message.recipient === recipient.value &&
              message.name === sender) ||
            (message.recipient === sender && message.name === recipient.value)
          );
        });
        const sortedMessages = filteredMessages.sort((a, b) => {
          return new Date(b.dateSent - b.dateSent);
        });

        sortedMessages.forEach((message) => {
          const messageDiv = document.createElement("div");
          if (message.recipient === recipient.value) {
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

          document.querySelector(".chat-box").appendChild(messageDiv);
        });
      });
  };
}

function sendMessage() {
  let sendMessageBtn = document.querySelector(".submit-message");
  let message = document.getElementById("send-message");
  let recipient = document.getElementById("recipients");
  let sender = document.querySelector(".username-display").textContent.trim();

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

          // Show a success message
          alert("Message sent!");
        } else {
          // Show an error message
          alert(data.error);
        }
      })
      .catch(function (error) {
        // Show an error message
        alert(error.message);
      });
  };
}

document.addEventListener("DOMContentLoaded", () => {
  hideLoginModal();
  getMessages();
  sendMessage();
});
